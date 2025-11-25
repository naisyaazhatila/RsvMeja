<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-bark-900 to-wood-800 text-cream-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-4">Promo Spesial</h1>
            <p class="text-xl text-cream-200">Dapatkan penawaran terbaik dari kami</p>
        </div>
    </section>

    <!-- Promo Section -->
    <section class="py-16 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($promos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($promos as $promo)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">
                    <!-- Image -->
                    <div class="relative h-64 overflow-hidden">
                        @if($promo->image)
                        <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->title }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-wood-500 to-wood-700 flex items-center justify-center">
                            <svg class="w-24 h-24 text-cream-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="font-heading text-2xl font-bold text-bark-900 mb-3">{{ $promo->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $promo->description }}</p>

                        <!-- Details -->
                        <div class="space-y-3 text-sm">
                            <!-- Discount Info -->
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-wood-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd" />
                                </svg>
                                <span>
                                    <strong>Diskon:</strong> 
                                    @if($promo->discount_type === 'percentage')
                                    {{ $promo->discount_value }}% dari total bill
                                    @else
                                    Rp {{ number_format($promo->discount_value, 0, ',', '.') }}
                                    @endif
                                </span>
                            </div>

                            <!-- Start Date -->
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-wood-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                <span><strong>Mulai:</strong> {{ $promo->valid_from->format('d F Y') }}</span>
                            </div>

                            <!-- End Date -->
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-wood-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <span>
                                    <strong>Berakhir:</strong> 
                                    {{ $promo->valid_until ? $promo->valid_until->format('d F Y') : 'Tidak terbatas' }}
                                </span>
                            </div>

                            @if($promo->min_purchase)
                            <!-- Minimum Purchase -->
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-wood-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                </svg>
                                <span><strong>Min. Pembelian:</strong> Rp {{ number_format($promo->min_purchase, 0, ',', '.') }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- CTA Button -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('reservation') }}" class="block w-full bg-wood-500 hover:bg-wood-600 text-cream-100 text-center py-3 rounded-lg font-semibold transition-all transform hover:scale-105">
                                Reservasi & Gunakan Promo
                            </a>
                        </div>

                        <!-- Status Badge -->
                        @php
                            $now = now();
                            $isActive = $promo->is_active && 
                                       $promo->valid_from <= $now && 
                                       ($promo->valid_until === null || $promo->valid_until >= $now);
                        @endphp
                        
                        @if($isActive)
                        <div class="mt-3 text-center">
                            <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                ✓ Promo Aktif
                            </span>
                        </div>
                        @elseif($promo->valid_from > $now)
                        <div class="mt-3 text-center">
                            <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                                Segera Hadir
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                <h3 class="text-2xl font-bold text-gray-400 mb-2">Tidak Ada Promo</h3>
                <p class="text-gray-500">Promo akan segera tersedia. Pantau terus halaman ini!</p>
            </div>
            @endif

        </div>
    </section>

    <!-- Info Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="font-heading text-3xl font-bold text-bark-900 mb-4">Syarat & Ketentuan Promo</h2>
            <div class="text-left bg-cream-50 rounded-lg p-8 space-y-3 text-gray-700">
                <div class="flex items-start">
                    <span class="text-wood-500 font-bold mr-3">•</span>
                    <p>Promo berlaku sesuai periode yang tertera</p>
                </div>
                <div class="flex items-start">
                    <span class="text-wood-500 font-bold mr-3">•</span>
                    <p>Minimal pembelian berlaku jika tertera pada detail promo</p>
                </div>
                <div class="flex items-start">
                    <span class="text-wood-500 font-bold mr-3">•</span>
                    <p>Promo tidak dapat digabungkan dengan promo lainnya kecuali disebutkan</p>
                </div>
                <div class="flex items-start">
                    <span class="text-wood-500 font-bold mr-3">•</span>
                    <p>Reservasi wajib menyebutkan kode promo saat booking</p>
                </div>
                <div class="flex items-start">
                    <span class="text-wood-500 font-bold mr-3">•</span>
                    <p>Manajemen berhak mengubah atau membatalkan promo tanpa pemberitahuan sebelumnya</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
