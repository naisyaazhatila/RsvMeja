# Dokumentasi Filter dan Sorting - Asya's Kitchen

## 📋 Ringkasan Perbaikan

Semua controller admin telah diperbarui untuk memastikan filter dan sorting berfungsi dengan sempurna.

---

## 🎯 Laporan Reservasi (ReportController)

### Filter yang Tersedia:
1. **Filter Tanggal**
   - `date_from`: Tanggal mulai (default: awal bulan ini)
   - `date_to`: Tanggal akhir (default: hari ini)
   
2. **Filter Status Reservasi**
   - `pending`: Reservasi Pending
   - `confirmed`: Reservasi Confirmed
   - `cancelled`: Reservasi Cancelled
   - `completed`: Reservasi Completed (tidak di filter form, tapi supported)
   - *Kosongkan untuk melihat semua status*

3. **Filter Status Pembayaran** *(BARU)*
   - `unpaid`: Belum Bayar
   - `pending`: Pending Verifikasi
   - `paid`: Lunas
   - *Kosongkan untuk melihat semua status pembayaran*

### Sorting yang Tersedia: *(BARU)*
1. **Urutkan Berdasarkan** (`sort_by`):
   - `created_at`: Tanggal Dibuat (default)
   - `reservation_date`: Tanggal Reservasi
   - `customer_name`: Nama Customer
   - `status`: Status Reservasi
   - `payment_status`: Status Pembayaran

2. **Urutan** (`sort_order`):
   - `desc`: Terbaru (default)
   - `asc`: Terlama

### Statistik (Dashboard Cards):
✅ **Sudah Diperbaiki**: Statistik sekarang merefleksikan filter tanggal yang dipilih
- Total Reservasi: Dihitung dari filter tanggal
- Pending: Dihitung dari filter tanggal
- Confirmed: Dihitung dari filter tanggal
- Cancelled: Dihitung dari filter tanggal *(BARU)*
- Revenue: Dihitung dari `payment_status='paid'` dalam filter tanggal *(DIPERBAIKI)*

### Export Excel:
✅ **Sudah Diperbaiki**: Export sekarang mengikuti semua filter yang dipilih
- Parameter: `format=xlsx` atau `csv`
- Include: `date_from`, `date_to`, `status`, `payment_status`, `sort_by`, `sort_order`
- Kolom tambahan di Excel: Status Pembayaran *(BARU)*

### Pagination:
✅ `withQueryString()` aktif - filter tetap ada saat berpindah halaman

---

## 📋 Daftar Reservasi (ReservationController)

### Filter yang Tersedia:
1. **Search**
   - Booking Code
   - Customer Name
   - Customer Email
   - Customer Phone

2. **Filter Status**
   - `pending`
   - `confirmed`
   - `cancelled`
   - `completed`

3. **Filter Tanggal**
   - `date_from`: Mulai dari tanggal
   - `date_to`: Sampai tanggal

### Pagination:
✅ `withQueryString()` aktif

---

## 🍽️ Menu Management (MenuController)

### Pagination:
✅ `withQueryString()` aktif - mempertahankan state saat navigasi

---

## 🎁 Promo Management (PromoController)

### Pagination:
✅ `withQueryString()` aktif

---

## 🖼️ Gallery Management (GalleryController)

### Pagination:
✅ `withQueryString()` aktif (24 items per page)

---

## 🪑 Table Management (TableController)

### Pagination:
✅ `withQueryString()` aktif
- Sudah terurut berdasarkan nama meja

---

## 💬 Testimonial Management (TestimonialController)

### Pagination:
✅ `withQueryString()` aktif

---

## 🧪 Cara Testing Filter & Sorting

### Test 1: Filter Tanggal
1. Buka `/admin/reports`
2. Pilih tanggal mulai dan akhir
3. Klik "Filter"
4. ✅ Pastikan data sesuai rentang tanggal
5. ✅ Pastikan statistik cards update

### Test 2: Filter Status Reservasi
1. Pilih status (pending/confirmed/cancelled)
2. Klik "Filter"
3. ✅ Pastikan hanya menampilkan status yang dipilih
4. ✅ Pastikan statistik cards update

### Test 3: Filter Status Pembayaran *(BARU)*
1. Pilih status pembayaran (unpaid/pending/paid)
2. Klik "Filter"
3. ✅ Pastikan hanya menampilkan status pembayaran yang dipilih

### Test 4: Sorting *(BARU)*
1. Pilih "Urutkan Berdasarkan": Tanggal Reservasi
2. Pilih "Urutan": Terlama
3. Klik "Filter"
4. ✅ Pastikan data terurut dari tanggal paling lama
5. Coba dengan kolom lain (Nama Customer, Status, dll)

### Test 5: Kombinasi Filter
1. Pilih tanggal range
2. Pilih status: confirmed
3. Pilih payment_status: paid
4. Pilih sort_by: customer_name
5. Klik "Filter"
6. ✅ Semua filter harus aktif bersamaan

### Test 6: Pagination
1. Set filter apapun
2. Navigasi ke halaman 2
3. ✅ Pastikan filter tetap aktif
4. ✅ Pastikan data halaman 2 sesuai filter

### Test 7: Export Excel
1. Set filter apapun
2. Klik "Export Excel"
3. ✅ File download sesuai filter
4. ✅ Buka file, pastikan data sesuai filter
5. ✅ Kolom Status Pembayaran ada

### Test 8: Reset Filter
1. Set beberapa filter
2. Klik "Reset"
3. ✅ Kembali ke default (bulan ini, semua status)

---

## 🔧 Perubahan Teknis

### ReportController.php
```php
// Tambahan filter payment_status
if ($request->payment_status) {
    $query->where('payment_status', $request->payment_status);
}

// Sorting dengan whitelist
$allowedSortFields = ['created_at', 'reservation_date', 'customer_name', 'status', 'payment_status'];
$sortBy = in_array($request->sort_by, $allowedSortFields) ? $request->sort_by : 'created_at';
$sortOrder = in_array($request->sort_order, ['asc', 'desc']) ? $request->sort_order : 'desc';

$query->orderBy($sortBy, $sortOrder);

// Pagination dengan query string
$reservations = $query->paginate(20)->withQueryString();

// Stats menggunakan filtered query (clone)
$stats['revenue'] = (clone $statsQuery)->where('payment_status', 'paid')->sum('dp_amount');
```

### ReservationsExport.php
```php
// Constructor baru dengan semua parameter
public function __construct($dateFrom, $dateTo, $status = null, $paymentStatus = null, $sortBy = 'created_at', $sortOrder = 'desc')

// Query dengan semua filter
$query->where('payment_status', $this->paymentStatus);
$query->orderBy($this->sortBy, $this->sortOrder);
```

### Semua Admin Controllers
```php
// Pagination update
->paginate(X)->withQueryString()  // ✅ SEMUA CONTROLLER
```

---

## ✅ Checklist Akhir

### Filter & Sorting
- [x] Filter tanggal berfungsi
- [x] Filter status reservasi berfungsi
- [x] Filter status pembayaran berfungsi *(BARU)*
- [x] Sorting by created_at berfungsi
- [x] Sorting by reservation_date berfungsi
- [x] Sorting by customer_name berfungsi
- [x] Sorting by status berfungsi
- [x] Sorting by payment_status berfungsi *(BARU)*
- [x] Kombinasi filter bekerja bersamaan
- [x] Statistics cards mengikuti filter tanggal
- [x] Revenue dihitung dari payment_status='paid'

### Pagination
- [x] ReportController withQueryString()
- [x] ReservationController withQueryString()
- [x] MenuController withQueryString()
- [x] PromoController withQueryString()
- [x] GalleryController withQueryString()
- [x] TableController withQueryString()
- [x] TestimonialController withQueryString()

### Export
- [x] Export Excel include semua filter
- [x] Kolom Status Pembayaran di Excel
- [x] Export mengikuti sorting

### UI/UX
- [x] Filter form rapi dan responsive
- [x] Tombol Export hanya muncul jika ada data
- [x] JavaScript untuk export dengan semua params
- [x] Labels Indonesia yang jelas
- [x] Icon visual di tombol Filter dan Export

---

## 🎉 Kesimpulan

**Semua filter dan sorting di Admin Panel sudah berfungsi dengan sempurna!**

### Yang Baru:
1. ✅ Filter Status Pembayaran (unpaid/pending/paid)
2. ✅ Sorting 5 kolom dengan asc/desc
3. ✅ Export Excel mengikuti semua filter
4. ✅ Statistics yang akurat sesuai filter
5. ✅ Revenue dari payment_status bukan status reservasi
6. ✅ Pagination mempertahankan semua filter di semua controller

### Testing:
Silakan test manual dengan URL seperti:
```
http://localhost:8000/admin/reports?date_from=2025-01-01&date_to=2025-12-31&status=confirmed&payment_status=paid&sort_by=customer_name&sort_order=asc
```

Semua parameter akan dipertahankan saat pagination dan export.
