<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Software extends Model
{
    use HasFactory;

    protected $table = 'software'; // Explicit table name just in case

    protected $fillable = [
        'software_category_id',
        'name',
        'slug',
        'version',
        'short_description',
        'long_description',
        'features',
        'logo',
        'banner_image',
        'demo_url',
        'download_url',
        'purchase_url',
        'price',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array', // Automatically cast JSON to array
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(SoftwareCategory::class, 'software_category_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessors for Images
    public function getLogoUrlAttribute()
    {
        return $this->logo && Storage::disk('public')->exists($this->logo)
            ? asset('storage/' . $this->logo)
            : asset('assets/frontend/images/no-logo.png'); // Ensure you have a placeholder
    }

    public function getBannerUrlAttribute()
    {
        return $this->banner_image && Storage::disk('public')->exists($this->banner_image)
            ? asset('storage/' . $this->banner_image)
            : null;
    }
}
