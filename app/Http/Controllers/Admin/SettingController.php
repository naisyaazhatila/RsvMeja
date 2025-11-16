<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
            'settings' => 'required|array',
            'settings.*' => 'nullable|string',
        ]);

        foreach ($request->input('settings', []) as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Clear settings cache
        Cache::flush();

        return redirect()->back()
            ->with('success', 'Pengaturan berhasil disimpan');
    }
}
