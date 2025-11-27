<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Reservation, Menu, Table, Promo};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $restaurantName = setting('restaurant_name', "Asya's Kitchen");
        
        $stats = [
            'total_reservations' => Reservation::whereMonth('created_at', now()->month)->count(),
            'pending_confirmations' => Reservation::where('status', 'pending')->count(),
            'revenue' => Reservation::where('status', 'confirmed')
                ->whereMonth('created_at', now()->month)
                ->sum('dp_amount'),
            'total_menus' => Menu::count(),
        ];
        
        // Chart data - last 7 days
        $chartData = [
            'dates' => [],
            'counts' => []
        ];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartData['dates'][] = $date->format('d M');
            $chartData['counts'][] = Reservation::whereDate('created_at', $date)->count();
        }
        
        $recentReservations = Reservation::with('table')
            ->latest()
            ->limit(10)
            ->get();
        
        return view('admin.dashboard', compact('stats', 'chartData', 'recentReservations', 'restaurantName'));
    }
}
