<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    function setting($key, $default = null) {
        return Cache::remember("setting.{$key}", 3600, function() use ($key, $default) {
            return Setting::where('key', $key)->value('value') ?? $default;
        });
    }
}

if (!function_exists('format_rupiah')) {
    function format_rupiah($amount) {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('format_phone')) {
    function format_phone($phone) {
        // Convert 08xxx to 628xxx for WhatsApp
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (substr($phone, 0, 1) === '0') {
            return '62' . substr($phone, 1);
        }

        return $phone;
    }
}

if (!function_exists('booking_code')) {
    function booking_code() {
        return 'RES-' . date('Ymd') . '-' . str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('whatsapp_link')) {
    function whatsapp_link($phone, $message = '') {
        $phone = format_phone($phone);
        $encodedMessage = urlencode($message);
        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }
}
