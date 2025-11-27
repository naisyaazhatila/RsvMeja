<x-app-layout>
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/hero-bg.jpg') }}" alt="Restaurant" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1920'">
            <div class="absolute inset-0 bg-gradient-to-b from-bark-900/70 to-bark-900/50"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <h1 class="font-heading text-5xl md:text-7xl font-bold text-cream-100 mb-6 animate-fade-in-up">
                {{ setting('restaurant_name', 'Restaurant') }}
            </h1>
            <p class="text-xl md:text-2xl text-cream-200 mb-8 animate-fade-in-up animation-delay-200">
                {{ setting('restaurant_tagline', 'Nikmati Pengalaman Kuliner Terbaik') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up animation-delay-400">
                <a href="{{ route('reservation') }}" class="bg-wood-500 hover:bg-wood-600 text-cream-100 px-8 py-4 rounded-lg font-semibold text-lg transition-all transform hover:scale-105 shadow-lg">
                    Reservasi Sekarang
                </a>
                <a href="{{ route('menu') }}" class="bg-transparent border-2 border-cream-100 hover:bg-cream-100 hover:text-bark-900 text-cream-100 px-8 py-4 rounded-lg font-semibold text-lg transition-all">
                    Lihat Menu
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-cream-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="font-heading text-4xl font-bold text-bark-900 mb-6">
                        Tentang Kami
                    </h2>
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        {{ setting('restaurant_description', 'Kami menyajikan pengalaman kuliner terbaik dengan bahan-bahan berkualitas tinggi dan pelayanan yang ramah. Setiap hidangan dibuat dengan penuh cinta dan dedikasi untuk kepuasan Anda.') }}
                    </p>
                    <div class="grid grid-cols-3 gap-6 mb-8">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-wood-500 mb-2">10+</div>
                            <div class="text-gray-600">Tahun Pengalaman</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-wood-500 mb-2">50+</div>
                            <div class="text-gray-600">Menu Pilihan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-wood-500 mb-2">1000+</div>
                            <div class="text-gray-600">Pelanggan Puas</div>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="inline-block bg-wood-500 hover:bg-wood-600 text-cream-100 px-6 py-3 rounded-lg font-semibold transition-all">
                        Hubungi Kami
                    </a>
                </div>
                <div class="relative">
                    <img src="{{ asset('storage/about-image.jpg') }}" alt="Restaurant Interior" class="rounded-lg shadow-2xl" onerror="this.src='https://images.unsplash.com/photo-1552566626-52f8b828add9?w=800'">
                    <div class="absolute -bottom-6 -right-6 bg-wood-500 text-cream-100 p-6 rounded-lg shadow-xl">
                        <div class="text-2xl font-bold">4.8/5</div>
                        <div class="text-sm">Rating Pelanggan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Menu -->
    <section class="py-20 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl font-bold text-bark-900 mb-4">Menu Unggulan</h2>
                <p class="text-gray-600 text-lg">Cicipi hidangan spesial kami yang paling populer</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($featuredMenus as $menu)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="relative overflow-hidden h-48">
                        @if($menu->image)
                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-wood-400 to-wood-600 flex items-center justify-center">
                            <svg class="w-20 h-20 text-cream-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        @endif
                        @if($menu->category)
                        <span class="absolute top-3 right-3 bg-wood-500 text-cream-100 px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $menu->category->name }}
                        </span>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="font-heading text-xl font-bold text-bark-900 mb-2">{{ $menu->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $menu->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-wood-500">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center py-12">
                    <p class="text-gray-500">Belum ada menu unggulan</p>
                </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('menu') }}" class="inline-block bg-wood-500 hover:bg-wood-600 text-cream-100 px-8 py-3 rounded-lg font-semibold transition-all">
                    Lihat Semua Menu
                </a>
            </div>
        </div>
    </section>

    <!-- Promo Section -->
    @if($promos->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl font-bold text-bark-900 mb-4">Promo Spesial</h2>
                <p class="text-gray-600 text-lg">Dapatkan penawaran menarik kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($promos as $promo)
                <div class="relative bg-gradient-to-br from-wood-500 to-wood-700 rounded-lg overflow-hidden shadow-xl group hover:shadow-2xl transition-all">
                    @if($promo->image)
                    <div class="absolute inset-0 opacity-20 group-hover:opacity-30 transition-opacity">
                        <img src="{{ asset($promo->image) }}" alt="{{ $promo->title }}" class="w-full h-full object-cover">
                    </div>
                    @endif
                    <div class="relative p-8 text-cream-100">
                        <div class="text-5xl font-bold mb-2">
                            @if($promo->discount_type === 'percentage')
                            {{ $promo->discount_value }}%
                            @else
                            Rp {{ number_format($promo->discount_value, 0, ',', '.') }}
                            @endif
                        </div>
                        <h3 class="font-heading text-2xl font-bold mb-3">{{ $promo->title }}</h3>
                        <p class="mb-4 opacity-90">{{ $promo->description }}</p>
                        <div class="flex items-center text-sm opacity-75">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            Berlaku sampai {{ $promo->end_date ? $promo->end_date->format('d M Y') : 'Tanpa Batas' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Testimonials -->
    @if($testimonials->count() > 0)
    <section class="py-20 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl font-bold text-bark-900 mb-4">Kata Pelanggan</h2>
                <p class="text-gray-600 text-lg">Apa kata mereka yang sudah merasakan pengalaman di tempat kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 {{ $i < $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-4 italic">"{{ $testimonial->comment }}"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-wood-500 rounded-full flex items-center justify-center text-cream-100 font-bold text-lg">
                            {{ strtoupper(substr($testimonial->customer_name, 0, 1)) }}
                        </div>
                        <div class="ml-3">
                            <div class="font-semibold text-bark-900">{{ $testimonial->customer_name }}</div>
                            <div class="text-sm text-gray-500">{{ $testimonial->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center mt-12">
                <a href="{{ route('testimonials') }}" class="inline-flex items-center px-8 py-3 bg-wood-500 text-cream-100 rounded-lg font-semibold hover:bg-wood-600 transition-all duration-300 shadow-lg hover:shadow-xl">
                    Lihat Semua Testimoni
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Gallery Preview -->
    @if($gallery->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl font-bold text-bark-900 mb-4">Galeri</h2>
                <p class="text-gray-600 text-lg">Lihat suasana dan hidangan kami</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($gallery as $image)
                <div class="relative overflow-hidden rounded-lg shadow-lg group cursor-pointer aspect-square">
                    <img src="{{ asset($image->image_path) }}" alt="{{ $image->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-bark-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-4 text-cream-100">
                            <h3 class="font-semibold">{{ $image->title }}</h3>
                            @if($image->description)
                            <p class="text-sm opacity-90">{{ $image->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('gallery') }}" class="inline-block bg-wood-500 hover:bg-wood-600 text-cream-100 px-8 py-3 rounded-lg font-semibold transition-all">
                    Lihat Semua Foto
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-br from-wood-500 to-wood-700 text-cream-100">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="font-heading text-4xl md:text-5xl font-bold mb-6">Siap Untuk Menikmati?</h2>
            <p class="text-xl mb-8 opacity-90">Reservasi meja Anda sekarang dan nikmati pengalaman kuliner yang tak terlupakan</p>
            <a href="{{ route('reservation') }}" class="inline-block bg-cream-100 hover:bg-white text-wood-600 px-10 py-4 rounded-lg font-bold text-lg transition-all transform hover:scale-105 shadow-lg">
                Reservasi Sekarang
            </a>
        </div>
    </section>
</x-app-layout>
