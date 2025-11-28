<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
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
            
            // Create full-size image
            $img = Image::read($image);
            $img->cover(800, 600);
            
            $path = public_path('uploads/gallery/' . $filename);
            file_put_contents($path, $img->encode());
            
            // Create thumbnail
            $thumbnailFilename = 'thumb_' . $filename;
            $thumbnailImg = Image::read($image);
            $thumbnailImg->cover(300, 225);
            
            $thumbnailPath = public_path('uploads/gallery/' . $thumbnailFilename);
            file_put_contents($thumbnailPath, $thumbnailImg->encode());
            
            $validated['image_path'] = 'uploads/gallery/' . $filename;
            $validated['thumbnail_path'] = 'uploads/gallery/' . $thumbnailFilename;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['description'] = $request->input('description', '');

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
            // Delete old image and thumbnail
            if ($galeri->image_path && file_exists(public_path($galeri->image_path))) {
                unlink(public_path($galeri->image_path));
            }
            if ($galeri->thumbnail_path && file_exists(public_path($galeri->thumbnail_path))) {
                unlink(public_path($galeri->thumbnail_path));
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Create full-size image
            $img = Image::read($image);
            $img->cover(800, 600);
            
            $path = public_path('uploads/gallery/' . $filename);
            file_put_contents($path, $img->encode());
            
            // Create thumbnail
            $thumbnailFilename = 'thumb_' . $filename;
            $thumbnailImg = Image::read($image);
            $thumbnailImg->cover(300, 225);
            
            $thumbnailPath = public_path('uploads/gallery/' . $thumbnailFilename);
            file_put_contents($thumbnailPath, $thumbnailImg->encode());
            
            $validated['image_path'] = 'uploads/gallery/' . $filename;
            $validated['thumbnail_path'] = 'uploads/gallery/' . $thumbnailFilename;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['description'] = $request->input('description', $galeri->description);

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Gambar berhasil diupdate');
    }

    public function destroy(GalleryImage $galeri)
    {
        if ($galeri->image_path && file_exists(public_path($galeri->image_path))) {
            unlink(public_path($galeri->image_path));
        }
        if ($galeri->thumbnail_path && file_exists(public_path($galeri->thumbnail_path))) {
            unlink(public_path($galeri->thumbnail_path));
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
                
                // Create full-size image
                $img = Image::read($image);
                $img->cover(800, 600);
                
                $path = public_path('uploads/gallery/' . $filename);
                file_put_contents($path, $img->encode());
                
                // Create thumbnail
                $thumbnailFilename = 'thumb_' . $filename;
                $thumbnailImg = Image::read($image);
                $thumbnailImg->cover(300, 225);
                
                $thumbnailPath = public_path('uploads/gallery/' . $thumbnailFilename);
                file_put_contents($thumbnailPath, $thumbnailImg->encode());
                
                GalleryImage::create([
                    'title' => 'Gallery Image ' . time(),
                    'category' => $request->category,
                    'image_path' => 'uploads/gallery/' . $filename,
                    'thumbnail_path' => 'uploads/gallery/' . $thumbnailFilename,
                    'is_active' => true,
                ]);

                $count++;
            }
        }

        return redirect()->back()
            ->with('success', "{$count} gambar berhasil diupload");
    }
}
