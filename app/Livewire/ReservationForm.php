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
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
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
            $this->availableTables = Table::where('capacity', '>=', $this->guest_count)
                ->where('is_active', true)
                ->whereNotIn('id', function($query) {
                    $query->select('table_id')
                        ->from('reservations')
                        ->where('reservation_date', $this->reservation_date)
                        ->where('reservation_time', $this->reservation_time)
                        ->whereIn('status', ['pending', 'confirmed']);
                })
                ->orderBy('capacity')
                ->get();
        }
    }

    public function submit()
    {
        $this->validate();

        try {
            $dpAmount = setting('dp_amount', 100000);
            
            $reservation = Reservation::create([
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

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.reservation-form')->layout('layouts.app');
    }
}

