<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Get all active gallery images
        $images = GalleryImage::where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('created_at', 'desc')
            ->get();

        // Prepare data for JavaScript lightbox
        $cacheBuster = '?v=' . time();
        $allImages = $images->map(function($img) use ($cacheBuster) {
            return [
                'id' => $img->id,
                'url' => url($img->image_path) . $cacheBuster,
                'title' => $img->title,
                'description' => $img->description ?? '',
                'category' => ucfirst($img->category)
            ];
        });

        // Available categories
        $categories = ['food', 'interior', 'ambiance', 'event'];

        return view('gallery', compact('images', 'allImages', 'categories'));
    }
}
