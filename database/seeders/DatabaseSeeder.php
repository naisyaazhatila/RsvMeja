<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders in the correct order
        // 1. Users and Settings (no dependencies)
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
        ]);

        // 2. Tables (no dependencies)
        $this->call([
            TableSeeder::class,
        ]);

        // 3. Menu Categories (no dependencies)
        $this->call([
            MenuCategorySeeder::class,
        ]);

        // 4. Menus (depends on MenuCategory)
        $this->call([
            MenuSeeder::class,
        ]);

        // 5. Promos, Testimonials, and Gallery (no dependencies)
        $this->call([
            PromoSeeder::class,
            TestimonialSeeder::class,
            GalleryImageSeeder::class,
        ]);
    }
}
