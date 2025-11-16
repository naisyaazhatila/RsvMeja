<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-bark-900 to-wood-800 text-cream-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="font-heading text-4xl md:text-5xl font-bold mb-2">Detail Reservasi</h1>
                    <p class="text-xl text-cream-200">Kode Booking: <span class="font-bold text-yellow-400">{{ $reservation->booking_code }}</span></p>
                </div>
                <a href="{{ route('my-reservations') }}" 
                   class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </section>

    <!-- Detail Content -->
    <section class="py-12 bg-cream-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Status Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Reservation Status -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Status Reservasi</h3>
                    @if($reservation->status === 'pending')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-yellow-100 text-yellow-800">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            Menunggu Konfirmasi
                        </span>
                    @elseif($reservation->status === 'confirmed')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-green-100 text-green-800">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Dikonfirmasi
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-red-100 text-red-800">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            Dibatalkan
                        </span>
                    @endif
                </div>

                <!-- Payment Status -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Status Pembayaran</h3>
                    @if($reservation->payment_status === 'paid')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-green-100 text-green-800">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Lunas
                        </span>
                    @elseif($reservation->payment_status === 'pending')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-yellow-100 text-yellow-800">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            Menunggu Verifikasi
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-red-100 text-red-800">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            Belum Bayar
                        </span>
                    @endif
                </div>
            </div>

            <!-- Reservation Details -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="font-heading text-3xl font-bold text-bark-900 mb-6 pb-4 border-b-2 border-wood-500">
                    Informasi Reservasi
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Nama Pemesan</h3>
                        <p class="text-lg font-medium text-gray-900">{{ $reservation->customer_name }}</p>
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
                        <p class="text-lg font-medium text-gray-900">{{ $reservation->reservation_date->format('d F Y') }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Waktu</h3>
                        <p class="text-lg font-medium text-gray-900">{{ $reservation->reservation_time }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Jumlah Tamu</h3>
                        <p class="text-lg font-medium text-gray-900">{{ $reservation->guest_count }} orang</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">Meja</h3>
                        <p class="text-lg font-medium text-gray-900">{{ $reservation->table->name }} (Kapasitas {{ $reservation->table->capacity }} orang)</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-1">DP yang Dibayar</h3>
                        <p class="text-lg font-bold text-wood-600">Rp {{ number_format($reservation->dp_amount ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>

                @if($reservation->special_requests)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Permintaan Khusus</h3>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $reservation->special_requests }}</p>
                </div>
                @endif

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Dibuat Pada</h3>
                    <p class="text-gray-700">{{ $reservation->created_at->format('d F Y, H:i') }} WIB</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                @if($reservation->payment_status !== 'paid' && $reservation->status !== 'cancelled')
                <a href="{{ route('payment.instruction', $reservation->booking_code) }}" 
                   class="flex-1 text-center px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg transition-all shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    Bayar DP Sekarang
                </a>
                @endif

                @if(isset($waUrl))
                <a href="{{ $waUrl }}" 
                   target="_blank"
                   class="flex-1 text-center px-6 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition-all shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Konfirmasi via WhatsApp
                </a>
                @endif

                <a href="{{ route('home') }}" 
                   class="flex-1 text-center px-6 py-4 bg-bark-900 hover:bg-bark-800 text-cream-100 font-bold rounded-lg transition-all shadow-lg">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
