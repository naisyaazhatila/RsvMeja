<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        // Get currently active promos
        $activePromos = Promo::where('is_active', true)
            ->whereDate('valid_from', '<=', today())
            ->whereDate('valid_until', '>=', today())
            ->orderBy('valid_until')
            ->get();

        // Get upcoming promos
        $upcomingPromos = Promo::where('is_active', true)
            ->whereDate('valid_from', '>', today())
            ->orderBy('valid_from')
            ->get();

        return view('promo.index', compact('activePromos', 'upcomingPromos'));
    }
}
