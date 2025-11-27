<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'restaurant_name', 'value' => 'Asya\'s Kitchen', 'group' => 'general'],
            ['key' => 'restaurant_address', 'value' => 'Jl. Kemang Raya No. 88, Jakarta Selatan 12730', 'group' => 'general'],
            ['key' => 'restaurant_phone', 'value' => '021-7198765', 'group' => 'general'],
            ['key' => 'restaurant_email', 'value' => 'hello@asyaskitchen.com', 'group' => 'general'],
            ['key' => 'operating_hours', 'value' => '10:00 - 22:00', 'group' => 'general'],

            // Payment Settings
            ['key' => 'bank_name', 'value' => 'BCA', 'group' => 'payment'],
            ['key' => 'account_number', 'value' => '5420123456', 'group' => 'payment'],
            ['key' => 'account_holder', 'value' => 'Asya\'s Kitchen', 'group' => 'payment'],
            ['key' => 'dp_amount', 'value' => '100000', 'group' => 'payment'],

            // Social Media Settings
            ['key' => 'whatsapp_number', 'value' => '628111234567', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/asyaskitchen', 'group' => 'social'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/asyaskitchen', 'group' => 'social'],
            ['key' => 'google_maps_embed', 'value' => '', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
