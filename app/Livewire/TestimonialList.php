<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Testimonial;

class TestimonialList extends Component
{
    use WithPagination;

    public function render()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $averageRating = Testimonial::where('is_active', true)->avg('rating');
        $totalTestimonials = Testimonial::where('is_active', true)->count();

        return view('livewire.testimonial-list', compact('testimonials', 'averageRating', 'totalTestimonials'));
    }
}
