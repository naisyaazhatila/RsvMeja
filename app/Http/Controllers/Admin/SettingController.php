<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy(function($setting) {
            // Group settings by prefix
            if (str_starts_with($setting->key, 'restaurant_')) {
                return 'Restaurant Info';
            } elseif (in_array($setting->key, ['bank_name', 'bank_account_number', 'bank_account_holder', 'dp_amount'])) {
                return 'Payment Settings';
            } elseif (in_array($setting->key, ['whatsapp', 'instagram', 'facebook'])) {
                return 'Social Media';
            } else {
                return 'General';
            }
        });

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'restaurant_name' => 'nullable|string|max:255',
            'restaurant_email' => 'nullable|email|max:255',
            'restaurant_phone' => 'nullable|string|max:20',
            'restaurant_address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'whatsapp_number' => 'nullable|string|max:20',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'operating_hours' => 'nullable|string',
            'is_closed_monday' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'dp_amount' => 'nullable|numeric|min:0',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'account_holder' => 'nullable|string|max:255',
            'google_maps_embed' => 'nullable|string',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            $oldLogo = setting('logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $logoPath]);
        }

        // Update all settings
        $settingsToUpdate = [
            'restaurant_name',
            'restaurant_email',
            'restaurant_phone',
            'restaurant_address',
            'facebook_url',
            'instagram_url',
            'whatsapp_number',
            'opening_time',
            'closing_time',
            'operating_hours',
            'dp_amount',
            'bank_name',
            'account_number',
            'account_holder',
            'google_maps_embed',
        ];

        foreach ($settingsToUpdate as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        // Handle checkbox (is_closed_monday)
        Setting::updateOrCreate(
            ['key' => 'is_closed_monday'],
            ['value' => $request->has('is_closed_monday') ? '1' : '0']
        );

        // Clear settings cache
        Cache::forget('settings');

        return redirect()->back()
            ->with('success', 'Pengaturan berhasil disimpan!');
    }
}
