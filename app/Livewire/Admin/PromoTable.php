<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Promo;

class PromoTable extends Component
{
    use WithPagination;

    public function render()
    {
        $promos = Promo::latest()->paginate(15);
        
        return view('livewire.admin.promo-table', compact('promos'));
    }
}
