#!/bin/bash

# Script untuk membuat package lengkap untuk client
# Termasuk semua gambar dari storage

echo "🚀 Membuat package untuk client..."

# Nama file zip
PACKAGE_NAME="RsvMeja-$(date +%Y%m%d-%H%M%S).zip"

# Buat zip dengan mengecualikan folder yang tidak perlu
zip -r "$PACKAGE_NAME" . \
  -x "*.git*" \
  -x "*node_modules/*" \
  -x "*vendor/*" \
  -x "*.env" \
  -x "*storage/logs/*" \
  -x "*storage/framework/cache/*" \
  -x "*storage/framework/sessions/*" \
  -x "*storage/framework/views/*" \
  -x "*bootstrap/cache/*" \
  -x "*.DS_Store" \
  -x "*create-package.sh"

echo "✅ Package berhasil dibuat: $PACKAGE_NAME"
echo ""
echo "📋 Instruksi untuk client:"
echo "1. Extract file zip"
echo "2. Jalankan: composer install"
echo "3. Jalankan: npm install"
echo "4. Copy .env.example ke .env"
echo "5. Jalankan: php artisan key:generate"
echo "6. Jalankan: php artisan storage:link"
echo "7. Jalankan: php artisan migrate"
echo "8. Jalankan: npm run build"
echo "9. Jalankan: php artisan serve"
