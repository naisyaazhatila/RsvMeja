<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promos = [
            // Active Promos
            [
                'title' => 'Promo Spesial Asya\'s Kitchen - Diskon 20%',
                'description' => 'Nikmati diskon 20% untuk semua menu makanan utama khas Indonesia favorit Anda!',
                'image' => 'https://via.placeholder.com/800x400?text=Promo+Asyas+Kitchen',
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'terms' => 'Berlaku untuk makan di tempat, minimal pembelian Rp 200.000, tidak dapat digabung dengan promo lain',
                'valid_from' => Carbon::now()->subDays(5),
                'valid_until' => Carbon::now()->addDays(25),
                'is_active' => true,
            ],
            [
                'title' => 'Gratis Es Cendol Setiap Pembelian Menu Paket',
                'description' => 'Dapatkan Es Cendol Durian gratis untuk setiap pembelian paket menu spesial kami',
                'image' => 'https://via.placeholder.com/800x400?text=Gratis+Es+Cendol',
                'discount_type' => 'fixed',
                'discount_value' => 28000,
                'terms' => 'Berlaku untuk pembelian paket menu spesial minimal 2 orang, Es Cendol tidak dapat ditukar dengan menu lain',
                'valid_from' => Carbon::now()->subDays(10),
                'valid_until' => Carbon::now()->addDays(20),
                'is_active' => true,
            ],

            // Expired Promos
            [
                'title' => 'Promo Ramadan - Diskon 25%',
                'description' => 'Spesial bulan Ramadan, dapatkan diskon 25% untuk paket buka puasa keluarga',
                'image' => 'https://via.placeholder.com/800x400?text=Promo+Ramadan',
                'discount_type' => 'percentage',
                'discount_value' => 25,
                'terms' => 'Berlaku untuk paket buka puasa minimal 4 orang, reservasi H-1',
                'valid_from' => Carbon::now()->subDays(90),
                'valid_until' => Carbon::now()->subDays(60),
                'is_active' => false,
            ],
            [
                'title' => 'Tahun Baru Imlek - Potongan Rp 50.000',
                'description' => 'Sambut tahun baru Imlek dengan potongan harga Rp 50.000',
                'image' => 'https://via.placeholder.com/800x400?text=Imlek+Promo',
                'discount_type' => 'fixed',
                'discount_value' => 50000,
                'terms' => 'Minimal pembelian Rp 300.000, maksimal 1 promo per meja',
                'valid_from' => Carbon::now()->subDays(120),
                'valid_until' => Carbon::now()->subDays(105),
                'is_active' => false,
            ],
            [
                'title' => 'Valentine Special - Buy 1 Get 1 Dessert',
                'description' => 'Beli 1 dessert pilihan, gratis 1 dessert dengan harga yang sama atau lebih rendah',
                'image' => 'https://via.placeholder.com/800x400?text=Valentine+Special',
                'discount_type' => 'percentage',
                'discount_value' => 50,
                'terms' => 'Berlaku untuk kategori dessert, khusus untuk couple, tidak berlaku untuk takeaway',
                'valid_from' => Carbon::now()->subDays(280),
                'valid_until' => Carbon::now()->subDays(265),
                'is_active' => false,
            ],
        ];

        foreach ($promos as $promo) {
            Promo::create($promo);
        }
    }
}
