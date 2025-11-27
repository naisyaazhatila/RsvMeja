<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Promo;

class PromoList extends Component
{
    public function render()
    {
        // Get currently active promos (real-time)
        $promos = Promo::where('is_active', true)
            ->where('valid_from', '<=', now())
            ->where(function($q) {
                $q->whereNull('valid_until')
                  ->orWhere('valid_until', '>=', now());
            })
            ->orderBy('valid_from', 'desc')
            ->get();

        return view('livewire.promo-list', compact('promos'));
    }
}
