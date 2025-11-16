<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'customer_name',
        'rating',
        'comment',
        'photo',
        'is_featured',
        'display_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
                     ->orderBy('display_order')
                     ->orderBy('created_at', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')
                     ->orderBy('created_at', 'desc');
    }

    // Accessor
    public function getStarRatingAttribute(): string
    {
        return str_repeat('⭐', $this->rating);
    }
}
