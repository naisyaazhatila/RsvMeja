<x-app-layout>
    <div class="min-h-screen bg-cream-50">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-bark-900 to-wood-800 text-cream-100 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="font-heading text-4xl md:text-5xl font-bold mb-4">Reservasi Saya</h1>
                <p class="text-lg text-cream-200">Lihat dan kelola semua reservasi Anda</p>
            </div>
        </section>

        <!-- Content -->
        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Success Message with WA Button -->
                @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-6">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-green-900 mb-2">{{ session('success') }}</h3>
                            @if(session('wa_url'))
                            <p class="text-green-800 mb-4">Untuk menyelesaikan reservasi, silakan kirim bukti pembayaran melalui WhatsApp</p>
                            <a href="{{ session('wa_url') }}" target="_blank" 
                               class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                Kirim Bukti Pembayaran via WhatsApp
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @if($reservations->count() > 0)
                <div class="grid gap-6">
                    @foreach($reservations as $reservation)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                                <div>
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="font-heading text-2xl font-bold text-bark-900">{{ $reservation->booking_code }}</h3>
                                        @if($reservation->status === 'pending')
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Menunggu Konfirmasi
                                            </span>
                                        @elseif($reservation->status === 'confirmed')
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                ✓ Dikonfirmasi
                                            </span>
                                        @elseif($reservation->status === 'cancelled')
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Dibatalkan
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-500">Dibuat: {{ $reservation->created_at->format('d F Y, H:i') }}</p>
                                </div>
                                <div class="mt-4 md:mt-0">
                                    @if($reservation->payment_status === 'paid')
                                        <span class="inline-flex items-center px-4 py-2 rounded-lg bg-green-100 text-green-800 font-semibold">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Lunas
                                        </span>
                                    @elseif($reservation->payment_status === 'pending')
                                        <span class="inline-flex items-center px-4 py-2 rounded-lg bg-yellow-100 text-yellow-800 font-semibold">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            Menunggu Verifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-4 py-2 rounded-lg bg-red-100 text-red-800 font-semibold">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            Belum Bayar
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-wood-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal</p>
                                        <p class="font-semibold">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-wood-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-500">Waktu</p>
                                        <p class="font-semibold">{{ $reservation->reservation_time }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-wood-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-500">Tamu</p>
                                        <p class="font-semibold">{{ $reservation->guest_count }} orang</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <p class="text-xs text-gray-500">Meja</p>
                                        <p class="font-bold text-lg text-bark-900">{{ $reservation->table->name ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">DP</p>
                                        <p class="font-bold text-lg text-wood-600">Rp {{ number_format($reservation->dp_amount ?? 0, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    @if($reservation->payment_status !== 'paid' && $reservation->status !== 'cancelled')
                                    <a href="{{ route('payment.instruction', $reservation->booking_code) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition">
                                        💳 Bayar DP
                                    </a>
                                    @endif
                                    <a href="{{ route('my-reservations.show', $reservation) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-wood-500 hover:bg-wood-600 text-white font-semibold rounded-lg transition">
                                        Lihat Detail
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $reservations->links() }}
                </div>

                @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">Belum Ada Reservasi</h3>
                    <p class="text-gray-500 mb-6">Anda belum melakukan reservasi. Pesan meja sekarang!</p>
                    <a href="{{ route('reservation') }}" 
                       class="inline-flex items-center px-6 py-3 bg-wood-500 hover:bg-wood-600 text-white font-bold rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Reservasi Baru
                    </a>
                </div>
                @endif

            </div>
        </section>
    </div>
</x-app-layout>
