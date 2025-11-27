<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\GalleryImage;
use App\Models\Promo;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredMenus = Menu::where('is_available', true)
            ->where('is_featured', true)
            ->with('category')
            ->take(8)
            ->get();

        $promos = Promo::where('is_active', true)
            ->where('start_date', '<=', now())
            ->where(function($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            })
            ->take(3)
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('display_order')
            ->take(6)
            ->get();

        $gallery = GalleryImage::where('is_active', true)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('home', compact('featuredMenus', 'promos', 'testimonials', 'gallery'));
    }

    public function menu(Request $request)
    {
        $categories = MenuCategory::with(['menus' => function($q) {
            $q->where('is_available', true);
        }])->orderBy('display_order')->get();

        $query = Menu::where('is_available', true)->with('category');

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter vegetarian
        if ($request->has('vegetarian') && $request->vegetarian == '1') {
            $query->where('is_vegetarian', true);
        }

        // Filter spicy
        if ($request->has('spicy') && $request->spicy) {
            if ($request->spicy === 'yes') {
                $query->where('is_spicy', true);
            } elseif ($request->spicy === 'no') {
                $query->where('is_spicy', false);
            }
        }

        // Filter by spicy level
        if ($request->has('spicy_level') && $request->spicy_level) {
            $query->where('spicy_level', $request->spicy_level);
        }

        $menus = $query->orderBy('sort_order')->orderBy('name')->get();

        return view('menu', compact('categories', 'menus'));
    }

    public function gallery()
    {
        $images = GalleryImage::where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('created_at', 'desc')
            ->get();

        // Prepare data for JavaScript lightbox
        $allImages = $images->map(function($img) {
            return [
                'id' => $img->id,
                'url' => asset('storage/' . $img->image_path),
                'title' => $img->title,
                'description' => $img->description ?? '',
                'category' => ucfirst($img->category)
            ];
        });

        $categories = ['food', 'interior', 'ambiance', 'event'];

        return view('gallery', compact('images', 'allImages', 'categories'));
    }

    public function promos()
    {
        return view('promos');
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $averageRating = Testimonial::where('is_active', true)->avg('rating');
        $totalTestimonials = Testimonial::where('is_active', true)->count();

        return view('testimonials', compact('testimonials', 'averageRating', 'totalTestimonials'));
    }
}
