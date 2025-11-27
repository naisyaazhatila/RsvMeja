<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    protected $fillable = [
        'name',
        'capacity',
        'position_x',
        'position_y',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailable($query, $date, $time)
    {
        return $query->active()->whereDoesntHave('reservations', function ($q) use ($date, $time) {
            $q->where('reservation_date', $date)
              ->where('status', '!=', 'cancelled')
              ->where(function ($query) use ($time) {
                  $query->where('reservation_time', '<=', $time)
                        ->whereRaw('DATE_ADD(reservation_time, INTERVAL duration_hours HOUR) > ?', [$time]);
              });
        });
    }

    // Methods
    public function isAvailable($date, $time): bool
    {
        return !$this->reservations()
            ->where('reservation_date', $date)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($time) {
                $query->where('reservation_time', '<=', $time)
                      ->whereRaw('DATE_ADD(reservation_time, INTERVAL duration_hours HOUR) > ?', [$time]);
            })
            ->exists();
    }

    // Accessor
    public function getFormattedCapacityAttribute(): string
    {
        return $this->capacity . ' Orang';
    }
}
