<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Enums\ProductType;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'brand_id',
        'name',
        'slug',
        'short_description',
        'long_description',
        'thumbnail_image_path',
        'type',
        'sku',
        'price',
        'compare_at_price',
        'cost_price',
        'vat', // Percentage
        'tax', // Percentage
        'quantity',
        'weight',
        'is_active',
        'is_featured',
        'is_new',
        'is_manage_stock',
        'min_order_quantity',
        'max_order_quantity',
        'seo_title',
        'seo_description',
        'affiliate_url',
        'digital_file',
        'download_limit',
        'download_expiry_days',
    ];

    // These will be available in the JSON response automatically
    protected $appends = [
        'thumbnail_url',
        'current_stock',
        'effective_price',
        'vat_amount',   // Calculated currency value of VAT
        'tax_amount',   // Calculated currency value of Tax
        'total_price'   // Final price the customer pays
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'vat' => 'decimal:2', // Cast as decimal
        'tax' => 'decimal:2', // Cast as decimal
        'quantity' => 'integer',
        'weight' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_manage_stock' => 'boolean',
        'min_order_quantity' => 'integer',
        'max_order_quantity' => 'integer',
        'download_limit' => 'integer',
        'download_expiry_days' => 'integer',
        'type' => ProductType::class,
    ];

    protected $attributes = [
        'type' => ProductType::Normal,
        'is_active' => true,
        'quantity' => 0,
        'vat' => 0.00,
        'tax' => 0.00,
    ];

    /**
     * Boot logic for Slug generation.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if (empty($product->slug) && $product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class)->orderBy('id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_value');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
    public function deals()
    {
        return $this->belongsToMany(Deal::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
    public function scopeOfType($query, ProductType $type)
    {
        return $query->where('type', $type->value);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function isNormal(): bool
    {
        return $this->type?->isNormal() ?? false;
    }
    public function isVariable(): bool
    {
        return $this->type?->isVariable() ?? false;
    }
    public function isAffiliate(): bool
    {
        return $this->type?->isAffiliate() ?? false;
    }
    public function isDigital(): bool
    {
        return $this->type?->isDigital() ?? false;
    }

    public function getCurrentStockAttribute(): int
    {
        if ($this->isVariable()) {
            return (int) $this->variants()->sum('quantity');
        }
        return (int) $this->quantity;
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_image_path) {
            return url('storage/' . $this->thumbnail_image_path);
        }
        return null;
    }

    /**
     * Get the base effective price (Discounted Price), BEFORE Tax/VAT is applied.
     */
    public function getEffectivePriceAttribute()
    {
        if (!$this->relationLoaded('deals')) {
            $this->load(['deals' => function ($query) {
                $query->active();
            }]);
        }

        $activeDeal = $this->deals->filter(fn($deal) => $deal->is_active)
            ->sortByDesc('value')
            ->first();

        if ($activeDeal) {
            $originalPrice = $this->price;
            if ($activeDeal->type === 'percentage') {
                return $originalPrice * (1 - ($activeDeal->value / 100));
            } elseif ($activeDeal->type === 'fixed') {
                return max(0, $originalPrice - $activeDeal->value);
            }
        }

        return $this->price;
    }

    /*
    |--------------------------------------------------------------------------
    | Tax and VAT Logic (Both Percentage)
    |--------------------------------------------------------------------------
    */

    /**
     * Calculate VAT Amount based on Effective Price.
     * Logic: (Effective Price * VAT%) / 100
     */
    public function getVatAmountAttribute()
    {
        $price = $this->effective_price;

        if ($this->vat > 0) {
            return ($price * $this->vat) / 100;
        }

        return 0.00;
    }

    /**
     * Calculate Tax Amount based on Effective Price.
     * Logic: (Effective Price * Tax%) / 100
     */
    public function getTaxAmountAttribute()
    {
        $price = $this->effective_price;

        if ($this->tax > 0) {
            return ($price * $this->tax) / 100;
        }

        return 0.00;
    }

    /**
     * Get the Final Total Price.
     * Logic: Effective Price + VAT Amount + Tax Amount
     */
    public function getTotalPriceAttribute()
    {
        return $this->effective_price + $this->vat_amount + $this->tax_amount;
    }
}
