<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::create($validated);

        // Optional: Send email notification to admin
        try {
            $adminEmail = setting('restaurant_email', 'admin@asyaskitchen.com');
            \Mail::to($adminEmail)->send(new \App\Mail\ContactMessageReceived($validated));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact email notification: ' . $e->getMessage());
        }

        return back()->with('success', 'Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
    }
}
