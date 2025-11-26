<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(20)->withQueryString();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'display_order' => 'nullable|integer',
        ]);
        
        // Fix checkbox handling
        $validated['is_featured'] = $request->has('is_featured') ? true : false;
        $validated['is_active'] = $request->has('is_active') ? true : false;

        Testimonial::create($validated);

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function show(Testimonial $testimoni)
    {
        return view('admin.testimonials.show', ['testimonial' => $testimoni]);
    }

    public function edit(Testimonial $testimoni)
    {
        return view('admin.testimonials.edit', ['testimonial' => $testimoni]);
    }

    public function update(Request $request, Testimonial $testimoni)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'display_order' => 'nullable|integer',
        ]);
        
        // Fix checkbox handling
        $validated['is_featured'] = $request->has('is_featured') ? true : false;
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $testimoni->update($validated);

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil diupdate');
    }

    public function destroy(Testimonial $testimoni)
    {
        $testimoni->delete();

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil dihapus');
    }
}
