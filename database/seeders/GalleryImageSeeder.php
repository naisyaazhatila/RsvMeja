<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            // Food Category
            [
                'title' => 'Rendang Padang Spesial',
                'category' => 'food',
                'image_path' => 'https://via.placeholder.com/800x600?text=Rendang+Padang',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Rendang+Padang',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Nasi Goreng Kambing',
                'category' => 'food',
                'image_path' => 'https://via.placeholder.com/800x600?text=Nasi+Goreng',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Nasi+Goreng',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Soto Ayam Lamongan',
                'category' => 'food',
                'image_path' => 'https://via.placeholder.com/800x600?text=Soto+Ayam',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Soto+Ayam',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Ayam Bakar Taliwang',
                'category' => 'food',
                'image_path' => 'https://via.placeholder.com/800x600?text=Ayam+Taliwang',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Ayam+Taliwang',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Ikan Bakar Jimbaran',
                'category' => 'food',
                'image_path' => 'https://via.placeholder.com/800x600?text=Ikan+Bakar',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Ikan+Bakar',
                'display_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Gado-Gado Jakarta',
                'category' => 'food',
                'image_path' => 'https://via.placeholder.com/800x600?text=Gado-Gado',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Gado-Gado',
                'display_order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Rawon Setan',
                'category' => 'food',
                'image_path' => 'https://via.placeholder.com/800x600?text=Rawon',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Rawon',
                'display_order' => 7,
                'is_active' => true,
            ],

            // Interior Category
            [
                'title' => 'Ruang Makan Utama',
                'category' => 'interior',
                'image_path' => 'https://via.placeholder.com/800x600?text=Ruang+Makan+Utama',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Ruang+Makan+Utama',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Area VIP',
                'category' => 'interior',
                'image_path' => 'https://via.placeholder.com/800x600?text=Area+VIP',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Area+VIP',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Teras Outdoor',
                'category' => 'interior',
                'image_path' => 'https://via.placeholder.com/800x600?text=Teras+Outdoor',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Teras+Outdoor',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Private Dining Room',
                'category' => 'interior',
                'image_path' => 'https://via.placeholder.com/800x600?text=Private+Dining',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Private+Dining',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Bar Area',
                'category' => 'interior',
                'image_path' => 'https://via.placeholder.com/800x600?text=Bar+Area',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Bar+Area',
                'display_order' => 5,
                'is_active' => true,
            ],

            // Ambiance Category
            [
                'title' => 'Suasana Malam',
                'category' => 'ambiance',
                'image_path' => 'https://via.placeholder.com/800x600?text=Suasana+Malam',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Suasana+Malam',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Suasana Siang',
                'category' => 'ambiance',
                'image_path' => 'https://via.placeholder.com/800x600?text=Suasana+Siang',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Suasana+Siang',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Live Music',
                'category' => 'ambiance',
                'image_path' => 'https://via.placeholder.com/800x600?text=Live+Music',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Live+Music',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Acara Keluarga',
                'category' => 'ambiance',
                'image_path' => 'https://via.placeholder.com/800x600?text=Acara+Keluarga',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Acara+Keluarga',
                'display_order' => 4,
                'is_active' => true,
            ],

            // Event Category
            [
                'title' => 'Wedding Party',
                'category' => 'event',
                'image_path' => 'https://via.placeholder.com/800x600?text=Wedding+Party',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Wedding+Party',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Birthday Celebration',
                'category' => 'event',
                'image_path' => 'https://via.placeholder.com/800x600?text=Birthday+Party',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Birthday+Party',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Corporate Event',
                'category' => 'event',
                'image_path' => 'https://via.placeholder.com/800x600?text=Corporate+Event',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Corporate+Event',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Grand Opening',
                'category' => 'event',
                'image_path' => 'https://via.placeholder.com/800x600?text=Grand+Opening',
                'thumbnail_path' => 'https://via.placeholder.com/400x300?text=Grand+Opening',
                'display_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($images as $image) {
            GalleryImage::create($image);
        }
    }
}
