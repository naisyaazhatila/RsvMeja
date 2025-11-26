<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Check if already subscribed
        $existing = Newsletter::where('email', $validated['email'])->first();
        
        if ($existing) {
            if ($existing->is_active) {
                return back()->with('info', 'Email ini sudah berlangganan newsletter kami.');
            } else {
                // Reactivate subscription
                $existing->update(['is_active' => true]);
                return back()->with('success', 'Langganan newsletter berhasil diaktifkan kembali!');
            }
        }

        Newsletter::create($validated);

        return back()->with('success', 'Terima kasih telah berlangganan newsletter kami!');
    }
}
