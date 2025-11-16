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
            $reservation->booking_code = 'RES-' . date('Ymd') . '-' . str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        }
    }
}
