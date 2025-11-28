<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Menu, MenuCategory};
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('category');
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Search by menu name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $menus = $query->latest()->paginate(20)->withQueryString();
        $categories = MenuCategory::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.menus.index', compact('menus', 'categories'));
    }

    public function create()
    {
        $categories = MenuCategory::orderBy('name')->get();
        return view('admin.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_vegetarian' => 'nullable|boolean',
            'is_spicy' => 'nullable|boolean',
            'spicy_level' => 'nullable|integer|min:1|max:5',
            'is_available' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);
        
        // Fix checkbox handling
        $validated['is_vegetarian'] = $request->has('is_vegetarian') ? true : false;
        $validated['is_spicy'] = $request->has('is_spicy') ? true : false;
        $validated['is_available'] = $request->has('is_available') ? true : false;
        $validated['is_featured'] = $request->has('is_featured') ? true : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            
            // Resize and save
            $img = Image::read($image);
            $img->cover(800, 600);
            
            $path = public_path('uploads/menus/' . $filename);
            file_put_contents($path, $img->encode());
            
            $validated['image'] = 'uploads/menus/' . $filename;
        }

        Menu::create($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function show(Menu $menu)
    {
        return view('admin.menus.show', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        $categories = MenuCategory::orderBy('name')->get();
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_vegetarian' => 'nullable|boolean',
            'is_spicy' => 'nullable|boolean',
            'spicy_level' => 'nullable|integer|min:1|max:5',
            'is_available' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);
        
        // Fix checkbox handling
        $validated['is_vegetarian'] = $request->has('is_vegetarian') ? true : false;
        $validated['is_spicy'] = $request->has('is_spicy') ? true : false;
        $validated['is_available'] = $request->has('is_available') ? true : false;
        $validated['is_featured'] = $request->has('is_featured') ? true : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($menu->image) {
                Storage::delete($menu->image);
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            
            $img = Image::read($image);
            $img->cover(800, 600);
            
            $path = 'menus/' . $filename;
            Storage::put($path, $img->encode());
            
            $validated['image'] = $path;
        }

        $menu->update($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil diupdate');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image && file_exists(public_path($menu->image))) {
            unlink(public_path($menu->image));
        }

        $menu->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil dihapus');
    }

    public function toggleAvailability(Menu $menu)
    {
        $menu->update(['is_available' => !$menu->is_available]);

        return redirect()->back()
            ->with('success', 'Status ketersediaan menu berhasil diubah');
    }
}
