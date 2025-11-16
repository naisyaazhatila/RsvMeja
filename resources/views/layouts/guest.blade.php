<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-bark-900 via-wood-800 to-bark-900 relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                </div>

                <div class="relative z-10 flex flex-col justify-center items-center w-full px-12 text-center">
                    <!-- Logo -->
                    <div class="mb-8">
                        <div class="w-32 h-32 mx-auto rounded-2xl overflow-hidden shadow-2xl ring-4 ring-wood-500/50 mb-6">
                            <img src="{{ asset('img/logo.jpeg') }}" alt="Asya's Kitchen" class="w-full h-full object-cover">
                        </div>
                        <h1 class="font-heading text-5xl font-bold text-cream-100 mb-3">
                            Asya's Kitchen
                        </h1>
                        <p class="text-xl text-wood-400 font-medium mb-8">
                            Makanan Khas Indonesia
                        </p>
                    </div>

                    <!-- Welcome Text -->
                    <div class="max-w-md">
                        <p class="text-cream-200 text-lg leading-relaxed mb-6">
                            Nikmati kelezatan cita rasa nusantara dengan sentuhan modern. 
                            Reservasi meja Anda sekarang untuk pengalaman kuliner yang tak terlupakan.
                        </p>
                        <div class="flex items-center justify-center space-x-6 text-cream-300">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-wood-400">500+</div>
                                <div class="text-sm">Menu Lezat</div>
                            </div>
                            <div class="w-px h-12 bg-wood-500/30"></div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-wood-400">1000+</div>
                                <div class="text-sm">Reservasi</div>
                            </div>
                            <div class="w-px h-12 bg-wood-500/30"></div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-wood-400">4.8★</div>
                                <div class="text-sm">Rating</div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute top-10 left-10 w-20 h-20 bg-wood-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-10 right-10 w-32 h-32 bg-wood-500/20 rounded-full blur-3xl"></div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-cream-50">
                <div class="w-full max-w-md">
                    <!-- Mobile Logo (visible on small screens) -->
                    <div class="lg:hidden text-center mb-8">
                        <div class="w-20 h-20 mx-auto rounded-xl overflow-hidden shadow-lg ring-2 ring-wood-500/30 mb-4">
                            <img src="{{ asset('img/logo.jpeg') }}" alt="Asya's Kitchen" class="w-full h-full object-cover">
                        </div>
                        <h2 class="font-heading text-3xl font-bold text-bark-900">Asya's Kitchen</h2>
                        <p class="text-sm text-gray-600">Makanan Khas Indonesia</p>
                    </div>

                    <!-- Form Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        {{ $slot }}
                    </div>

                    <!-- Back to Home -->
                    <div class="text-center mt-6">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-wood-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
