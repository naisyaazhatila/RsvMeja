# 🍽️ Restaurant Reservation System - Setup Guide

## 📦 Instalasi

### 1. Extract Project
Extract file ZIP ke folder yang Anda inginkan.

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Setup Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Atau gunakan SQLite (default):
```env
DB_CONNECTION=sqlite
```

Lalu jalankan migration:

```bash
# Buat database
php artisan migrate

# (Optional) Isi data dummy
php artisan db:seed
```

### 5. Setup Storage (PENTING untuk Gambar!)

```bash
# Link storage folder untuk akses gambar
php artisan storage:link
```

### 6. Build Assets

```bash
# Compile CSS/JS
npm run build

# Atau untuk development
npm run dev
```

### 7. Jalankan Aplikasi

```bash
# Jalankan server development
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

---

## 👤 Default Login

### Admin
- Email: `admin@example.com`
- Password: `password`

### User
Silakan register melalui halaman registrasi.

---

## 📁 Struktur Folder Penting

```
storage/app/public/
├── menus/          # Gambar menu
├── promos/         # Gambar promo
├── gallery/        # Gambar galeri
├── settings/       # Logo & gambar settings
└── testimonials/   # Foto testimonial (jika ada)
```

**⚠️ PENTING:** Setelah extract, pastikan folder `storage/app/public` ada dan jalankan `php artisan storage:link`!

---

## 🔧 Troubleshooting

### Gambar tidak muncul?
1. Pastikan sudah jalankan `php artisan storage:link`
2. Cek folder `public/storage` sudah ter-create (symbolic link)
3. Cek permission folder `storage/` bisa di-write

### Error "500 Internal Server Error"?
1. Jalankan: `php artisan cache:clear`
2. Jalankan: `php artisan config:clear`
3. Cek file `.env` sudah di-setup dengan benar
4. Cek permission folder `storage/` dan `bootstrap/cache/`

### Composer error?
Pastikan PHP versi minimal **8.2**

### npm error?
Pastikan Node.js versi minimal **16.x**

---

## 📧 Support

Jika ada pertanyaan, hubungi developer.

---

## 🚀 Production Deployment

Untuk production, jangan lupa:

1. Set `APP_DEBUG=false` di `.env`
2. Set `APP_ENV=production` di `.env`
3. Jalankan `php artisan optimize`
4. Setup proper web server (Apache/Nginx)
5. Setup SSL certificate
6. Setup database backup
7. Setup proper file permissions

---

**Developed with ❤️ for Asya's Kitchen**
