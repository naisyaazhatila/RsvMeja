<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::latest()->paginate(20)->withQueryString();
        return view('admin.newsletters.index', compact('newsletters'));
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        
        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Subscriber berhasil dihapus');
    }

    public function toggleActive(Newsletter $newsletter)
    {
        $newsletter->update(['is_active' => !$newsletter->is_active]);
        
        return redirect()->back()
            ->with('success', 'Status subscriber berhasil diubah');
    }
}
