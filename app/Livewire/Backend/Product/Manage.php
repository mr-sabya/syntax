<?php

namespace App\Livewire\Backend\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Enums\ProductType;
use App\Enums\UserRole;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Manage extends Component
{
    use WithFileUploads;

    public ?Product $product = null;

    // Core Product Properties
    public $vendor_id;
    public $selectedCategoryIds = [];
    public $brand_id;
    public $name;
    public $slug;
    public $short_description;
    public $long_description;
    public $thumbnail_image_path;
    public $new_thumbnail_image;
    public $type = 'normal';
    public $sku;

    // Pricing Fields
    public $price;
    public $compare_at_price;
    public $cost_price;
    public $vat; // <--- ADDED
    public $tax; // <--- ADDED

    public $quantity;
    public $weight;
    public $is_active = true;
    public $is_featured = false;
    public $is_new = false;
    public $is_manage_stock = true;
    public $min_order_quantity = 1;
    public $max_order_quantity;

    // Fields for specific product types
    public $affiliate_url;
    public $digital_file_path;
    public $new_digital_file;
    public $download_limit;
    public $download_expiry_days;

    public $categories;
    public $brands;
    public $productTypes;
    public $vendors;

    public function mount($productId = null)
    {
        if ($productId) {
            $this->product = Product::find($productId);
        }

        if (!$this->product) {
            $this->product = new Product();
        }

        $this->categories = Category::active()->get();
        $this->brands = Brand::active()->get();
        $this->productTypes = ProductType::cases();
        $this->vendors = User::where('role', UserRole::Vendor)->where('is_active', true)->get();

        if ($this->product->exists) {
            // --- EDIT MODE ---
            $this->fill($this->product->toArray());

            $this->type = $this->product->type?->value ?? ProductType::Normal->value;
            $this->thumbnail_image_path = $this->product->thumbnail_image_path;
            $this->digital_file_path = $this->product->digital_file;
            $this->vendor_id = $this->product->vendor_id;
            $this->selectedCategoryIds = $this->product->categories->pluck('id')->toArray();

            // Explicitly set VAT and Tax (optional, fill() usually handles this, but good for safety)
            $this->vat = $this->product->vat;
            $this->tax = $this->product->tax;
        } else {
            // --- CREATE MODE ---
            $this->type = ProductType::Normal->value;
            $this->vendor_id = $this->vendors->first()->id ?? null;
            $this->is_active = true;
            $this->is_manage_stock = true;

            // Defaults
            $this->vat = 0.00; // <--- Default
            $this->tax = 0.00; // <--- Default
        }
    }

    protected function rules()
    {
        $rules = [
            'vendor_id' => ['nullable', 'exists:users,id', Rule::exists('users', 'id')->where(function ($query) {
                $query->where('role', UserRole::Vendor->value);
            })],
            'selectedCategoryIds' => ['required', 'array', 'min:1'],
            'selectedCategoryIds.*' => ['exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('products', 'slug')->ignore($this->product->id),
            ],
            'short_description' => ['nullable', 'string', 'max:500'],
            'long_description' => ['nullable', 'string'],
            'new_thumbnail_image' => ['nullable', 'image', 'max:2048'],
            'type' => ['required', Rule::enum(ProductType::class)],
            'sku' => ['nullable', 'string', 'max:255', Rule::unique('products', 'sku')->ignore($this->product->id)],

            // Pricing Rules
            'price' => ['required', 'numeric', 'min:0'],
            'compare_at_price' => ['nullable', 'numeric', 'min:0', 'gte:price'],
            'cost_price' => ['nullable', 'numeric', 'min:0', 'lte:price'],
            'vat' => ['nullable', 'numeric', 'min:0', 'max:100'], // <--- ADDED
            'tax' => ['nullable', 'numeric', 'min:0', 'max:100'], // <--- ADDED

            'quantity' => ['required_if:is_manage_stock,true', 'nullable', 'integer', 'min:0'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'is_new' => ['boolean'],
            'is_manage_stock' => ['boolean'],
            'min_order_quantity' => ['nullable', 'integer', 'min:1'],
            'max_order_quantity' => ['nullable', 'integer', 'min:1', 'gte:min_order_quantity'],
            'affiliate_url' => ['nullable', 'url', 'max:2048'],
            'new_digital_file' => ['nullable', 'file', 'max:102400'],
            'download_limit' => ['nullable', 'integer', 'min:1'],
            'download_expiry_days' => ['nullable', 'integer', 'min:1'],
        ];

        if ($this->type === ProductType::Affiliate->value) {
            $rules['affiliate_url'][] = 'required';
            $rules['sku'] = ['nullable', 'string', 'max:255', Rule::unique('products', 'sku')->ignore($this->product->id)];
            $rules['quantity'] = ['nullable', 'integer', 'min:0'];
            $rules['is_manage_stock'] = ['nullable', 'boolean'];
        }
        if ($this->type === ProductType::Digital->value) {
            $rules['new_digital_file'][] = $this->product->digital_file ? 'nullable' : 'required';
            $rules['sku'] = ['nullable', 'string', 'max:255', Rule::unique('products', 'sku')->ignore($this->product->id)];
            $rules['quantity'] = ['nullable', 'integer', 'min:0'];
            $rules['is_manage_stock'] = ['nullable', 'boolean'];
        }
        if ($this->type === ProductType::Normal->value) {
            $rules['quantity'][] = 'required';
        }
        if ($this->type === ProductType::Variable->value) {
            $rules['quantity'] = ['nullable', 'integer', 'min:0'];
            $rules['is_manage_stock'] = ['nullable', 'boolean'];
            $rules['sku'] = ['nullable', 'string', 'max:255', Rule::unique('products', 'sku')->ignore($this->product->id)];
        }

        return $rules;
    }

    protected $messages = [
        'selectedCategoryIds.required' => 'At least one category must be selected.',
        'selectedCategoryIds.array' => 'Categories must be an array.',
        'selectedCategoryIds.min' => 'Please select at least one category.',
        'quantity.required_if' => 'The quantity field is required when stock is managed.',
        'new_digital_file.required' => 'A digital file is required for digital products.',
        'affiliate_url.required' => 'The affiliate URL is required for affiliate products.',
        'compare_at_price.gte' => 'The compare at price must be greater than or equal to the price.',
        'cost_price.lte' => 'The cost price must be less than or equal to the price.',
        'max_order_quantity.gte' => 'The maximum order quantity must be greater than or equal to the minimum order quantity.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if ($propertyName === 'name' && empty($this->slug)) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
        $this->validateOnly('slug');
    }

    public function save()
    {
        $this->validate();

        if ($this->new_thumbnail_image) {
            if ($this->product->thumbnail_image_path) {
                Storage::disk('public')->delete($this->product->thumbnail_image_path);
            }
            $this->thumbnail_image_path = $this->new_thumbnail_image->store('products/thumbnails', 'public');
        }

        if ($this->type === ProductType::Digital->value && $this->new_digital_file) {
            if ($this->product->digital_file) {
                Storage::disk('public')->delete($this->product->digital_file);
            }
            $this->digital_file_path = $this->new_digital_file->store('products/digital_files', 'public');
        } elseif ($this->type !== ProductType::Digital->value && $this->product->digital_file) {
            Storage::disk('public')->delete($this->product->digital_file);
            $this->digital_file_path = null;
        }

        $this->product->fill([
            'vendor_id' => $this->vendor_id,
            'brand_id' => $this->brand_id,
            'name' => $this->name,
            'slug' => $this->slug ?? Str::slug($this->name),
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'thumbnail_image_path' => $this->thumbnail_image_path,
            'type' => ProductType::from($this->type),
            'sku' => $this->sku,
            'price' => $this->price,
            'compare_at_price' => $this->compare_at_price,
            'cost_price' => $this->cost_price,
            'vat' => $this->vat ?? 0, // <--- ADDED
            'tax' => $this->tax ?? 0, // <--- ADDED
            'quantity' => ($this->type === ProductType::Variable->value || $this->type === ProductType::Affiliate->value || $this->type === ProductType::Digital->value) ? null : $this->quantity,
            'weight' => $this->weight,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'is_new' => $this->is_new,
            'is_manage_stock' => ($this->type === ProductType::Variable->value || $this->type === ProductType::Affiliate->value || $this->type === ProductType::Digital->value) ? false : $this->is_manage_stock,
            'min_order_quantity' => $this->min_order_quantity,
            'max_order_quantity' => $this->max_order_quantity,
            'affiliate_url' => ($this->type === ProductType::Affiliate->value) ? $this->affiliate_url : null,
            'digital_file' => ($this->type === ProductType::Digital->value) ? $this->digital_file_path : null,
            'download_limit' => ($this->type === ProductType::Digital->value) ? $this->download_limit : null,
            'download_expiry_days' => ($this->type === ProductType::Digital->value) ? $this->download_expiry_days : null,
        ])->save();

        $this->product->categories()->sync($this->selectedCategoryIds);

        session()->flash('message', 'Product ' . ($this->product->wasRecentlyCreated ? 'created' : 'updated') . ' successfully!');

        return redirect()->route('admin.product.products.edit', $this->product->id);
    }

    public function render()
    {
        return view('livewire.backend.product.manage');
    }
}
