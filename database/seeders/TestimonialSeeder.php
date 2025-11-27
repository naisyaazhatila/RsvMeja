<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Budi Santoso',
                'rating' => 5,
                'comment' => 'Asya\'s Kitchen adalah tempat terbaik untuk menikmati masakan Indonesia! Rendang Padangnya benar-benar luar biasa, bumbu meresap sempurna. Pasti akan kembali lagi!',
                'photo' => 'https://ui-avatars.com/api/?name=Budi+Santoso&size=200',
                'is_featured' => true,
                'display_order' => 1,
            ],
            [
                'customer_name' => 'Siti Nurhaliza',
                'rating' => 5,
                'comment' => 'Asya\'s Kitchen adalah tempat favorit keluarga kami! Menu Soto Ayam Lamongannya enak banget, rasanya autentik seperti di kampung halaman. Highly recommended!',
                'photo' => 'https://ui-avatars.com/api/?name=Siti+Nurhaliza&size=200',
                'is_featured' => true,
                'display_order' => 2,
            ],
            [
                'customer_name' => 'Ahmad Hidayat',
                'rating' => 4,
                'comment' => 'Nasi Goreng Kambingnya juara! Porsinya banyak dan harganya worth it. Suasana restaurantnya juga bagus, cocok untuk acara keluarga.',
                'photo' => 'https://ui-avatars.com/api/?name=Ahmad+Hidayat&size=200',
                'is_featured' => false,
                'display_order' => 3,
            ],
            [
                'customer_name' => 'Dewi Lestari',
                'rating' => 5,
                'comment' => 'Pertama kali cobain Ayam Bakar Taliwang di sini dan langsung jatuh cinta! Pedasnya pas dan ayamnya empuk. Service excellence!',
                'photo' => 'https://ui-avatars.com/api/?name=Dewi+Lestari&size=200',
                'is_featured' => true,
                'display_order' => 4,
            ],
            [
                'customer_name' => 'Andi Wijaya',
                'rating' => 4,
                'comment' => 'Menu makanannya lengkap dan authentic. Terutama Gado-Gado Jakartanya, bumbu kacangnya enak banget. Tempatnya juga bersih.',
                'photo' => 'https://ui-avatars.com/api/?name=Andi+Wijaya&size=200',
                'is_featured' => false,
                'display_order' => 5,
            ],
            [
                'customer_name' => 'Maya Putri',
                'rating' => 5,
                'comment' => 'Suka banget sama Ikan Bakar Jimbarannya! Fresh dan bumbunya meresap. Harga sesuai dengan kualitas. Mantap!',
                'photo' => 'https://ui-avatars.com/api/?name=Maya+Putri&size=200',
                'is_featured' => true,
                'display_order' => 6,
            ],
            [
                'customer_name' => 'Rudi Hartono',
                'rating' => 4,
                'comment' => 'Rawon Setannya enak, kuahnya pekat dan dagingnya empuk. Cocok banget buat yang kangen masakan Jawa Timur.',
                'photo' => 'https://ui-avatars.com/api/?name=Rudi+Hartono&size=200',
                'is_featured' => false,
                'display_order' => 7,
            ],
            [
                'customer_name' => 'Linda Kusuma',
                'rating' => 5,
                'comment' => 'Asya\'s Kitchen adalah restaurant favorit untuk acara keluarga! Menu dessertnya juga enak-enak, terutama Es Pisang Ijo. Pelayanannya cepat dan ramah. Love it!',
                'photo' => 'https://ui-avatars.com/api/?name=Linda+Kusuma&size=200',
                'is_featured' => true,
                'display_order' => 8,
            ],
            [
                'customer_name' => 'Hendra Gunawan',
                'rating' => 4,
                'comment' => 'Tempatnya strategis dan parkir luas. Nasi Liwet Solonya mantap, lengkap dengan lauknya. Good job!',
                'photo' => 'https://ui-avatars.com/api/?name=Hendra+Gunawan&size=200',
                'is_featured' => false,
                'display_order' => 9,
            ],
            [
                'customer_name' => 'Rina Marlina',
                'rating' => 5,
                'comment' => 'Selalu puas makan di sini. Semua menu yang pernah dicoba selalu enak. Staff-nya juga helpful banget. Highly recommended!',
                'photo' => 'https://ui-avatars.com/api/?name=Rina+Marlina&size=200',
                'is_featured' => false,
                'display_order' => 10,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
