<?php

namespace App\Livewire;

use App\Models\GalleryImage;
use Livewire\Component;

class GalleryGrid extends Component
{
    public $selectedCategory = 'all';
    public $categories = ['food', 'interior', 'ambiance', 'event'];

    public function render()
    {
        $images = GalleryImage::where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('created_at', 'desc')
            ->get();

        // Prepare data for JavaScript lightbox
        $allImages = $images->map(function($img) {
            return [
                'id' => $img->id,
                'url' => url($img->image_path),
                'title' => $img->title,
                'description' => $img->description ?? '',
                'category' => ucfirst($img->category)
            ];
        });

        return view('livewire.gallery-grid', [
            'images' => $images,
            'allImages' => $allImages
        ]);
    }
}
