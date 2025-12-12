<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'logo',
        'website_url',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Scope to get only active clients sorted
    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('sort_order', 'asc');
    }

    // Accessor for the full image URL
    // Usage: {{ $client->logo_url }}
    public function getLogoUrlAttribute()
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo)) {
            return asset('storage/' . $this->logo);
        }

        // Return a placeholder if no logo found
        return asset('assets/frontend/images/no-logo.png');
    }
}
