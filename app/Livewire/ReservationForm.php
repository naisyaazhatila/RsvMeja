<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Table;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationForm extends Component
{
    // Step management
    public $currentStep = 1;
    public $totalSteps = 4;

    // Step 1: Guest info
    public $customer_name = '';
    public $customer_email = '';
    public $customer_phone = '';

    // Step 2: Date & Time
    public $reservation_date = '';
    public $reservation_time = '';
    public $guest_count = 2;

    // Step 3: Table selection
    public $table_id = null;
    public $availableTables = [];

    // Step 4: Additional info
    public $special_requests = '';

    protected function rules()
    {
        return [
            'customer_name' => 'required|min:3',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|regex:/^[0-9]{10,15}$/',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'guest_count' => 'required|integer|min:1|max:20',
            'table_id' => 'required|exists:tables,id',
            'special_requests' => 'nullable|max:500',
        ];
    }

    protected $messages = [
        'customer_name.required' => 'Nama wajib diisi',
        'customer_name.min' => 'Nama minimal 3 karakter',
        'customer_email.required' => 'Email wajib diisi',
        'customer_email.email' => 'Format email tidak valid',
        'customer_phone.required' => 'Nomor telepon wajib diisi',
        'customer_phone.regex' => 'Format nomor telepon tidak valid (10-15 digit)',
        'reservation_date.required' => 'Tanggal reservasi wajib dipilih',
        'reservation_date.after_or_equal' => 'Tanggal tidak boleh di masa lalu',
        'reservation_time.required' => 'Waktu reservasi wajib dipilih',
        'guest_count.required' => 'Jumlah tamu wajib diisi',
        'guest_count.min' => 'Minimal 1 tamu',
        'guest_count.max' => 'Maksimal 20 tamu',
        'table_id.required' => 'Silakan pilih meja',
        'table_id.exists' => 'Meja tidak valid',
        'special_requests.max' => 'Permintaan khusus maksimal 500 karakter',
    ];

    public function mount()
    {
        // Redirect to login if not authenticated
        if (!auth()->check()) {
            session()->flash('warning', 'Silakan login atau daftar terlebih dahulu untuk melakukan reservasi.');
            return redirect()->route('login');
        }

        // Auto-fill user data
        $user = auth()->user();
        $this->customer_name = $user->name;
        $this->customer_email = $user->email;
        $this->customer_phone = $user->phone ?? '';

        // Set default date and time
        $this->reservation_date = now()->addDay()->format('Y-m-d');
        $this->reservation_time = '19:00';
    }

    public function nextStep()
    {
        $this->validateCurrentStep();

        if ($this->currentStep === 2) {
            $this->loadAvailableTables();
        }

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
            $this->dispatch('currentStepChanged', $this->currentStep);
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
            $this->dispatch('currentStepChanged', $this->currentStep);
        }
    }

    public function goToStep($step)
    {
        if ($step <= $this->currentStep) {
            $this->currentStep = $step;
        }
    }

    protected function validateCurrentStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'customer_name' => 'required|min:3',
                'customer_email' => 'required|email',
                'customer_phone' => 'required|regex:/^[0-9]{10,15}$/',
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'reservation_date' => 'required|date|after_or_equal:today',
                'reservation_time' => 'required',
                'guest_count' => 'required|integer|min:1|max:20',
            ]);
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'table_id' => 'required|exists:tables,id',
            ]);
            
            // Real-time check with database lock: Validate that selected table is still available
            // Check for ANY active reservation (pending/confirmed) on the same date
            $isTableReserved = \DB::transaction(function() {
                return Reservation::lockForUpdate()
                    ->where('table_id', $this->table_id)
                    ->where('reservation_date', $this->reservation_date)
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->exists();
            });
            
            if ($isTableReserved) {
                // Refresh table list
                $this->loadAvailableTables();
                $this->table_id = null; // Reset selection
                
                $this->addError('table_id', 'Maaf, meja ini sudah dibooking untuk tanggal tersebut. Meja akan tersedia kembali setelah reservasi selesai. Silakan pilih meja lain.');
                throw new \Illuminate\Validation\ValidationException(
                    validator([], []),
                    null,
                    null
                );
            }
            
            // Validate that selected table has sufficient capacity
            $selectedTable = Table::find($this->table_id);
            if ($selectedTable && $selectedTable->capacity < $this->guest_count) {
                $this->addError('table_id', 'Meja yang dipilih tidak cukup untuk ' . $this->guest_count . ' orang. Silakan pilih meja dengan kapasitas minimal ' . $this->guest_count . ' orang.');
                throw new \Illuminate\Validation\ValidationException(
                    validator([], []),
                    null,
                    null
                );
            }
        }
    }

    public function loadAvailableTables()
    {
        if ($this->reservation_date && $this->reservation_time && $this->guest_count) {
            // Get all tables with enough capacity
            $allTables = Table::where('capacity', '>=', $this->guest_count)
                ->where('is_active', true)
                ->orderBy('capacity')
                ->get();
            
            // Get reserved table IDs - Block tables that have active reservations (pending/confirmed) 
            // on the same date, regardless of time
            $reservedTableIds = Reservation::where('reservation_date', $this->reservation_date)
                ->whereIn('status', ['pending', 'confirmed'])
                ->pluck('table_id')
                ->toArray();
            
            // Mark tables as available or reserved
            $this->availableTables = $allTables->map(function($table) use ($reservedTableIds) {
                $table->is_reserved = in_array($table->id, $reservedTableIds);
                return $table;
            });
        }
    }
    
    // Method untuk refresh tables secara berkala (dipanggil dari frontend via wire:poll)
    public function refreshTables()
    {
        // Only refresh when on step 3 (table selection) and not in other steps
        if ($this->currentStep === 3 && $this->reservation_date && $this->reservation_time && $this->guest_count) {
            $this->loadAvailableTables();
        }
    }

    // Method untuk set table dengan validasi real-time
    public function selectTable($tableId)
    {
        // Check if table is active
        $table = Table::find($tableId);
        
        if (!$table || !$table->is_active) {
            // Refresh table list
            $this->loadAvailableTables();
            $this->table_id = null;
            
            session()->flash('error', 'Maaf, meja ini sedang tidak aktif. Silakan pilih meja lain.');
            return;
        }
        
        // Real-time check apakah meja masih available
        $isReserved = Reservation::where('table_id', $tableId)
            ->where('reservation_date', $this->reservation_date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();
        
        if ($isReserved) {
            // Refresh table list
            $this->loadAvailableTables();
            $this->table_id = null;
            
            session()->flash('error', 'Maaf, meja ini baru saja dibooking oleh pengguna lain. Silakan pilih meja lain.');
            return;
        }
        
        // Set table jika masih available
        $this->table_id = $tableId;
    }

    public function submit()
    {
        $this->validate();

        try {
            $dpAmount = setting('dp_amount', 100000);
            
            // Create unique lock key for this table and date
            $lockKey = "reservation_lock_{$this->table_id}_{$this->reservation_date}";
            
            // Try to acquire lock (10 second timeout)
            $lock = \Cache::lock($lockKey, 10);
            
            if (!$lock->get()) {
                throw new \Exception('Meja sedang diproses oleh pengguna lain. Silakan tunggu beberapa saat dan coba lagi.');
            }
            
            try {
                // Use database transaction
                $reservation = \DB::transaction(function() use ($dpAmount) {
                    // Triple-check if table is still available
                    $existingReservation = Reservation::where('table_id', $this->table_id)
                        ->where('reservation_date', $this->reservation_date)
                        ->whereIn('status', ['pending', 'confirmed'])
                        ->first();
                    
                    if ($existingReservation) {
                        throw new \Exception('Maaf, meja ini sudah dibooking untuk tanggal tersebut oleh ' . $existingReservation->customer_name . '. Meja akan tersedia setelah reservasi selesai. Silakan pilih meja lain.');
                    }
                    
                    // Verify table exists and is active
                    $table = \App\Models\Table::where('id', $this->table_id)
                        ->where('is_active', true)
                        ->first();
                    
                    if (!$table) {
                        throw new \Exception('Meja tidak ditemukan atau tidak aktif.');
                    }
                
                return Reservation::create([
                    'user_id' => auth()->id(),
                    'customer_name' => $this->customer_name,
                    'customer_email' => $this->customer_email,
                    'customer_phone' => $this->customer_phone,
                    'reservation_date' => $this->reservation_date,
                    'reservation_time' => $this->reservation_time,
                    'guest_count' => $this->guest_count,
                    'table_id' => $this->table_id,
                    'special_requests' => $this->special_requests,
                    'status' => 'pending',
                    'dp_amount' => $dpAmount,
                    'payment_status' => 'unpaid',
                ]);
            });

            // Send confirmation email to customer
            \Mail::to($reservation->customer_email)->send(new \App\Mail\ReservationCreated($reservation));
            
            // Send notification to admin
            $adminEmail = setting('restaurant_email', 'admin@asyaskitchen.com');
            \Mail::to($adminEmail)->send(new \App\Mail\ReservationCreated($reservation));

            // Generate WhatsApp message
            $waPhone = setting('restaurant_phone', '6281234567890');
            $waPhone = preg_replace('/[^0-9]/', '', $waPhone);
            if (!str_starts_with($waPhone, '62')) {
                $waPhone = '62' . ltrim($waPhone, '0');
            }

            $message = "Halo, saya sudah melakukan reservasi:\n\n";
            $message .= "Kode Booking: *{$reservation->booking_code}*\n";
            $message .= "Nama: {$reservation->customer_name}\n";
            $message .= "Tanggal: " . \Carbon\Carbon::parse($reservation->reservation_date)->format('d F Y') . "\n";
            $message .= "Waktu: {$reservation->reservation_time}\n";
            $message .= "Jumlah Tamu: {$reservation->guest_count} orang\n";
            $message .= "Meja: {$reservation->table->name}\n\n";
            $message .= "DP yang harus dibayar: Rp " . number_format($dpAmount, 0, ',', '.') . "\n\n";
            $message .= "Saya akan mengirimkan bukti transfer segera.";

            $waUrl = "https://wa.me/{$waPhone}?text=" . urlencode($message);

            session()->flash('success', 'Reservasi berhasil dibuat! Kode booking: ' . $reservation->booking_code);
            session()->flash('wa_url', $waUrl);
            session()->flash('booking_code', $reservation->booking_code);
            
                // Redirect to payment instruction page instead of my-reservations
                return redirect()->route('payment.instruction', ['bookingCode' => $reservation->booking_code]);
                
            } finally {
                // Always release the lock
                optional($lock)->release();
            }

        } catch (\Exception $e) {
            // Refresh available tables after error
            $this->loadAvailableTables();
            $this->table_id = null;
            
            // Log error for debugging
            \Log::error('Reservation submission failed', [
                'error' => $e->getMessage(),
                'table_id' => $this->table_id,
                'date' => $this->reservation_date,
                'user_id' => auth()->id(),
            ]);
            
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            $this->currentStep = 3; // Back to table selection
        }
    }

    public function render()
    {
        return view('livewire.reservation-form')->layout('layouts.app');
    }
}

