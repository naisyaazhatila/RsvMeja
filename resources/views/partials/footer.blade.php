<footer class="bg-bark-900 text-cream-100">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">

            <!-- Column 1: Restaurant Information -->
            <div class="space-y-6">
                <!-- Logo and Name -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-lg overflow-hidden">
                        <img src="{{ asset('img/logo.jpeg') }}" alt="{{ setting('restaurant_name', 'Asya\'s Kitchen') }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="font-heading text-2xl font-bold text-cream-100">
                            {{ setting('restaurant_name', 'Asya\'s Kitchen') }}
                        </h3>
                        <p class="text-sm text-cream-200">Makanan Khas Indonesia</p>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="space-y-4">
                    <!-- Address -->
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-wood-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-cream-200">Alamat</p>
                            <p class="text-cream-300 text-sm">{{ setting('restaurant_address', 'Jl. Contoh No. 123, Jakarta') }}</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-wood-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-cream-200">Telepon</p>
                            <a href="tel:{{ setting('restaurant_phone', '021-12345678') }}" class="text-cream-300 text-sm hover:text-wood-400 transition-colors duration-300">
                                {{ setting('restaurant_phone', '021-12345678') }}
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-wood-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-cream-200">Email</p>
                            <a href="mailto:{{ setting('restaurant_email', 'info@rsvmeja.com') }}" class="text-cream-300 text-sm hover:text-wood-400 transition-colors duration-300">
                                {{ setting('restaurant_email', 'info@rsvmeja.com') }}
                            </a>
                        </div>
                    </div>

                    <!-- Operating Hours -->
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-wood-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-cream-200">Jam Operasional</p>
                            <p class="text-cream-300 text-sm">{{ setting('operating_hours', 'Senin - Minggu: 10:00 - 22:00') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="space-y-6">
                <h3 class="font-heading text-xl font-bold text-cream-100">Tautan Cepat</h3>
                <nav class="space-y-3">
                    <a
                        href="{{ route('home') }}"
                        class="flex items-center space-x-2 text-cream-300 hover:text-wood-400 transition-colors duration-300 group"
                    >
                        <svg class="w-4 h-4 text-wood-400 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-sm">Beranda</span>
                    </a>
                    <a
                        href="{{ route('menu') }}"
                        class="flex items-center space-x-2 text-cream-300 hover:text-wood-400 transition-colors duration-300 group"
                    >
                        <svg class="w-4 h-4 text-wood-400 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-sm">Menu</span>
                    </a>
                    <a
                        href="{{ route('reservation') }}"
                        class="flex items-center space-x-2 text-cream-300 hover:text-wood-400 transition-colors duration-300 group"
                    >
                        <svg class="w-4 h-4 text-wood-400 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-sm">Reservasi</span>
                    </a>
                    <a
                        href="{{ route('gallery') }}"
                        class="flex items-center space-x-2 text-cream-300 hover:text-wood-400 transition-colors duration-300 group"
                    >
                        <svg class="w-4 h-4 text-wood-400 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-sm">Galeri</span>
                    </a>
                    <a
                        href="{{ route('promos') }}"
                        class="flex items-center space-x-2 text-cream-300 hover:text-wood-400 transition-colors duration-300 group"
                    >
                        <svg class="w-4 h-4 text-wood-400 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-sm">Promo</span>
                    </a>
                    <a
                        href="{{ route('contact') }}"
                        class="flex items-center space-x-2 text-cream-300 hover:text-wood-400 transition-colors duration-300 group"
                    >
                        <svg class="w-4 h-4 text-wood-400 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-sm">Kontak</span>
                    </a>
                </nav>

                <!-- Additional Links -->
                <div class="pt-6 border-t border-cream-200/10">
                    <h4 class="font-heading text-lg font-semibold text-cream-100 mb-3">Lainnya</h4>
                    <nav class="space-y-3">
                        <a
                            href="{{ route('privacy') }}"
                            class="flex items-center space-x-2 text-cream-300 hover:text-wood-400 transition-colors duration-300 group"
                        >
                            <svg class="w-4 h-4 text-wood-400 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="text-sm">Kebijakan Privasi</span>
                        </a>
                        <a
                            href="{{ route('terms') }}"
                            class="flex items-center space-x-2 text-cream-300 hover:text-wood-400 transition-colors duration-300 group"
                        >
                            <svg class="w-4 h-4 text-wood-400 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="text-sm">Syarat & Ketentuan</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Column 3: Social Media & Newsletter -->
            <div class="space-y-6">
                <h3 class="font-heading text-xl font-bold text-cream-100">Ikuti Kami</h3>

                <!-- Social Media Links -->
                <div class="flex space-x-4">
                    @if(setting('social_instagram'))
                        <a
                            href="{{ setting('social_instagram') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 bg-wood-500/20 hover:bg-wood-500 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110 group"
                            aria-label="Instagram"
                        >
                            <svg class="w-6 h-6 text-cream-200 group-hover:text-cream-100" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif

                    @if(setting('social_facebook'))
                        <a
                            href="{{ setting('social_facebook') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 bg-wood-500/20 hover:bg-wood-500 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110 group"
                            aria-label="Facebook"
                        >
                            <svg class="w-6 h-6 text-cream-200 group-hover:text-cream-100" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    @endif

                    @if(setting('social_whatsapp'))
                        <a
                            href="https://wa.me/{{ setting('social_whatsapp') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 bg-wood-500/20 hover:bg-wood-500 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110 group"
                            aria-label="WhatsApp"
                        >
                            <svg class="w-6 h-6 text-cream-200 group-hover:text-cream-100" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </a>
                    @endif
                </div>

                <!-- Newsletter Subscription -->
                <div class="pt-6">
                    <h4 class="font-heading text-lg font-semibold text-cream-100 mb-3">Newsletter</h4>
                    <p class="text-sm text-cream-300 mb-4">Dapatkan informasi promo dan menu terbaru langsung di email Anda</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
                        @csrf
                        <div class="relative">
                            <input
                                type="email"
                                name="email"
                                placeholder="Email Anda"
                                required
                                class="w-full px-4 py-3 bg-bark-800 border border-wood-500/30 rounded-lg text-cream-100 placeholder-cream-300/50 focus:outline-none focus:ring-2 focus:ring-wood-500 focus:border-transparent transition-all duration-300"
                            >
                        </div>
                        <button
                            type="submit"
                            class="w-full inline-flex items-center justify-center px-6 py-3 bg-wood-500 text-cream-100 font-semibold rounded-lg hover:bg-wood-600 transition-all duration-300 shadow-md hover:shadow-lg"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Berlangganan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright Bar -->
    <div class="border-t border-cream-200/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-sm text-cream-300 text-center md:text-left">
                    &copy; {{ date('Y') }} {{ setting('site_name', 'RsvMeja') }}. Seluruh hak cipta dilindungi.
                </p>
                <p class="text-sm text-cream-300/70 text-center md:text-right">
                    Dibuat dengan dedikasi untuk pengalaman reservasi yang lebih baik
                </p>
            </div>
        </div>
    </div>
</footer>
