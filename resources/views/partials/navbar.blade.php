<nav
    x-data="{
        scrolled: false,
        mobileMenuOpen: false
    }"
    x-init="window.addEventListener('scroll', () => { scrolled = (window.pageYOffset > 20) })"
    :class="scrolled ? 'shadow-lg' : 'shadow-sm'"
    class="fixed top-0 left-0 right-0 z-50 bg-bark-900/95 backdrop-blur-md transition-shadow duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo / Restaurant Name -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <!-- Logo Image -->
                    <div class="w-12 h-12 rounded-lg overflow-hidden group-hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ asset('img/logo.jpeg') }}" alt="{{ setting('restaurant_name', 'Asya\'s Kitchen') }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="font-heading text-2xl font-bold text-cream-100 group-hover:text-wood-400 transition-colors duration-300">
                            {{ setting('restaurant_name', 'Asya\'s Kitchen') }}
                        </h1>
                        <p class="text-xs text-cream-200 font-medium">Makanan Khas Indonesia</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation Links (Center) -->
            <div class="hidden lg:flex items-center space-x-1">
                <a
                    href="{{ route('home') }}"
                    class="px-4 py-2 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('home') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                >
                    Beranda
                </a>
                <a
                    href="{{ route('menu') }}"
                    class="px-4 py-2 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('menu') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                >
                    Menu
                </a>
                <a
                    href="{{ route('gallery') }}"
                    class="px-4 py-2 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('gallery') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                >
                    Galeri
                </a>
                <a
                    href="{{ route('promos') }}"
                    class="px-4 py-2 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('promos') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                >
                    Promo
                </a>
                <a
                    href="{{ route('testimonials') }}"
                    class="px-4 py-2 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('testimonials') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                >
                    Testimoni
                </a>
                <a
                    href="{{ route('contact') }}"
                    class="px-4 py-2 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('contact') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                >
                    Kontak
                </a>
            </div>

            <!-- Desktop CTA Button & User Menu -->
            <div class="hidden lg:flex items-center space-x-4">
                @auth
                    <!-- User Dropdown Menu -->
                    <div x-data="{ userMenuOpen: false }" class="relative">
                        <button @click="userMenuOpen = !userMenuOpen" 
                                @click.away="userMenuOpen = false"
                                class="flex items-center space-x-2 px-4 py-2 rounded-lg text-cream-100 hover:bg-wood-500/10 transition-all duration-300">
                            <div class="w-8 h-8 bg-wood-500 rounded-full flex items-center justify-center">
                                <span class="text-sm font-bold text-cream-100">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="font-medium">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" :class="{'rotate-180': userMenuOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="userMenuOpen" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 z-50">
                            
                            <div class="px-4 py-2 border-b border-gray-200">
                                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                            </div>

                            <a href="{{ route('my-reservations') }}" 
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Reservasi Saya
                            </a>

                            @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" 
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Dashboard Admin
                            </a>
                            @endif

                            <div class="border-t border-gray-200 my-2"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Reservasi Button for Authenticated Users -->
                    <a href="{{ route('reservation') }}"
                       class="inline-flex items-center px-6 py-3 bg-wood-500 text-cream-100 font-semibold rounded-lg hover:bg-wood-600 transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Reservasi Sekarang
                    </a>
                @else
                    <!-- Login & Register Buttons for Guests -->
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center px-4 py-2 text-cream-100 font-medium hover:text-wood-400 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center px-6 py-3 bg-wood-500 text-cream-100 font-semibold rounded-lg hover:bg-wood-600 transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Daftar
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-cream-100 hover:text-wood-400 hover:bg-wood-500/10 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-wood-400 transition-colors duration-300"
                    :aria-expanded="mobileMenuOpen"
                >
                    <span class="sr-only">Buka menu</span>
                    <!-- Hamburger Icon -->
                    <svg
                        x-show="!mobileMenuOpen"
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Close Icon -->
                    <svg
                        x-show="mobileMenuOpen"
                        x-cloak
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div
        x-show="mobileMenuOpen"
        x-cloak
        @click="mobileMenuOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-bark-900/50 backdrop-blur-sm lg:hidden z-40"
    ></div>

    <!-- Mobile Menu Panel -->
    <div
        x-show="mobileMenuOpen"
        x-cloak
        x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 bottom-0 w-80 bg-bark-900 shadow-2xl lg:hidden z-50 overflow-y-auto"
    >
        <div class="p-6">
            <!-- Mobile Menu Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="font-heading text-2xl font-bold text-cream-100">Menu</h2>
                    <p class="text-sm text-cream-200">{{ setting('restaurant_name', 'Asya\'s Kitchen') }}</p>
                </div>
                <button
                    @click="mobileMenuOpen = false"
                    class="p-2 rounded-lg text-cream-100 hover:bg-wood-500/10 transition-colors duration-300"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation Links -->
            <div class="space-y-2 mb-8">
                <a
                    href="{{ route('home') }}"
                    class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('home') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                    @click="mobileMenuOpen = false"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>
                <a
                    href="{{ route('menu') }}"
                    class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('menu') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                    @click="mobileMenuOpen = false"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Menu
                </a>
                <a
                    href="{{ route('gallery') }}"
                    class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('gallery') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                    @click="mobileMenuOpen = false"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Galeri
                </a>
                <a
                    href="{{ route('promos') }}"
                    class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('promos') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                    @click="mobileMenuOpen = false"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Promo
                </a>
                <a
                    href="{{ route('testimonials') }}"
                    class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('testimonials') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                    @click="mobileMenuOpen = false"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Testimoni
                </a>
                <a
                    href="{{ route('contact') }}"
                    class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('contact') ? 'text-wood-400 bg-wood-500/20' : 'text-cream-100 hover:text-wood-400 hover:bg-wood-500/10' }}"
                    @click="mobileMenuOpen = false"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Kontak
                </a>
            </div>

            <!-- Mobile CTA Button & Auth -->
            <div class="pt-6 border-t border-wood-500/20 space-y-3">
                @auth
                    <!-- User Info -->
                    <div class="px-4 py-3 bg-wood-500/10 rounded-lg mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-wood-500 rounded-full flex items-center justify-center">
                                <span class="text-sm font-bold text-cream-100">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-cream-100">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-cream-200">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- My Reservations Link -->
                    <a href="{{ route('my-reservations') }}"
                       class="flex items-center px-4 py-3 rounded-lg font-medium text-cream-100 hover:text-wood-400 hover:bg-wood-500/10 transition-all duration-300"
                       @click="mobileMenuOpen = false">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Reservasi Saya
                    </a>

                    @if(auth()->user()->is_admin)
                    <!-- Admin Dashboard Link -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-4 py-3 rounded-lg font-medium text-cream-100 hover:text-wood-400 hover:bg-wood-500/10 transition-all duration-300"
                       @click="mobileMenuOpen = false">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Dashboard Admin
                    </a>
                    @endif

                    <!-- Reservasi Button -->
                    <a href="{{ route('reservation') }}"
                       class="flex items-center justify-center w-full px-6 py-4 bg-wood-500 text-cream-100 font-semibold rounded-lg hover:bg-wood-600 transition-all duration-300 shadow-lg"
                       @click="mobileMenuOpen = false">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Reservasi Sekarang
                    </a>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                                class="flex items-center justify-center w-full px-6 py-3 bg-red-500/10 text-red-400 font-semibold rounded-lg hover:bg-red-500/20 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                @else
                    <!-- Login Button -->
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center w-full px-6 py-3 bg-white/10 text-cream-100 font-semibold rounded-lg hover:bg-white/20 transition-all duration-300"
                       @click="mobileMenuOpen = false">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login
                    </a>

                    <!-- Register Button -->
                    <a href="{{ route('register') }}"
                       class="flex items-center justify-center w-full px-6 py-4 bg-wood-500 text-cream-100 font-semibold rounded-lg hover:bg-wood-600 transition-all duration-300 shadow-lg"
                       @click="mobileMenuOpen = false">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Daftar Sekarang
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Footer -->
            <div class="mt-8 pt-6 border-t border-wood-500/20">
                <p class="text-xs text-center text-wood-600">
                    {{ setting('site_name', 'RsvMeja') }} &copy; {{ date('Y') }}
                </p>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer to prevent content from hiding under fixed navbar -->
<div class="h-20"></div>
