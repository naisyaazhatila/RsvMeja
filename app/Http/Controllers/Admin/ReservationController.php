<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with('table');
        
        // Search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('booking_code', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_email', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by date
        if ($request->date_from) {
            $query->whereDate('reservation_date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('reservation_date', '<=', $request->date_to);
        }
        
        $reservations = $query->latest()->paginate(15)->withQueryString();
        
        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load('table');
        return view('admin.reservations.show', compact('reservation'));
    }

    public function confirm(Reservation $reservation)
    {
        if ($reservation->status === 'confirmed') {
            return redirect()->back()->with('info', 'Reservasi sudah dikonfirmasi sebelumnya');
        }
        
        $reservation->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'confirmed_by' => auth()->id(),
            'payment_status' => 'paid', // Auto-confirm payment when confirming reservation
            'payment_confirmed_at' => now(),
        ]);
        
        // Send confirmation email to customer
        try {
            \Mail::to($reservation->customer_email)->send(new \App\Mail\ReservationConfirmed($reservation));
            return redirect()->back()->with('success', 'Reservasi dan pembayaran berhasil dikonfirmasi. Email telah dikirim ke pelanggan');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Reservasi dikonfirmasi tapi gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->status === 'cancelled') {
            return redirect()->back()->with('info', 'Reservasi sudah dibatalkan sebelumnya');
        }
        
        $reservation->update(['status' => 'cancelled']);
        
        // Send cancellation email to customer
        try {
            // You can create ReservationCancelled mail class for better notification
            \Mail::to($reservation->customer_email)->send(new \App\Mail\ReservationCancelled($reservation));
            return redirect()->back()->with('success', 'Reservasi berhasil dibatalkan dan email notifikasi telah dikirim ke pelanggan');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Reservasi dibatalkan tapi gagal mengirim email');
        }
    }

    public function complete(Reservation $reservation)
    {
        if ($reservation->status === 'completed') {
            return redirect()->back()->with('info', 'Reservasi sudah diselesaikan sebelumnya');
        }
        
        if ($reservation->status !== 'confirmed') {
            return redirect()->back()->with('error', 'Hanya reservasi yang sudah dikonfirmasi yang bisa diselesaikan');
        }
        
        $reservation->update(['status' => 'completed']);
        
        return redirect()->back()->with('success', 'Reservasi berhasil diselesaikan');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        
        return redirect()->route('admin.reservasi.index')
            ->with('success', 'Reservasi berhasil dihapus');
    }

    public function confirmPayment(Reservation $reservation)
    {
        $reservation->update([
            'payment_status' => 'paid',
            'payment_confirmed_at' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    public function rejectPayment(Reservation $reservation)
    {
        $reservation->update([
            'payment_status' => 'unpaid',
            'payment_proof' => null,
            'payment_confirmed_at' => null,
        ]);
        
        return redirect()->back()->with('success', 'Pembayaran ditolak, pelanggan perlu upload ulang bukti transfer');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }
}
