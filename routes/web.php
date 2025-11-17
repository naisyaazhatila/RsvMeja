<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    MenuController,
    GalleryController,
    PromoController,
    ProfileController,
    MyReservationController,
    PaymentInstructionController
};
use App\Http\Controllers\Admin\{
    DashboardController,
    ReservationController as AdminReservationController,
    MenuController as AdminMenuController,
    PromoController as AdminPromoController,
    TestimonialController,
    GalleryController as AdminGalleryController,
    TableController,
    SettingController,
    ReportController
};
use App\Livewire\ReservationForm;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/promo', [HomeController::class, 'promos'])->name('promos');
Route::get('/reservasi', ReservationForm::class)->name('reservation')->middleware('auth');
Route::get('/reservasi/{bookingCode}/payment', [PaymentInstructionController::class, 'show'])->name('payment.instruction');
Route::get('/my-reservations', [MyReservationController::class, 'index'])->name('my-reservations')->middleware('auth');
Route::get('/my-reservations/{reservation}', [MyReservationController::class, 'show'])->name('my-reservations.show')->middleware('auth');
Route::get('/kontak', function () { return view('contact'); })->name('contact');
Route::post('/kontak/send', function () { 
    return back()->with('success', 'Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.'); 
})->name('contact.send');
Route::get('/kebijakan-privasi', function () { return view('privacy'); })->name('privacy');
Route::get('/syarat-ketentuan', function () { return view('terms'); })->name('terms');
Route::post('/newsletter/subscribe', function () { 
    return back()->with('success', 'Terima kasih telah berlangganan newsletter kami!'); 
})->name('newsletter.subscribe');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Reservations Management
    Route::get('/reservasi', [AdminReservationController::class, 'index'])->name('reservasi.index');
    Route::get('/reservasi/{reservation}', [AdminReservationController::class, 'show'])->name('reservasi.show');
    Route::post('/reservasi/{reservation}/confirm', [AdminReservationController::class, 'confirm'])->name('reservasi.confirm');
    Route::post('/reservasi/{reservation}/cancel', [AdminReservationController::class, 'cancel'])->name('reservasi.cancel');
    Route::post('/reservasi/{reservation}/confirm-payment', [AdminReservationController::class, 'confirmPayment'])->name('reservasi.confirmPayment');
    Route::post('/reservasi/{reservation}/reject-payment', [AdminReservationController::class, 'rejectPayment'])->name('reservasi.rejectPayment');
    Route::delete('/reservasi/{reservation}', [AdminReservationController::class, 'destroy'])->name('reservasi.destroy');

    // Menu CRUD
    Route::resource('menu', AdminMenuController::class);
    Route::post('/menu/{menu}/toggle', [AdminMenuController::class, 'toggleAvailability'])->name('menu.toggle');

    // Promo CRUD
    Route::resource('promo', AdminPromoController::class);

    // Testimonial CRUD
    Route::resource('testimoni', TestimonialController::class);

    // Gallery CRUD
    Route::resource('galeri', AdminGalleryController::class);
    Route::post('/galeri/bulk-upload', [AdminGalleryController::class, 'bulkUpload'])->name('galeri.bulk-upload');

    // Tables CRUD
    Route::resource('meja', TableController::class);

    // Settings
    Route::get('/pengaturan', [SettingController::class, 'index'])->name('settings.index');
    Route::match(['put', 'patch'], '/pengaturan', [SettingController::class, 'update'])->name('settings.update');

    // Reports
    Route::get('/laporan', [ReportController::class, 'index'])->name('report.index');
    Route::get('/laporan/export', [ReportController::class, 'export'])->name('report.export');

    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
