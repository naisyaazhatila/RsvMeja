<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    public function index()
    {
        return view('admin.promos.index');
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_transaction' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'terms_conditions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'nullable|boolean',
        ]);
        
        // Fix checkbox handling
        $validated['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            $img = Image::read($image);
            $img->cover(800, 600);
            
            $path = public_path('uploads/promos/' . $filename);
            file_put_contents($path, $img->encode());
            
            $validated['image'] = 'uploads/promos/' . $filename;
        }

        Promo::create($validated);

        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil ditambahkan');
    }

    public function show(Promo $promo)
    {
        return view('admin.promos.show', compact('promo'));
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_transaction' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'terms_conditions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'nullable|boolean',
        ]);
        
        // Fix checkbox handling
        $validated['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            if ($promo->image && file_exists(public_path($promo->image))) {
                unlink(public_path($promo->image));
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            $img = Image::read($image);
            $img->cover(800, 600);
            
            $path = public_path('uploads/promos/' . $filename);
            file_put_contents($path, $img->encode());
            
            $validated['image'] = 'uploads/promos/' . $filename;
        }

        $promo->update($validated);

        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil diupdate');
    }

    public function destroy(Promo $promo)
    {
        if ($promo->image && file_exists(public_path($promo->image))) {
            unlink(public_path($promo->image));
        }

        $promo->delete();

        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil dihapus');
    }
}
