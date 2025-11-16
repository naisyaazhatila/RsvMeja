# Restaurant Reservation System - RsvMeja

Website reservasi restoran lengkap menggunakan **Laravel 11**, **Livewire 3**, dan **Tailwind CSS** dengan desain modern minimalis bertema krem, putih, dan coklat kayu.

---

## ✅ Apa yang Sudah Dibuat

### 1. **Project Setup & Configuration**
- ✅ Laravel 11 sudah terinstall dan dikonfigurasi
- ✅ Livewire 3 untuk reactive components
- ✅ Laravel Breeze untuk authentication
- ✅ Intervention Image untuk image handling
- ✅ Maatwebsite Excel untuk export reports
- ✅ Tailwind CSS dengan custom configuration

### 2. **Custom Design System**
✅ **Color Palette:**
- Primary Cream: `#FFF8E7`, `#F5E6D3`
- Secondary Wood Brown: `#8B4513`, `#A0522D`, `#6B4423`
- Accent Ivory White: `#FFFFF0`, `#FAFAF5`
- Text Dark Brown: `#3E2723`, `#4E342E`

✅ **Typography:**
- Heading Font: 'Playfair Display' (elegant serif)
- Body Font: 'Inter' (modern sans-serif)

✅ **Custom CSS Components:**
- `.btn`, `.btn-primary`, `.btn-secondary`, `.btn-outline`
- `.card`
- `.input-field`
- Custom animations: `fade-in`, `slide-up`, `scale-in`

### 3. **Database Architecture**
✅ **8 Tables dengan Migrations:**
1. **tables** - Denah meja restoran (15 tables with capacity 2-8 people)
2. **reservations** - Sistem reservasi dengan booking code otomatis
3. **menus** - Menu makanan/minuman (25 Indonesian dishes)
4. **menu_categories** - Kategori menu (4 categories)
5. **promos** - Promo dan diskon (5 promos, 2 active)
6. **testimonials** - Review pelanggan (10 testimonials, 5 featured)
7. **settings** - Pengaturan sistem (13 settings)
8. **gallery_images** - Galeri foto (20 images across 4 categories)

### 4. **Eloquent Models**
✅ **8 Models dengan Relationships & Logic:**

**Table Model:**
- Relationships: `hasMany(Reservation)`
- Scopes: `active()`, `available($date, $time)`
- Method: `isAvailable($date, $time)`

**Reservation Model:**
- Relationships: `belongsTo(Table)`, `belongsTo(User, 'confirmed_by')`
- Scopes: `pending()`, `confirmed()`, `cancelled()`, `today()`, `upcoming()`
- Auto-generates booking code: `RES-YYYYMMDD-XXXX`
- Methods: `confirm($adminId)`, `cancel()`
- Phone number formatter (08xxx → 62xxx)

**Menu Model:**
- Relationship: `belongsTo(MenuCategory)`
- Scopes: `available()`, `vegetarian()`, `spicy()`, `byCategory()`, `popular()`
- Accessor: `formatted_price` (Rupiah format)
- Method: `incrementViewCount()`

**MenuCategory Model:**
- Relationship: `hasMany(Menu)`
- Auto-generates slug from name

**Promo Model:**
- Scopes: `active()`, `current()` (valid today)
- Accessor: `is_expiring_soon` (< 7 days)
- Method: `calculateDiscount($amount)`

**Testimonial Model:**
- Scope: `featured()`
- Accessor: `star_rating` (emoji stars)

**Setting Model:**
- Static methods: `Setting::get($key)`, `Setting::set($key, $value)`
- Cache implementation (1 hour)

**GalleryImage Model:**
- Scopes: `active()`, `byCategory()`, `ordered()`
- Accessors: `image_url`, `thumbnail_url`

### 5. **Helper Functions**
✅ File: `app/Helpers/helpers.php`
- `setting($key, $default)` - Get setting value with cache
- `format_rupiah($amount)` - Format number to Rupiah
- `format_phone($phone)` - Convert 08xxx to 628xxx for WhatsApp
- `booking_code()` - Generate unique booking code
- `whatsapp_link($phone, $message)` - Generate WhatsApp link

### 6. **Database Seeders**
✅ **Realistic Indonesian Data:**

**UserSeeder:**
- Admin: `admin@restaurant.com` / `password`

**SettingSeeder:**
- Restaurant Name: "Restaurant Nusantara"
- Address, phone, email, operating hours
- Bank account untuk DP payment
- WhatsApp, Instagram, Facebook links

**TableSeeder:**
- 15 meja dengan grid layout positioning
- 4 meja @ 2 orang, 6 meja @ 4 orang, 3 meja @ 6 orang, 2 meja @ 8 orang

**MenuCategorySeeder:**
- Makanan Pembuka, Makanan Utama, Minuman, Dessert

**MenuSeeder:**
- 25 menu Indonesian dishes:
  - Gado-Gado Jakarta, Lumpia Semarang
  - Nasi Goreng Kambing, Rendang Padang, Soto Ayam Lamongan
  - Ayam Bakar Taliwang, Ikan Bakar Jimbaran, Rawon Setan
  - Es Cendol Durian, Jus Alpukat, Wedang Uwuh
  - Es Pisang Ijo, Klepon, Martabak Manis Mini
- 32% vegetarian, 20% spicy dengan level

**PromoSeeder:**
- 2 active promos, 3 expired
- Mix of percentage dan fixed discount

**TestimonialSeeder:**
- 10 Indonesian names dengan realistic comments
- Rating 4-5 stars

**GalleryImageSeeder:**
- 20 images: food, interior, ambiance, event

---

## 🚧 Apa yang Masih Perlu Dibuat

### PRIORITY 1: Core Public Pages

#### 1. Landing Page (Welcome Page)
**Route:** `GET /`
**File:** `resources/views/welcome.blade.php`

**Sections yang diperlukan:**
- ✅ Navigation Bar (fixed top, backdrop blur)
- ✅ Hero Section (full viewport, background image overlay)
- ✅ About Section (2 kolom: image | text dengan stats)
- ✅ Featured Menu Section (grid 4 kolom, 8 menu popular)
- ✅ Testimonials Section (carousel/slider, 3 cards visible)
- ✅ Promo Banner (conditional, hanya jika ada promo aktif)
- ✅ Call-to-Action Section (background wood-500)
- ✅ Footer (3 kolom: contact, links, social media)

**Controller:** `app/Http/Controllers/HomeController.php`
```php
public function index()
{
    $featuredMenus = Menu::available()->popular(8)->get();
    $testimonials = Testimonial::featured()->get();
    $activePromo = Promo::current()->first();

    return view('welcome', compact('featuredMenus', 'testimonials', 'activePromo'));
}
```

#### 2. Menu Page
**Route:** `GET /menu`
**File:** `resources/views/menu/index.blade.php`

**Features:**
- Search by name
- Filter by category
- Filter by preferences (vegetarian, spicy)
- Filter by price range
- Grid layout dengan cards
- Click untuk view detail (increment view_count)

**Controller:** `app/Http/Controllers/MenuController.php`
```php
public function index(Request $request)
{
    $query = Menu::with('category')->available();

    if ($request->search) {
        $query->where('name', 'like', '%'.$request->search.'%');
    }

    if ($request->category_id) {
        $query->byCategory($request->category_id);
    }

    if ($request->vegetarian) {
        $query->vegetarian();
    }

    // ... more filters

    $menus = $query->ordered()->paginate(12);
    $categories = MenuCategory::active()->ordered()->get();

    return view('menu.index', compact('menus', 'categories'));
}
```

#### 3. Gallery Page
**Route:** `GET /galeri`
**File:** `resources/views/gallery/index.blade.php`

**Features:**
- Filter by category (all, interior, food, ambiance, event)
- Masonry grid layout
- Lightbox untuk fullscreen view
- Navigation arrows di lightbox
- Swipe support untuk mobile

**Controller:** `app/Http/Controllers/GalleryController.php`

#### 4. Promo Page
**Route:** `GET /promo`
**File:** `resources/views/promo/index.blade.php`

**Features:**
- List semua promo aktif
- Card layout dengan image, title, description
- Discount badge prominent
- Valid period
- Terms & conditions

**Controller:** `app/Http/Controllers/PromoController.php`

### PRIORITY 2: Reservation System (CRITICAL)

#### 5. Multi-Step Reservation Form
**Route:** `GET /reservasi`
**Livewire Component:** `app/Livewire/ReservationForm.php`
**View:** `resources/views/livewire/reservation-form.blade.php`

**4 Steps:**

**Step 1: Info Dasar**
- Date picker (min: today, max: 3 months)
- Time select (11:00-22:00, interval 30 min)
- Number of people (1-12)
- Button "Cari Meja Tersedia"

**Step 2: Pilih Meja**
- Visual grid semua tables
- Real-time availability check
- Green = available, Red = booked, Blue = selected
- Show capacity untuk each table

**Step 3: Data Pelanggan**
- Nama lengkap
- Email
- Nomor telepon (format Indonesia)
- Special request (textarea)
- Checkbox: Setuju syarat & ketentuan
- Summary sidebar: tanggal, waktu, meja, DP amount

**Step 4: Payment Instruction**
- Booking code displayed
- DP amount yang harus dibayar
- Bank transfer details
- Langkah-langkah pembayaran
- WhatsApp link untuk kirim bukti transfer

**Logic:**
```php
// Step 1 → Step 2
$availableTables = Table::available($date, $time)
    ->where('capacity', '>=', $numberOfPeople)
    ->get();

// Step 3 → Step 4 (Save Reservation)
Reservation::create([
    'table_id' => $selectedTableId,
    'customer_name' => $name,
    'customer_email' => $email,
    'customer_phone' => $phone,
    'reservation_date' => $date,
    'reservation_time' => $time,
    'number_of_people' => $numberOfPeople,
    'special_request' => $specialRequest,
    'dp_amount' => setting('dp_amount'),
    'status' => 'pending',
    // booking_code auto-generated by model observer
]);
```

### PRIORITY 3: Admin Panel

#### 6. Admin Dashboard
**Route:** `GET /admin/dashboard`
**Middleware:** `auth`, `admin`
**Controller:** `app/Http/Controllers/Admin/DashboardController.php`

**Widgets:**
- Total reservations today
- Pending confirmations
- Revenue this month
- Popular menus
- Chart: Reservations per day (last 7 days)
- Chart: Revenue per month (last 6 months)
- Recent reservations table

**Requirements:**
- Install Chart.js via CDN atau npm
- Use Blade components untuk reusable widgets

#### 7. Admin Reservation Management
**Route:** `GET /admin/reservasi`
**Controller:** `app/Http/Controllers/Admin/ReservationController.php`

**Features:**
- List all reservations (paginated)
- Filter by status (pending, confirmed, cancelled)
- Filter by date range
- Search by booking code, customer name
- Actions:
  - **Confirm:** Update status, confirmed_at, confirmed_by, send email
  - **Cancel:** Update status to cancelled
  - **View Details:** Modal dengan full info
- Export to Excel (date range filter)

**Confirm Logic:**
```php
public function confirm(Reservation $reservation)
{
    $reservation->confirm(auth()->id());

    // TODO: Send confirmation email
    Mail::to($reservation->customer_email)
        ->send(new ReservationConfirmed($reservation));

    return redirect()->back()->with('success', 'Reservasi berhasil dikonfirmasi');
}
```

#### 8. Admin Menu Management
**Route:** `resource /admin/menu`
**Controller:** `app/Http/Controllers/Admin/MenuController.php`

**CRUD Features:**
- Create, Read, Update, Delete
- Image upload dengan Intervention Image (resize to 800x600)
- Toggle availability (quick action)
- Reorder (drag & drop optional)

#### 9. Admin Table Management
**Route:** `resource /admin/meja`
**Controller:** `app/Http/Controllers/Admin/TableController.php`

**CRUD Features:**
- Add/edit tables
- Set capacity, position (x, y)
- Toggle active status
- Visual layout preview (optional)

#### 10. Admin Settings
**Route:** `GET /admin/pengaturan`, `POST /admin/pengaturan`
**Controller:** `app/Http/Controllers/Admin/SettingController.php`

**Form Groups:**
- Restaurant Info (name, address, phone, email, hours)
- Payment Settings (bank name, account number, holder, DP amount)
- Social Media (WhatsApp, Instagram, Facebook)
- Save semua settings menggunakan `Setting::set()`

---

## 📋 Implementation Roadmap

### Phase 1: Setup Routes (15 menit)
File: `routes/web.php`

```php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PromoController;
use App\Livewire\ReservationForm;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
Route::get('/promo', [PromoController::class, 'index'])->name('promo');
Route::get('/reservasi', ReservationForm::class)->name('reservation');

// Admin Routes (already have Breeze auth)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('reservasi', Admin\ReservationController::class);
    Route::post('reservasi/{reservation}/confirm', [Admin\ReservationController::class, 'confirm'])->name('reservasi.confirm');
    // ... more admin routes
});
```

### Phase 2: Create Controllers (30 menit)
Generate semua controllers:
```bash
php artisan make:controller HomeController
php artisan make:controller MenuController
php artisan make:controller GalleryController
php artisan make:controller PromoController
php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/ReservationController --resource
php artisan make:controller Admin/MenuController --resource
php artisan make:controller Admin/TableController --resource
php artisan make:controller Admin/SettingController
```

Isi dengan logic sesuai contoh di atas.

### Phase 3: Create Views (2-4 jam)
**Prioritas Tinggi:**
1. `resources/views/layouts/app.blade.php` - Main layout
2. `resources/views/partials/navbar.blade.php` - Navigation
3. `resources/views/partials/footer.blade.php` - Footer
4. `resources/views/welcome.blade.php` - Landing page
5. `resources/views/menu/index.blade.php` - Menu listing
6. `resources/views/livewire/reservation-form.blade.php` - Reservation wizard

**Tips untuk Views:**
- Gunakan Tailwind utility classes sesuai design system
- Reuse components dengan `@include` atau Blade components
- Gunakan AlpineJS untuk interactive elements (sudah include di Livewire)
- Placeholder images: `https://via.placeholder.com/800x600`

### Phase 4: Create Livewire Reservation Component (2 jam)
```bash
php artisan make:livewire ReservationForm
```

Implement 4-step wizard dengan state management:
- `$currentStep` (1-4)
- `$date`, `$time`, `$numberOfPeople`
- `$availableTables`, `$selectedTableId`
- `$customerData` (name, email, phone, special_request)
- Methods: `nextStep()`, `previousStep()`, `findAvailableTables()`, `submitReservation()`

### Phase 5: Admin Panel (3-4 jam)
1. Admin Dashboard dengan widgets & charts
2. Reservation management dengan confirm/cancel
3. Menu, Table, Settings CRUD
4. Excel export untuk reports

### Phase 6: Email System (1-2 jam)
```bash
php artisan make:mail ReservationConfirmed --markdown=emails.reservation-confirmed
php artisan make:mail ReservationCreated --markdown=emails.reservation-created
```

Setup `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io  # atau Gmail
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@restaurant.com
MAIL_FROM_NAME="${APP_NAME}"

QUEUE_CONNECTION=database
```

Run queue worker:
```bash
php artisan queue:work
```

### Phase 7: Testing & Refinement (2 jam)
- Test semua flows
- Fix bugs
- Optimize queries
- Add loading states
- Improve UX

---

## 🚀 Quick Start untuk Development

### 1. Test Database
```bash
php artisan migrate:fresh --seed
```

### 2. Start Development Server
```bash
# Terminal 1: Laravel
php artisan serve

# Terminal 2: Vite (for hot reload)
npm run dev

# Terminal 3: Queue worker (untuk email)
php artisan queue:work
```

### 3. Access Application
- Public: http://localhost:8000
- Admin: http://localhost:8000/login
  - Email: `admin@restaurant.com`
  - Password: `password`

### 4. Check Data
```bash
php artisan tinker
```
```php
// Check tables
\App\Models\Table::count();

// Check menus
\App\Models\Menu::with('category')->get();

// Check settings
\App\Models\Setting::pluck('value', 'key');
```

---

## 🎨 Design Guidelines (NO EMOJI!)

### Typography
- **Headings:** Use `.font-heading` class
- **Body:** Default font is already Inter
- **Sizes:** `text-5xl`, `text-4xl`, `text-2xl`, `text-base`, `text-sm`

### Colors
```html
<!-- Backgrounds -->
<div class="bg-cream-100">Light cream background</div>
<div class="bg-wood-500">Wood brown background</div>
<div class="bg-ivory">Ivory white background</div>

<!-- Text -->
<p class="text-bark-900">Dark brown text</p>
<p class="text-wood-600">Medium wood text</p>

<!-- Buttons -->
<button class="btn btn-primary">Primary Button</button>
<button class="btn btn-secondary">Secondary Button</button>
<button class="btn btn-outline">Outline Button</button>
```

### Spacing & Layout
- **Container:** `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8`
- **Section Padding:** `py-16 md:py-24`
- **Grid:** `grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8`

### Cards
```html
<div class="card p-6">
    <h3 class="font-heading text-2xl mb-4">Card Title</h3>
    <p class="text-gray-600">Card content</p>
</div>
```

### Forms
```html
<input type="text" class="input-field" placeholder="Enter your name">
```

---

## 📚 Useful Commands

### Generate Components
```bash
# Controllers
php artisan make:controller ControllerName

# Livewire Components
php artisan make:livewire ComponentName

# Blade Components
php artisan make:component ComponentName

# Mailable
php artisan make:mail MailableName
```

### Database
```bash
# Fresh migration dengan seed
php artisan migrate:fresh --seed

# Rollback last migration
php artisan migrate:rollback

# Create seeder
php artisan make:seeder SeederName
```

### Cache & Optimization
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Rebuild for production
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔧 Troubleshooting

### Tailwind classes tidak muncul
```bash
npm run dev  # Pastikan Vite running
```

### Database error
```bash
# Check database connection di .env
DB_CONNECTION=sqlite  # Default
DB_DATABASE=/full/path/to/database.sqlite
```

### Livewire tidak reactive
- Pastikan `@livewireStyles` di `<head>`
- Pastikan `@livewireScripts` sebelum `</body>`
- Check browser console untuk errors

### Image tidak muncul
```bash
php artisan storage:link  # Create symlink
```

---

## 📝 Next Steps

1. **Start dengan Landing Page** - Ini yang paling user-facing
2. **Kemudian Reservation System** - Core functionality
3. **Menu Page** - Supporting content
4. **Admin Panel** - Backend management
5. **Email System** - Notifications
6. **Polish & Testing** - Final touches

**Estimasi Total Development Time:** 12-16 jam untuk full implementation

---

## 📞 Support

Jika ada pertanyaan atau butuh bantuan:
- Check Laravel docs: https://laravel.com/docs/11.x
- Check Livewire docs: https://livewire.laravel.com/docs
- Check Tailwind docs: https://tailwindcss.com/docs

---

**Good luck with your restaurant reservation system! 🍽️**

*Project Foundation by Claude Code - Ready for Full Development*
