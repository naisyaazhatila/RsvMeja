#!/bin/bash

# Quick Setup Script untuk Restaurant Reservation System
# Jalankan: ./quick-setup.sh

echo "Starting Quick Setup..."
echo ""

# 1. Copy .env
echo "Step 1: Setting up environment file..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ .env file created"
else
    echo "⚠️  .env already exists, skipping..."
fi
echo ""

# 2. Install PHP dependencies
echo "Step 2: Installing PHP dependencies..."
if command -v composer &> /dev/null; then
    composer install --no-interaction
    echo "✅ Composer dependencies installed"
else
    echo "❌ Composer not found! Please install Composer first."
    exit 1
fi
echo ""

# 3. Install Node dependencies
echo "Step 3: Installing Node.js dependencies..."
if command -v npm &> /dev/null; then
    npm install
    echo "✅ Node dependencies installed"
else
    echo "❌ npm not found! Please install Node.js first."
    exit 1
fi
echo ""

# 4. Generate application key
echo "Step 4: Generating application key..."
php artisan key:generate
echo "✅ Application key generated"
echo ""

# 5. Create SQLite database if not exists
echo "Step 5: Setting up database..."
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
    echo "✅ SQLite database file created"
else
    echo "⚠️  Database file already exists"
fi
echo ""

# 6. Run migrations
echo "Step 6: Running database migrations..."
php artisan migrate --force
echo "✅ Database migrated"
echo ""

# 7. Seed database (optional)
read -p "Do you want to seed sample data? (y/n): " -n 1 -r
echo ""
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan db:seed
    echo "✅ Database seeded with sample data"
fi
echo ""

# 8. Create storage link
echo "Step 7: Creating storage symbolic link..."
php artisan storage:link
echo "✅ Storage linked"
echo ""

# 9. Build assets
echo "Step 8: Building frontend assets..."
npm run build
echo "✅ Assets built"
echo ""

# 10. Clear cache
echo "Step 9: Clearing caches..."
php artisan optimize:clear
echo "✅ Caches cleared"
echo ""

echo "✅✅✅ Setup completed successfully! ✅✅✅"
echo ""
echo "📋 Next steps:"
echo "1. Edit .env file to configure email and other settings"
echo "2. Run: php artisan serve"
echo "3. Visit: http://localhost:8000"
echo ""
echo "📧 Default Admin Login:"
echo "   Email: admin@example.com"
echo "   Password: password"
echo ""
echo "📖 Read SETUP-ENV-GUIDE.md for detailed configuration"
echo ""
echo "🎉 Happy coding!"
