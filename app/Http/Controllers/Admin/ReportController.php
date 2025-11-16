<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReservationsExport;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['table', 'user']);
        
        // Filter by date range if provided
        if ($request->filled('date_from')) {
            $query->whereDate('reservation_date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('reservation_date', '<=', $request->date_to);
        }
        
        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by payment status if provided
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
        
        // Apply sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        $allowedSortFields = ['created_at', 'reservation_date', 'customer_name', 'status', 'payment_status'];
        if (in_array($sortBy, $allowedSortFields)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->latest();
        }
        
        $reservations = $query->paginate(20)->withQueryString();
        
        // Calculate statistics based on filters
        $statsQuery = Reservation::query();
        
        if ($request->filled('date_from')) {
            $statsQuery->whereDate('reservation_date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $statsQuery->whereDate('reservation_date', '<=', $request->date_to);
        }
        
        $stats = [
            'total' => (clone $statsQuery)->count(),
            'confirmed' => (clone $statsQuery)->where('status', 'confirmed')->count(),
            'pending' => (clone $statsQuery)->where('status', 'pending')->count(),
            'cancelled' => (clone $statsQuery)->where('status', 'cancelled')->count(),
            'revenue' => (clone $statsQuery)->where('payment_status', 'paid')->sum('dp_amount'),
        ];
        
        return view('admin.reports.index', compact('reservations', 'stats'));
    }

    public function export(Request $request)
    {
        $validated = $request->validate([
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'format' => 'required|in:xlsx,csv',
            'status' => 'nullable|in:pending,confirmed,cancelled,completed',
            'payment_status' => 'nullable|in:unpaid,pending,paid',
            'sort_by' => 'nullable|in:created_at,reservation_date,customer_name,status,payment_status',
            'sort_order' => 'nullable|in:asc,desc',
        ]);

        $filename = 'laporan_reservasi_' . date('Ymd_His') . '.' . $validated['format'];

        return Excel::download(
            new ReservationsExport(
                $validated['date_from'],
                $validated['date_to'],
                $request->status,
                $request->payment_status,
                $request->sort_by ?? 'created_at',
                $request->sort_order ?? 'desc'
            ),
            $filename
        );
    }
}
