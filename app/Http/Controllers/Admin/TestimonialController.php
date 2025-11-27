<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return view('admin.testimonials.index');
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'display_order' => 'nullable|integer',
        ]);
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            $img = \Intervention\Image\Laravel\Facades\Image::read($image);
            $img->cover(200, 200);
            
            $path = public_path('uploads/testimonials/' . $filename);
            file_put_contents($path, $img->encode());
            
            $validated['photo'] = 'uploads/testimonials/' . $filename;
        }
        
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'display_order' => 'nullable|integer',
        ]);
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($testimoni->photo && file_exists(public_path($testimoni->photo))) {
                unlink(public_path($testimoni->photo));
            }
            
            $image = $request->file('photo');
            $filename = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            $img = \Intervention\Image\Laravel\Facades\Image::read($image);
            $img->cover(200, 200);
            
            $path = public_path('uploads/testimonials/' . $filename);
            file_put_contents($path, $img->encode());
            
            $validated['photo'] = 'uploads/testimonials/' . $filename;
        }
        
        // Fix checkbox handling
        $validated['is_featured'] = $request->has('is_featured') ? true : false;
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $testimoni->update($validated);

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil diupdate');
    }

    public function destroy(Testimonial $testimoni)
    {
        // Delete photo if exists
        if ($testimoni->photo && file_exists(public_path($testimoni->photo))) {
            unlink(public_path($testimoni->photo));
        }
        
        $testimoni->delete();

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil dihapus');
    }
}
