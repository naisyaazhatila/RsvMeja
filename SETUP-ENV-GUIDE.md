# 🔧 Panduan Setup Environment (.env)

## 📝 Langkah Setup .env

### 1. Copy File .env.example

```bash
cp .env.example .env
```

### 2. Generate Application Key

```bash
php artisan key:generate
```

### 3. Edit File .env

Buka file `.env` dengan text editor, lalu sesuaikan konfigurasi berikut:

---

## ⚙️ Konfigurasi Penting

### A. Aplikasi Dasar

```env
APP_NAME="Asya's Kitchen"
APP_ENV=local                    # Gunakan 'production' saat live
APP_DEBUG=true                   # Ubah ke 'false' saat production
APP_TIMEZONE=Asia/Jakarta        # Sesuaikan timezone
APP_URL=http://localhost:8000    # Ubah dengan domain production
```

---

### B. Database Configuration

#### **Pilihan 1: SQLite (Sederhana - Recommended untuk Development)**

```env
DB_CONNECTION=sqlite
# DB_HOST, DB_PORT, dll tidak perlu untuk SQLite
```

Lalu buat file database:
```bash
touch database/database.sqlite
```

#### **Pilihan 2: MySQL (Recommended untuk Production)**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rsvmeja              # Nama database Anda
DB_USERNAME=root                 # Username MySQL
DB_PASSWORD=                     # Password MySQL (kosongkan jika tidak ada)
```

Buat database dulu:
```sql
CREATE DATABASE rsvmeja CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### **Pilihan 3: PostgreSQL**

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=rsvmeja
DB_USERNAME=postgres
DB_PASSWORD=password
```

---

### C. Email Configuration (Untuk Notifikasi)

#### **Pilihan 1: Mailtrap (Testing - Free)**

Daftar di https://mailtrap.io

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@asyaskitchen.com"
MAIL_FROM_NAME="${APP_NAME}"
```

#### **Pilihan 2: Gmail (Production)**

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password      # Bukan password Gmail biasa!
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**⚠️ Penting untuk Gmail:**
- Aktifkan "2-Step Verification" di Google Account
- Generate "App Password" di: https://myaccount.google.com/apppasswords
- Gunakan App Password, bukan password Gmail biasa!

#### **Pilihan 3: Mailgun / SendGrid / Amazon SES**

Ikuti dokumentasi masing-masing provider.

---

### D. WhatsApp Integration (Opsional)

```env
WHATSAPP_API_URL=https://api.whatsapp.com/send
WHATSAPP_NUMBER=628123456789     # Nomor admin restoran (format: 628xx)
```

---

### E. File Storage

```env
FILESYSTEM_DISK=public           # Gunakan local public storage
```

---

### F. Queue (Untuk Background Jobs)

#### Development:
```env
QUEUE_CONNECTION=sync            # Langsung execute tanpa queue
```

#### Production (Recommended):
```env
QUEUE_CONNECTION=database        # Gunakan database queue
```

Jika pakai database queue, jalankan:
```bash
php artisan queue:work --daemon
```

---

### G. Session & Cache

#### Development:
```env
SESSION_DRIVER=file
CACHE_DRIVER=file
```

#### Production (Recommended):
```env
SESSION_DRIVER=database          # atau 'redis'
CACHE_DRIVER=redis               # Lebih cepat
```

---

## 📋 Contoh File .env Lengkap

### **Untuk Development (Local)**

```env
APP_NAME="Asya's Kitchen"
APP_ENV=local
APP_KEY=                         # Akan di-generate otomatis
APP_DEBUG=true
APP_TIMEZONE=Asia/Jakarta
APP_URL=http://localhost:8000

# Database SQLite (Sederhana)
DB_CONNECTION=sqlite

# Email Testing dengan Mailtrap
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@asyaskitchen.com"
MAIL_FROM_NAME="${APP_NAME}"

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# WhatsApp
WHATSAPP_NUMBER=628123456789

# Storage
FILESYSTEM_DISK=public

# Broadcasting (tidak digunakan saat ini)
BROADCAST_DRIVER=log
```

---

### **Untuk Production (Live Server)**

```env
APP_NAME="Asya's Kitchen"
APP_ENV=production
APP_KEY=                         # Generate dengan: php artisan key:generate
APP_DEBUG=false                  # WAJIB false di production!
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://asyaskitchen.com

# Database MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rsvmeja_production
DB_USERNAME=db_user
DB_PASSWORD=strong_password_here

# Email dengan Gmail atau SMTP Provider
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info@asyaskitchen.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@asyaskitchen.com"
MAIL_FROM_NAME="${APP_NAME}"

# Session & Cache dengan Redis (Lebih cepat)
SESSION_DRIVER=redis
CACHE_DRIVER=redis
QUEUE_CONNECTION=database

# Redis Configuration
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# WhatsApp
WHATSAPP_NUMBER=628123456789

# Storage
FILESYSTEM_DISK=public

# Broadcasting
BROADCAST_DRIVER=log
```

---

## 🚀 Setelah Setup .env

Jalankan perintah berikut:

```bash
# 1. Generate application key
php artisan key:generate

# 2. Link storage (PENTING untuk gambar!)
php artisan storage:link

# 3. Jalankan migration
php artisan migrate

# 4. (Opsional) Seed data dummy
php artisan db:seed

# 5. Clear semua cache
php artisan optimize:clear

# 6. Build assets
npm run build

# 7. Jalankan server
php artisan serve
```

---

## 🔍 Troubleshooting

### Email tidak terkirim?
- Cek MAIL_* configuration di .env
- Test dengan: `php artisan tinker` lalu `Mail::raw('Test', function($m){$m->to('test@test.com')->subject('Test');});`
- Cek log di `storage/logs/laravel.log`

### Gambar tidak muncul?
- Pastikan sudah jalankan `php artisan storage:link`
- Cek folder `public/storage` ada (symbolic link)
- Cek permission folder `storage/` (777 atau 755)

### Database error?
- Pastikan database sudah dibuat
- Cek kredensial DB_* di .env
- Untuk SQLite, pastikan file `database/database.sqlite` ada dan writable

### APP_KEY error?
- Jalankan: `php artisan key:generate`

---

## ⚠️ Keamanan Production

1. **WAJIB** set `APP_DEBUG=false`
2. **WAJIB** gunakan password database yang kuat
3. **JANGAN** commit file `.env` ke Git
4. Gunakan HTTPS (SSL Certificate)
5. Set proper file permissions:
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

---

## 📞 Bantuan Lebih Lanjut

Jika ada masalah, cek:
1. `storage/logs/laravel.log` - Log error aplikasi
2. Browser Console - Error JavaScript
3. Server error logs

---

**Happy Coding! 🚀**
