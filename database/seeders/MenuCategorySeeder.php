<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Makanan Pembuka',
                'slug' => 'makanan-pembuka',
                'description' => 'Hidangan pembuka untuk memulai santapan Anda',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Makanan Utama',
                'slug' => 'makanan-utama',
                'description' => 'Hidangan utama khas Indonesia pilihan Asya\'s Kitchen',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'description' => 'Berbagai pilihan minuman segar',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Dessert',
                'slug' => 'dessert',
                'description' => 'Hidangan penutup yang manis',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            MenuCategory::create($category);
        }
    }
}
