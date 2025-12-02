## **Deskripsi Singkat Aplikasi**

**ASYA’S KITCHEN** merupakan aplikasi website reservasi meja restoran berbasis web yang memungkinkan pelanggan melakukan pemesanan meja secara online tanpa harus datang langsung ke restoran. Aplikasi ini juga membantu pihak restoran dalam mengelola data reservasi, menu, promo, dan laporan secara terpusat. Website dirancang dengan tampilan responsif dan user-friendly agar mudah digunakan oleh pelanggan maupun admin.

---

## **Fitur Utama**

* Sistem reservasi meja restoran secara online dengan pemilihan meja secara visual
* Sistem pembayaran DP manual (offline) dengan verifikasi oleh admin
* Instruksi pembayaran DP (informasi rekening dan kontak WhatsApp Admin)
* Tampilan menu digital sebagai katalog makanan dan minuman
* Pencarian menu berdasarkan kata kunci
* Filter menu (kategori, tingkat kepedasan, dan menu vegetarian)
* Galeri foto restoran (suasana, interior, dan makanan)
* Halaman promo untuk menampilkan penawaran atau diskon
* Sistem testimoni pelanggan (ditampilkan oleh admin)
* Dashboard analitik admin untuk melihat ringkasan data reservasi
* Notifikasi konfirmasi reservasi melalui email setelah pembayaran diverifikasi
* Ekspor laporan data reservasi dalam format Excel atau CSV

---

## **Teknologi yang Digunakan**

* **Framework Backend**: Laravel
* **Frontend**: Blade Template, HTML, CSS, JavaScript
* **Library**: Livewire
* **UI Framework**: Bootstrap
* **Database**: MySQL
* **Web Server Lokal**: Laragon
* **Dependency Manager**: Composer
* **Version Control**: Git

---

## **Cara Instalasi**

1. Clone repository project:

   ```bash
   git clone <https://github.com/naisyaazhatila/RsvMeja.git>
   ```
2. Masuk ke folder project:

   ```bash
   cd asyas-kitchen
   ```
3. Install dependency menggunakan Composer:

   ```bash
   composer install
   ```
4. Salin file konfigurasi environment:

   ```bash
   cp .env.example .env
   ```
5. Generate application key:

   ```bash
   php artisan key:generate
   ```
6. Buat database baru melalui phpMyAdmin.
7. Atur konfigurasi database pada file `.env`.

---

## **Cara Menjalankan Project**

1. Jalankan Laragon.
2. Aktifkan Apache dan MySQL.
3. Jalankan migrasi database:

   ```bash
   php artisan migrate
   ```
4. Jalankan server Laravel:

   ```bash
   php artisan serve
   ```

