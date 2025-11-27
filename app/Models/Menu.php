<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'is_vegetarian',
        'is_spicy',
        'spicy_level',
        'is_available',
        'is_featured',
        'view_count',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_vegetarian' => 'boolean',
        'is_spicy' => 'boolean',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeVegetarian($query)
    {
        return $query->where('is_vegetarian', true);
    }

    public function scopeSpicy($query)
    {
        return $query->where('is_spicy', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopePopular($query, $limit = 8)
    {
        return $query->orderBy('view_count', 'desc')->limit($limit);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Accessor
    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('img/placeholder-menu.jpg');
        }
        return asset('storage/' . $this->image);
    }
    
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getSpicyBadgeAttribute(): ?string
    {
        if (!$this->is_spicy) {
            return null;
        }

        return 'Pedas Level ' . ($this->spicy_level ?? 1);
    }

    // Methods
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }
}
