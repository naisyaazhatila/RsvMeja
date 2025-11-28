<?php

namespace App\Observers;

use App\Models\Reservation;

class ReservationObserver
{
    /**
     * Handle the Reservation "creating" event.
     */
    public function creating(Reservation $reservation): void
    {
        if (empty($reservation->booking_code)) {
            // Use Carbon with user's timezone for accurate date/time
            $now = \Carbon\Carbon::now();
            $reservation->booking_code = 'RES-' . $now->format('Ymd-His') . '-' . str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        }
    }
}
