# 🍽️ PANDUAN INSTALASI - Restaurant Reservation System

Terima kasih sudah menggunakan sistem reservasi restoran ini! 
Ikuti langkah-langkah di bawah untuk instalasi.

---

## 📋 PERSIAPAN

### Software yang Dibutuhkan:
1. **PHP** versi 8.2 atau lebih baru
   - Download: https://www.php.net/downloads
   
2. **Composer** (PHP Package Manager)
   - Download: https://getcomposer.org/download/
   
3. **Node.js** versi 16.x atau lebih baru
   - Download: https://nodejs.org/
   
4. **MySQL** atau **SQLite** (untuk database)
   - MySQL: https://www.mysql.com/downloads/
   - SQLite: Sudah include di PHP

### Cek Instalasi:
Buka terminal/command prompt dan jalankan:
```bash
php -v
composer -v
node -v
npm -v
```

Pastikan semuanya terinstall dengan benar.

---

## 🚀 LANGKAH INSTALASI

### 1. Extract File ZIP
Extract file ZIP yang sudah dikirim ke folder yang Anda inginkan.
Contoh: `C:\xampp\htdocs\RsvMeja` atau `/var/www/RsvMeja`

### 2. Buka Terminal/Command Prompt
Masuk ke folder project:
```bash
cd C:\xampp\htdocs\RsvMeja
# atau
cd /var/www/RsvMeja
```

### 3. Install Dependencies PHP
```bash
composer install
```
**Tunggu sampai selesai** (5-10 menit tergantung koneksi internet)

### 4. Install Dependencies Node.js
```bash
npm install
```
**Tunggu sampai selesai** (3-5 menit)

### 5. Setup File Environment (.env)

#### Copy file .env.example menjadi .env:
**Windows:**
```bash
copy .env.example .env
```

**Mac/Linux:**
```bash
cp .env.example .env
```

#### Edit file .env dengan text editor:
Buka file `.env` dan sesuaikan konfigurasi berikut:

```env
APP_NAME="Asya's Kitchen"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database - Pilih salah satu:

# Opsi 1: SQLite (Sederhana - Recommended untuk pemula)
DB_CONNECTION=sqlite

# Opsi 2: MySQL (Untuk production)
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=rsvmeja
# DB_USERNAME=root
# DB_PASSWORD=
```

**Simpan file .env**

### 6. Generate Application Key
```bash
php artisan key:generate
```

### 7. Setup Database

#### Jika Pakai SQLite (Recommended):
Buat file database:

**Windows:**
```bash
type nul > database\database.sqlite
```

**Mac/Linux:**
```bash
touch database/database.sqlite
```

#### Jika Pakai MySQL:
1. Buka phpMyAdmin atau MySQL client
2. Buat database baru:
```sql
CREATE DATABASE rsvmeja CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
3. Edit .env dan uncomment baris MySQL (hapus tanda #)

### 8. Jalankan Database Migration
```bash
php artisan migrate
```

Ketik **yes** jika ditanya konfirmasi.

### 9. (Opsional) Isi Data Sample
Jika ingin data contoh (menu, testimoni, dll):
```bash
php artisan db:seed
```

### 10. Link Storage untuk Gambar (PENTING!)
```bash
php artisan storage:link
```

### 11. Build Frontend Assets
```bash
npm run build
```

**Tunggu sampai selesai** (2-3 menit)

### 12. Clear Cache
```bash
php artisan optimize:clear
```

---

## ▶️ MENJALANKAN APLIKASI

### Development (Local):
```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

### Production (Web Server):
- Upload semua file ke hosting
- Arahkan domain ke folder `public/`
- Pastikan .env sudah dikonfigurasi dengan benar

---

## 👤 LOGIN ADMIN

Setelah aplikasi berjalan, login dengan:

**Email:** `admin@example.com`  
**Password:** `password`

**⚠️ PENTING:** Setelah login pertama kali, ubah password admin di menu Profile!

---

## 📧 KONFIGURASI EMAIL (Opsional)

### Untuk Testing (Mailtrap):
1. Daftar gratis di https://mailtrap.io
2. Dapatkan SMTP credentials
3. Edit file .env:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username_here
MAIL_PASSWORD=your_password_here
MAIL_ENCRYPTION=tls
```

### Untuk Production (Gmail):
1. Aktifkan 2-Step Verification di akun Gmail
2. Generate App Password di: https://myaccount.google.com/apppasswords
3. Edit file .env:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your_app_password_here
MAIL_ENCRYPTION=tls
```

Setelah edit .env, jalankan:
```bash
php artisan config:clear
```

---

## 🔧 TROUBLESHOOTING

### Error: "No application encryption key has been specified"
**Solusi:**
```bash
php artisan key:generate
php artisan config:clear
```

### Gambar tidak muncul
**Solusi:**
```bash
php artisan storage:link
```
Cek folder `public/storage` sudah ada (symbolic link)

### Error 500 Internal Server Error
**Solusi:**
1. Cek file .env sudah benar
2. Jalankan:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```
3. Cek permission folder `storage/` dan `bootstrap/cache/` (harus writable)

### Database connection error
**Solusi:**
- Cek DB_* configuration di .env
- Pastikan database sudah dibuat (jika MySQL)
- Pastikan file database.sqlite ada (jika SQLite)

### Composer install error
**Solusi:**
- Pastikan PHP versi minimal 8.2
- Jalankan: `composer install --ignore-platform-reqs` (temporary)
- Update Composer: `composer self-update`

### npm install error
**Solusi:**
- Pastikan Node.js versi minimal 16.x
- Hapus folder `node_modules` dan file `package-lock.json`
- Jalankan ulang: `npm install`

### Port 8000 sudah digunakan
**Solusi:**
```bash
php artisan serve --port=8001
```
Lalu akses: http://localhost:8001

---

## 📁 STRUKTUR FOLDER PENTING

```
RsvMeja/
├── app/                # Kode aplikasi
├── database/           # Migrations & seeders
├── public/             # Entry point (untuk web server)
│   └── storage/        # Link ke storage (gambar)
├── resources/          # Views & assets
├── storage/            # File uploads & cache
│   └── app/
│       └── public/     # Folder gambar upload
└── .env               # File konfigurasi (JANGAN di-commit ke Git!)
```

---

## 🔒 KEAMANAN (Untuk Production)

1. **Wajib** ubah `.env`:
```env
APP_ENV=production
APP_DEBUG=false
```

2. Ubah password admin default
3. Gunakan HTTPS (SSL Certificate)
4. Backup database secara berkala
5. Set file permissions yang benar:
```bash
chmod -R 755 storage bootstrap/cache
```

---

## 📞 BUTUH BANTUAN?

Jika mengalami masalah:
1. Cek file log di: `storage/logs/laravel.log`
2. Screenshoot error message
3. Hubungi developer dengan informasi:
   - Error message lengkap
   - Screenshot (jika ada)
   - Langkah yang sudah dilakukan

---

## 🎉 SELAMAT!

Sistem reservasi restoran sudah siap digunakan!

**Fitur yang tersedia:**
- ✅ Reservasi meja online
- ✅ Management menu
- ✅ Management promo
- ✅ Galeri
- ✅ Testimoni
- ✅ Laporan reservasi
- ✅ Notifikasi email & WhatsApp
- ✅ Dan masih banyak lagi!

**Selamat menggunakan! 🚀**
