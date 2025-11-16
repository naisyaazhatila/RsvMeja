<x-app-layout>
    <div class="scroll-smooth">

        <!-- SECTION 1: HERO SECTION -->
        <section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <img
                    src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1920&h=1080&fit=crop"
                    alt="Restaurant Interior"
                    class="w-full h-full object-cover"
                    loading="eager"
                >
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-gradient-to-b from-bark-900/70 via-bark-900/60 to-bark-900/80"></div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="animate-fade-in">
                    <!-- Main Heading -->
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-bold text-white mb-6 leading-tight">
                        Nikmati Pengalaman<br>Kuliner Istimewa
                    </h1>

                    <!-- Subheading -->
                    <p class="text-xl md:text-2xl text-cream-100 mb-12 max-w-3xl mx-auto leading-relaxed">
                        Reservasi meja Anda sekarang dan rasakan cita rasa autentik Indonesia
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a
                            href="{{ route('reservation') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-wood-500 text-cream-100 font-semibold text-lg rounded-lg hover:bg-wood-600 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl"
                        >
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Reservasi Sekarang
                        </a>
                        <a
                            href="{{ route('menu') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold text-lg rounded-lg border-2 border-white hover:bg-white hover:text-wood-500 transform hover:scale-105 transition-all duration-300"
                        >
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Lihat Menu
                        </a>
                    </div>
                </div>
            </div>

            <!-- Scroll Down Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
                <svg class="w-6 h-6 text-cream-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </section>

        <!-- SECTION 2: ABOUT SECTION -->
        <section id="about" class="py-16 md:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                    <!-- Left: Image -->
                    <div class="order-2 lg:order-1">
                        <div class="relative">
                            <img
                                src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&h=600&fit=crop"
                                alt="Tentang Restoran"
                                class="w-full h-auto rounded-2xl shadow-xl object-cover"
                                loading="lazy"
                            >
                            <!-- Decorative Element -->
                            <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-cream-200 rounded-2xl -z-10 hidden md:block"></div>
                        </div>
                    </div>

                    <!-- Right: Content -->
                    <div class="order-1 lg:order-2 space-y-6">
                        <!-- Label -->
                        <div>
                            <span class="text-sm font-semibold text-wood-500 uppercase tracking-wider">Tentang Kami</span>
                        </div>

                        <!-- Heading -->
                        <h2 class="text-4xl md:text-5xl font-heading font-bold text-bark-900 leading-tight">
                            Cita Rasa Autentik<br>Sejak 2010
                        </h2>

                        <!-- Description Paragraphs -->
                        <div class="space-y-4 text-gray-600 leading-relaxed">
                            <p>
                                Kami adalah restoran yang menghadirkan pengalaman kuliner autentik Indonesia dengan sentuhan modern. Setiap hidangan kami dibuat dengan bahan-bahan premium pilihan dan dimasak oleh chef berpengalaman.
                            </p>
                            <p>
                                Dengan atmosfer yang nyaman dan elegan, kami menciptakan tempat sempurna untuk makan bersama keluarga, teman, atau rekan bisnis. Lokasi strategis kami memudahkan Anda untuk menikmati hidangan istimewa kapan saja.
                            </p>
                        </div>

                        <!-- Highlights List -->
                        <div class="space-y-3 pt-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-wood-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-700 font-medium">Bahan premium pilihan</span>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-wood-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-700 font-medium">Chef berpengalaman 15+ tahun</span>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-wood-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-700 font-medium">Suasana nyaman dan elegan</span>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-wood-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-700 font-medium">Lokasi strategis</span>
                            </div>
                        </div>

                        <!-- Stats Row -->
                        <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200">
                            <div class="text-center">
                                <div class="text-3xl md:text-4xl font-heading font-bold text-wood-500">1000+</div>
                                <div class="text-sm text-gray-600 mt-1">Pelanggan Puas</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl md:text-4xl font-heading font-bold text-wood-500">{{ \App\Models\Menu::count() }}+</div>
                                <div class="text-sm text-gray-600 mt-1">Menu Pilihan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl md:text-4xl font-heading font-bold text-wood-500">15</div>
                                <div class="text-sm text-gray-600 mt-1">Tahun Pengalaman</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3: FEATURED MENU SECTION -->
        <section id="featured-menu" class="py-16 md:py-24 bg-cream-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Section Header -->
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-heading font-bold text-bark-900 mb-4">
                        Menu Favorit Kami
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Pilihan terbaik yang paling disukai pelanggan
                    </p>
                </div>

                <!-- Menu Grid -->
                @if(isset($featuredMenus) && $featuredMenus->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                        @foreach($featuredMenus as $menu)
                            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transform hover:scale-105 transition-all duration-300 group">
                                <!-- Menu Image -->
                                <div class="aspect-w-4 aspect-h-3 overflow-hidden">
                                    <img
                                        src="{{ $menu->image ? asset('storage/' . $menu->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=300&fit=crop' }}"
                                        alt="{{ $menu->name }}"
                                        class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                </div>

                                <!-- Menu Content -->
                                <div class="p-5 space-y-3">
                                    <!-- Menu Name -->
                                    <h3 class="text-lg font-semibold text-bark-900 line-clamp-1">
                                        {{ $menu->name }}
                                    </h3>

                                    <!-- Menu Description -->
                                    <p class="text-sm text-gray-600 line-clamp-2 min-h-[40px]">
                                        {{ $menu->description ?? 'Hidangan lezat dengan bahan berkualitas tinggi' }}
                                    </p>

                                    <!-- Price -->
                                    <div class="text-xl font-bold text-wood-500">
                                        {{ $menu->formatted_price }}
                                    </div>

                                    <!-- Badges Row -->
                                    <div class="flex flex-wrap gap-2 pt-2">
                                        @if($menu->is_vegetarian)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Vegetarian
                                            </span>
                                        @endif
                                        @if($menu->is_spicy)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13 7H7v6h6V7z"/>
                                                    <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z" clip-rule="evenodd"/>
                                                </svg>
                                                Pedas Level {{ $menu->spicy_level ?? 1 }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <!-- Placeholder if no menus -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                        @for($i = 1; $i <= 4; $i++)
                            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                <div class="aspect-w-4 aspect-h-3">
                                    <img
                                        src="https://images.unsplash.com/photo-154606990{{ $i }}-ba9599a7e63c?w=400&h=300&fit=crop"
                                        alt="Menu {{ $i }}"
                                        class="w-full h-48 object-cover"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="p-5 space-y-3">
                                    <h3 class="text-lg font-semibold text-bark-900">Menu Spesial {{ $i }}</h3>
                                    <p class="text-sm text-gray-600 line-clamp-2">Hidangan lezat dengan bahan berkualitas tinggi</p>
                                    <div class="text-xl font-bold text-wood-500">Rp 75.000</div>
                                </div>
                            </article>
                        @endfor
                    </div>
                @endif

                <!-- View All Button -->
                <div class="text-center">
                    <a
                        href="{{ route('menu.index') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-wood-500 text-cream-100 font-semibold text-lg rounded-lg hover:bg-wood-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
                    >
                        Lihat Semua Menu
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- SECTION 4: TESTIMONIALS SECTION -->
        <section id="testimonials" class="py-16 md:py-24 bg-cream-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Section Header -->
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-heading font-bold text-bark-900 mb-4">
                        Apa Kata Pelanggan Kami
                    </h2>
                </div>

                <!-- Testimonials Carousel -->
                <div
                    x-data="{
                        currentSlide: 0,
                        testimonials: {{ json_encode($testimonials ?? collect([
                            ['name' => 'Budi Santoso', 'comment' => 'Makanannya luar biasa enak! Pelayanan sangat ramah dan suasana restorannya sangat nyaman. Pasti akan kembali lagi.', 'rating' => 5],
                            ['name' => 'Siti Nurhaliza', 'comment' => 'Tempat favorit keluarga untuk makan malam. Menu yang ditawarkan sangat beragam dan semuanya enak. Harga juga sebanding dengan kualitas.', 'rating' => 5],
                            ['name' => 'Ahmad Hidayat', 'comment' => 'Chef-nya sangat berpengalaman. Rasa masakan autentik Indonesia yang susah dicari di tempat lain. Highly recommended!', 'rating' => 5],
                            ['name' => 'Dewi Lestari', 'comment' => 'Reservasi online sangat memudahkan. Tidak perlu antri lama dan bisa langsung dapat meja. Sistem yang bagus!', 'rating' => 4],
                            ['name' => 'Rendra Wijaya', 'comment' => 'Lokasi strategis, mudah dijangkau. Interior restorannya juga sangat instagramable. Cocok untuk acara spesial!', 'rating' => 5],
                            ['name' => 'Maya Putri', 'comment' => 'Porsi makanan besar dan memuaskan. Harga terjangkau untuk kualitas yang didapat. Sangat worth it!', 'rating' => 5]
                        ])) }},
                        get visibleTestimonials() {
                            if (window.innerWidth >= 1024) {
                                return 3;
                            } else if (window.innerWidth >= 640) {
                                return 2;
                            }
                            return 1;
                        },
                        get totalSlides() {
                            return Math.ceil(this.testimonials.length / this.visibleTestimonials);
                        },
                        nextSlide() {
                            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                        },
                        prevSlide() {
                            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                        },
                        goToSlide(index) {
                            this.currentSlide = index;
                        },
                        init() {
                            setInterval(() => {
                                this.nextSlide();
                            }, 5000);
                        }
                    }"
                    class="relative"
                >
                    <!-- Testimonials Container -->
                    <div class="overflow-hidden">
                        <div
                            class="flex transition-transform duration-500 ease-in-out"
                            :style="`transform: translateX(-${currentSlide * 100}%)`"
                        >
                            <template x-for="(testimonial, index) in testimonials" :key="index">
                                <div class="w-full sm:w-1/2 lg:w-1/3 flex-shrink-0 px-3">
                                    <div class="bg-white rounded-xl shadow-lg p-8 h-full flex flex-col space-y-4">
                                        <!-- Quote Icon -->
                                        <div>
                                            <svg class="w-10 h-10 text-wood-500/30" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                            </svg>
                                        </div>

                                        <!-- Star Rating -->
                                        <div class="flex space-x-1">
                                            <template x-for="star in 5" :key="star">
                                                <svg
                                                    class="w-5 h-5"
                                                    :class="star <= testimonial.rating ? 'text-yellow-400' : 'text-gray-300'"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                >
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </template>
                                        </div>

                                        <!-- Comment Text -->
                                        <p class="text-gray-600 italic flex-grow leading-relaxed" x-text="testimonial.comment"></p>

                                        <!-- Customer Info -->
                                        <div class="flex items-center space-x-3 pt-4 border-t border-gray-200">
                                            <!-- Avatar Placeholder -->
                                            <div class="w-12 h-12 rounded-full bg-wood-500/20 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-6 h-6 text-wood-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <!-- Name -->
                                            <div>
                                                <p class="font-semibold text-bark-900" x-text="testimonial.name"></p>
                                                <p class="text-sm text-gray-500">Pelanggan Setia</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Navigation Arrows -->
                    <button
                        @click="prevSlide()"
                        class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-cream-100 transition-all duration-300 hidden lg:block"
                    >
                        <svg class="w-6 h-6 text-bark-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button
                        @click="nextSlide()"
                        class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-cream-100 transition-all duration-300 hidden lg:block"
                    >
                        <svg class="w-6 h-6 text-bark-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Dots Navigation -->
                    <div class="flex justify-center space-x-2 mt-8">
                        <template x-for="(dot, index) in Array.from({length: totalSlides})" :key="index">
                            <button
                                @click="goToSlide(index)"
                                class="w-3 h-3 rounded-full transition-all duration-300"
                                :class="currentSlide === index ? 'bg-wood-500 w-8' : 'bg-gray-300 hover:bg-gray-400'"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 5: PROMO BANNER (Conditional) -->
        @if(isset($activePromo) && $activePromo)
            <section id="promo-banner" class="bg-gradient-to-r from-wood-400 to-wood-600 py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <!-- Left: Promo Info -->
                        <div class="flex items-center space-x-4 text-white">
                            <!-- Tag Icon -->
                            <svg class="w-8 h-8 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <!-- Promo Text -->
                            <div>
                                <p class="text-sm font-medium uppercase tracking-wider">Promo Spesial</p>
                                <h3 class="text-xl md:text-2xl font-heading font-bold">{{ $activePromo->title }}</h3>
                            </div>
                        </div>

                        <!-- Right: CTA Button -->
                        <a
                            href="{{ route('promotions.index') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-white text-wood-500 font-semibold rounded-lg hover:bg-cream-100 transition-all duration-300 shadow-md hover:shadow-lg"
                        >
                            Lihat Detail
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!-- SECTION 6: CALL-TO-ACTION SECTION -->
        <section id="cta" class="py-16 md:py-24 bg-wood-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <!-- Heading -->
                <h2 class="text-4xl md:text-5xl font-heading font-bold text-white mb-6">
                    Siap Untuk Reservasi?
                </h2>

                <!-- Subheading -->
                <p class="text-xl text-cream-100 mb-10 max-w-2xl mx-auto">
                    Amankan meja Anda sekarang dan nikmati pengalaman bersantap istimewa
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a
                        href="{{ route('reservation') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white text-wood-500 font-semibold text-lg rounded-lg hover:bg-cream-100 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl"
                    >
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Buat Reservasi
                    </a>
                    <a
                        href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold text-lg rounded-lg border-2 border-white hover:bg-white hover:text-wood-500 transform hover:scale-105 transition-all duration-300"
                    >
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>

        <!-- SECTION 7: FOOTER -->
        @include('partials.footer')

    </div>
</x-app-layout>
