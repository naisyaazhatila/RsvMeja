<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::latest()->paginate(24)->withQueryString();
        return view('admin.galleries.index', compact('images'));
    }

    public function create()
    {
        $categories = ['food', 'interior', 'ambiance', 'event'];
        return view('admin.galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:food,interior,ambiance,event',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            $img = Image::read($image);
            $img->cover(800, 600);
            
            $path = 'gallery/' . $filename;
            Storage::disk('public')->put($path, $img->encode());
            
            $validated['image_path'] = 'storage/' . $path;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        GalleryImage::create($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Gambar berhasil ditambahkan');
    }

    public function show(GalleryImage $galeri)
    {
        return view('admin.galleries.show', compact('galeri'));
    }

    public function edit(GalleryImage $galeri)
    {
        $categories = ['food', 'interior', 'ambiance', 'event'];
        return view('admin.galleries.edit', compact('galeri', 'categories'));
    }

    public function update(Request $request, GalleryImage $galeri)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:food,interior,ambiance,event',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($galeri->image_path && file_exists(public_path($galeri->image_path))) {
                unlink(public_path($galeri->image_path));
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            $img = Image::read($image);
            $img->cover(800, 600);
            
            $path = 'gallery/' . $filename;
            Storage::disk('public')->put($path, $img->encode());
            
            $validated['image_path'] = 'storage/' . $path;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Gambar berhasil diupdate');
    }

    public function destroy(GalleryImage $galeri)
    {
        if ($galeri->image_path) {
            Storage::delete($galeri->image_path);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Gambar berhasil dihapus');
    }

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|in:food,interior,ambiance,event',
        ]);

        $count = 0;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                
                $img = Image::read($image);
                $img->cover(800, 600);
                
                $path = 'gallery/' . $filename;
                Storage::put($path, $img->encode());
                
                GalleryImage::create([
                    'title' => 'Gallery Image ' . time(),
                    'category' => $request->category,
                    'image_path' => $path,
                    'is_active' => true,
                ]);

                $count++;
            }
        }

        return redirect()->back()
            ->with('success', "{$count} gambar berhasil diupload");
    }
}
