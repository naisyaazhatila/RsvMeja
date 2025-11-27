<?php

namespace App\Http\Controllers;

use App\Models\{Menu, MenuCategory};
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Get all active categories with their menus
        $categories = MenuCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Get all available menus for initial display
        $allMenus = Menu::with('category')
            ->where('is_available', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('menu.index', compact('categories', 'allMenus'));
    }
}
