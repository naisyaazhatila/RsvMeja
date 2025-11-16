<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class MyReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('table')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('my-reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        // Pastikan user hanya bisa lihat reservasinya sendiri
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $reservation->load('table');
        
        // Generate WhatsApp URL for payment proof
        $waPhone = setting('restaurant_phone', '6281234567890');
        $waPhone = preg_replace('/[^0-9]/', '', $waPhone);
        if (!str_starts_with($waPhone, '62')) {
            $waPhone = '62' . ltrim($waPhone, '0');
        }

        $message = "Halo, saya ingin mengirim bukti pembayaran untuk:\n\n";
        $message .= "Kode Booking: *{$reservation->booking_code}*\n";
        $message .= "Nama: {$reservation->customer_name}\n";
        $message .= "Tanggal: " . \Carbon\Carbon::parse($reservation->reservation_date)->format('d F Y') . "\n";
        $message .= "Waktu: {$reservation->reservation_time}\n";
        $message .= "Jumlah DP: Rp " . number_format($reservation->dp_amount, 0, ',', '.');

        $waUrl = "https://wa.me/{$waPhone}?text=" . urlencode($message);

        return view('my-reservations.show', compact('reservation', 'waUrl'));
    }
}
