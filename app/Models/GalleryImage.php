<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'title',
        'category',
        'image_path',
        'thumbnail_path',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')
                     ->orderBy('created_at', 'desc');
    }

    // Accessor
    public function getImageUrlAttribute(): string
    {
        if (!$this->image_path) {
            return asset('img/placeholder-gallery.jpg');
        }
        // Handle both formats: with or without 'storage/' prefix
        if (str_starts_with($this->image_path, 'storage/')) {
            return asset($this->image_path);
        }
        return asset('storage/' . $this->image_path);
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (!$this->thumbnail_path) {
            return $this->image_url;
        }
        if (str_starts_with($this->thumbnail_path, 'storage/')) {
            return asset($this->thumbnail_path);
        }
        return asset('storage/' . $this->thumbnail_path);
    }
}
