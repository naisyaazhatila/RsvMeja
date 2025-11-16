<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class PaymentInstructionController extends Controller
{
    public function show($bookingCode)
    {
        // Find reservation by booking code
        $reservation = Reservation::where('booking_code', $bookingCode)
            ->with(['table', 'user'])
            ->firstOrFail();

        // Check if user owns this reservation (if authenticated)
        if (auth()->check() && $reservation->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized access to this reservation');
        }

        // Calculate DP amount (30% of estimated total)
        $dpPercentage = 30;
        $estimatedTotal = 500000; // You can calculate based on menu items or guest count
        $dpAmount = ($estimatedTotal * $dpPercentage) / 100;

        // WhatsApp number for payment proof (admin/restaurant)
        $whatsappNumber = '6281234567890'; // Replace with actual restaurant WhatsApp
        
        // Generate WhatsApp message
        $message = "Halo Asya's Kitchen, saya ingin mengkonfirmasi pembayaran DP untuk:\n\n";
        $message .= "Kode Booking: {$reservation->booking_code}\n";
        $message .= "Nama: {$reservation->customer_name}\n";
        $message .= "Tanggal: {$reservation->reservation_date->format('d M Y')}\n";
        $message .= "Waktu: {$reservation->reservation_time}\n";
        $message .= "Jumlah Tamu: {$reservation->guest_count} orang\n";
        $message .= "Meja: {$reservation->table->name}\n\n";
        $message .= "Jumlah DP: Rp " . number_format($dpAmount, 0, ',', '.') . "\n\n";
        $message .= "Saya sudah melakukan transfer. Mohon konfirmasi.";

        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($message);

        return view('payment-instruction', compact('reservation', 'dpAmount', 'dpPercentage', 'whatsappUrl'));
    }
}
