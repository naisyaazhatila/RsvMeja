@extends('layouts.app')

@section('title', 'Instruksi Pembayaran - Asya\'s Kitchen')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-bark-900 to-wood-800 text-cream-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-500 rounded-full mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-4">Reservasi Berhasil!</h1>
            <p class="text-xl text-cream-200">Kode Booking: <span class="font-bold text-yellow-400">{{ $reservation->booking_code }}</span></p>
        </div>
    </section>

    <!-- Payment Instructions -->
    <section class="py-16 bg-cream-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Important Notice -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 mb-8 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-yellow-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="font-bold text-lg text-yellow-800 mb-2">Penting!</h3>
                        <p class="text-yellow-700">
                            Untuk mengonfirmasi reservasi Anda, silakan lakukan pembayaran DP (Down Payment).
                            Reservasi Anda akan dikonfirmasi setelah pembayaran DP diverifikasi oleh tim kami.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Reservation Details -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="font-heading text-3xl font-bold text-bark-900 mb-6 pb-4 border-b-2 border-wood-500">
                    Detail Reservasi
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Kode Booking</h3>
                        <p class="text-lg font-bold text-bark-900">{{ $reservation->booking_code }}</p>
                        <p class="text-xs text-gray-500 mt-1">Dibuat: {{ $reservation->created_at->format('d M Y H:i') }} WIB</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Status</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                            {{ $reservation->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                               ($reservation->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($reservation->payment_status ?? 'unpaid') }}
                        </span>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Nama Pemesan</h3>
                        <p class="text-lg text-gray-700">{{ $reservation->customer_name }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Email</h3>
                        <p class="text-lg text-gray-700">{{ $reservation->customer_email }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Nomor Telepon</h3>
                        <p class="text-lg text-gray-700">{{ $reservation->customer_phone }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Tanggal Reservasi</h3>
                        <p class="text-lg text-gray-700">{{ $reservation->reservation_date->format('d F Y') }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Waktu</h3>
                        <p class="text-lg text-gray-700">{{ date('g:i A', strtotime($reservation->reservation_time)) }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Jumlah Tamu</h3>
                        <p class="text-lg text-gray-700">{{ $reservation->guest_count }} orang</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Meja</h3>
                        <p class="text-lg text-gray-700">{{ $reservation->table->name }} (Kapasitas {{ $reservation->table->capacity }} orang)</p>
                    </div>
                </div>

                @if($reservation->special_requests)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Permintaan Khusus</h3>
                    <p class="text-gray-700">{{ $reservation->special_requests }}</p>
                </div>
                @endif
            </div>

            <!-- Payment Information -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8 border-2 border-gray-200">
                <h2 class="font-heading text-3xl font-bold mb-6 flex items-center text-bark-900">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Informasi Pembayaran DP
                </h2>
                
                <div class="bg-wood-50 rounded-lg p-6 mb-6 border-2 border-wood-200">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-bark-900 font-semibold text-lg">Jumlah DP</span>
                        <span class="text-3xl font-bold text-wood-600">Rp {{ number_format($dpAmount, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-sm text-gray-700">* Sisa pembayaran dapat dilakukan di tempat saat kedatangan</p>
                </div>

                <div class="space-y-4">
                    <h3 class="font-bold text-xl mb-4 text-bark-900">Transfer ke Rekening:</h3>
                    
                    <!-- Bank Mandiri -->
                    <div class="bg-yellow-50 rounded-lg p-5 border-2 border-yellow-200">
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 bg-white rounded-lg flex items-center justify-center border-2 border-yellow-300 p-3 flex-shrink-0">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri" class="w-full h-full object-contain">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-600 font-medium mb-1">Bank Mandiri</p>
                                <p class="font-bold text-2xl text-bark-900 mb-1">1090023842289</p>
                                <p class="text-sm text-gray-600">a.n. NAISYA AZHATILA</p>
                            </div>
                            <button onclick="copyToClipboard('9876543210')" class="px-4 py-2 bg-white text-wood-600 rounded-lg hover:bg-cream-100 transition font-semibold text-sm">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructions Steps -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="font-heading text-3xl font-bold text-bark-900 mb-6">Langkah Konfirmasi Pembayaran</h2>
                
                <div class="space-y-6">
                    <!-- Step 1 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-wood-500 text-white rounded-full flex items-center justify-center font-bold mr-4">
                            1
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-bark-900 mb-1">Transfer DP</h3>
                            <p class="text-gray-600">Lakukan transfer sejumlah <strong>Rp {{ number_format($dpAmount, 0, ',', '.') }}</strong> ke salah satu rekening di atas.</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-wood-500 text-white rounded-full flex items-center justify-center font-bold mr-4">
                            2
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-bark-900 mb-1">Screenshot Bukti Transfer</h3>
                            <p class="text-gray-600">Ambil screenshot atau simpan bukti transfer dari aplikasi banking Anda.</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-wood-500 text-white rounded-full flex items-center justify-center font-bold mr-4">
                            3
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-bark-900 mb-1">Kirim via WhatsApp</h3>
                            <p class="text-gray-600 mb-3">Kirim bukti transfer beserta kode booking Anda melalui WhatsApp resmi kami.</p>
                            
                            <a href="{{ $whatsappUrl }}" target="_blank" 
                               class="inline-flex items-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg transition-all shadow-lg hover:shadow-xl">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Kirim Bukti via WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-wood-500 text-white rounded-full flex items-center justify-center font-bold mr-4">
                            4
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-bark-900 mb-1">Tunggu Konfirmasi</h3>
                            <p class="text-gray-600">Tim kami akan memverifikasi pembayaran Anda dan mengirimkan email konfirmasi dalam waktu 1x24 jam.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('my-reservations') }}" 
                   class="flex-1 text-center px-6 py-4 bg-bark-900 hover:bg-bark-800 text-cream-100 font-bold rounded-lg transition-all shadow-lg">
                    Lihat Semua Reservasi Saya
                </a>
                <a href="{{ route('home') }}" 
                   class="flex-1 text-center px-6 py-4 bg-white hover:bg-gray-50 text-bark-900 font-bold rounded-lg border-2 border-bark-900 transition-all">
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Help Section -->
            <div class="mt-8 text-center text-gray-600">
                <p class="mb-2">Butuh bantuan? Hubungi kami:</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="tel:+6281234567890" class="text-wood-600 hover:text-wood-700 font-semibold">
                        📞 0822-8347-7746
                    </a>
                    <a href="mailto:info@asyaskitchen.com" class="text-wood-600 hover:text-wood-700 font-semibold">
                        ✉️ info@asyaskitchen.com
                    </a>
                </div>
            </div>

        </div>
    </section>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Show success message
                alert('Nomor rekening berhasil disalin: ' + text);
            }).catch(err => {
                console.error('Failed to copy:', err);
            });
        }
    </script>
@endsection
