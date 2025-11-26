<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'discount_type',
        'discount_value',
        'terms_conditions',
        'min_transaction',
        'max_discount',
        'valid_from',
        'valid_until',
        'is_active',
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
        'discount_value' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        return $query->where('is_active', true)
                     ->whereDate('valid_from', '<=', today())
                     ->whereDate('valid_until', '>=', today());
    }

    // Accessors
    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('img/placeholder-promo.jpg');
        }
        return asset('storage/' . $this->image);
    }
    
    public function getIsExpiringSoonAttribute(): bool
    {
        return $this->valid_until->diffInDays(today()) < 7
               && $this->valid_until->isFuture();
    }

    public function getIsValidAttribute(): bool
    {
        return $this->is_active
               && $this->valid_from->isPast()
               && $this->valid_until->isFuture();
    }

    public function getFormattedDiscountAttribute(): string
    {
        if ($this->discount_type === 'percentage') {
            return $this->discount_value . '%';
        }

        return 'Rp ' . number_format($this->discount_value, 0, ',', '.');
    }

    // Methods
    public function calculateDiscount($amount): float
    {
        if ($this->discount_type === 'percentage') {
            return $amount * ($this->discount_value / 100);
        }

        return min($this->discount_value, $amount);
    }
}
