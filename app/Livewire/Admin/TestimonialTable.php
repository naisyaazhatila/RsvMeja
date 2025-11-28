<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Testimonial;

class TestimonialTable extends Component
{
    use WithPagination;

    public function render()
    {
        $testimonials = Testimonial::latest()->paginate(20);

        return view('livewire.admin.testimonial-table', compact('testimonials'));
    }
}
