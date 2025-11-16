<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'table_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'reservation_date',
        'reservation_time',
        'duration_hours',
        'guest_count',
        'special_requests',
        'status',
        'dp_amount',
        'payment_proof',
        'payment_status',
        'payment_confirmed_at',
        'confirmed_at',
        'confirmed_by',
        'booking_code',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'reservation_time' => 'datetime:H:i',
        'confirmed_at' => 'datetime',
        'payment_confirmed_at' => 'datetime',
        'dp_amount' => 'decimal:2',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('reservation_date', today());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('reservation_date', '>=', today())
                     ->where('status', '!=', 'cancelled')
                     ->orderBy('reservation_date')
                     ->orderBy('reservation_time');
    }

    // Mutators
    public function setCustomerPhoneAttribute($value)
    {
        // Format nomor Indonesia
        $phone = preg_replace('/[^0-9]/', '', $value);

        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        $this->attributes['customer_phone'] = $phone;
    }

    // Accessors
    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->reservation_date)->isoFormat('dddd, D MMMM Y');
    }

    public function getFormattedTimeAttribute(): string
    {
        return Carbon::parse($this->reservation_time)->format('H:i') . ' WIB';
    }

    public function getFormattedDpAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->dp_amount, 0, ',', '.');
    }

    // Methods
    public function confirm($adminId)
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'confirmed_by' => $adminId,
        ]);
    }

    public function cancel()
    {
        $this->update([
            'status' => 'cancelled',
        ]);
    }
}
