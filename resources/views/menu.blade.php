<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-bark-900 to-wood-800 text-cream-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-4">Menu Kami</h1>
            <p class="text-xl text-cream-200">Jelajahi koleksi hidangan istimewa kami</p>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="py-16 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search and Filter -->
            <div class="mb-8 bg-white rounded-lg shadow-md p-6">
                <form method="GET" action="{{ route('menu') }}" class="space-y-4">
                    <!-- Search Box -->
                    <div>
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">Cari Menu</label>
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   id="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama menu atau deskripsi..." 
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-wood-500 focus:border-transparent">
                            <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Filters Row -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Category Filter -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-wood-500">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Vegetarian Filter -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Vegetarian</label>
                            <select name="vegetarian" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-wood-500">
                                <option value="">Semua</option>
                                <option value="1" {{ request('vegetarian') == '1' ? 'selected' : '' }}>✓ Hanya Vegetarian</option>
                            </select>
                        </div>

                        <!-- Spicy Filter -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pedas</label>
                            <select name="spicy" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-wood-500">
                                <option value="">Semua</option>
                                <option value="yes" {{ request('spicy') == 'yes' ? 'selected' : '' }}>🌶️ Pedas</option>
                                <option value="no" {{ request('spicy') == 'no' ? 'selected' : '' }}>Tidak Pedas</option>
                            </select>
                        </div>

                        <!-- Spicy Level Filter -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Level Pedas</label>
                            <select name="spicy_level" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-wood-500">
                                <option value="">Semua Level</option>
                                <option value="mild" {{ request('spicy_level') == 'mild' ? 'selected' : '' }}>🌶️ Mild</option>
                                <option value="medium" {{ request('spicy_level') == 'medium' ? 'selected' : '' }}>🌶️🌶️ Medium</option>
                                <option value="hot" {{ request('spicy_level') == 'hot' ? 'selected' : '' }}>🌶️🌶️🌶️ Hot</option>
                                <option value="extra_hot" {{ request('spicy_level') == 'extra_hot' ? 'selected' : '' }}>🌶️🌶️🌶️🌶️ Extra Hot</option>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button type="submit" class="px-6 py-2 bg-wood-500 hover:bg-wood-600 text-white font-semibold rounded-lg transition">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Terapkan Filter
                        </button>
                        <a href="{{ route('menu') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Results Count -->
            @if(request()->hasAny(['search', 'category', 'vegetarian', 'spicy', 'spicy_level']))
            <div class="mb-6 text-gray-600">
                Menampilkan <span class="font-bold text-bark-900">{{ $menus->count() }}</span> menu
                @if(request('search'))
                    untuk pencarian "<span class="font-bold text-wood-600">{{ request('search') }}</span>"
                @endif
            </div>
            @endif
            
            <!-- Category Filter Pills (Keep for quick access) -->
            <div class="flex flex-wrap gap-3 mb-12 justify-center">
                <a href="{{ route('menu') }}" 
                   class="px-6 py-2 rounded-full font-semibold transition-all {{ !request('category') && !request()->hasAny(['search', 'vegetarian', 'spicy']) ? 'bg-wood-500 text-cream-100' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    Semua Menu
                </a>
                @foreach($categories as $category)
                <a href="{{ route('menu', ['category' => $category->id]) }}" 
                   class="px-6 py-2 rounded-full font-semibold transition-all {{ request('category') == $category->id ? 'bg-wood-500 text-cream-100' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>

            <!-- Menu Items -->
            @if($menus->count() > 0)
                @if(!request('category'))
                    <!-- Display by Category -->
                    @foreach($categories as $category)
                        @php
                            $categoryMenus = $menus->where('category_id', $category->id);
                        @endphp
                        
                        @if($categoryMenus->count() > 0)
                        <div class="mb-16">
                            <h2 class="font-heading text-3xl font-bold text-bark-900 mb-8 pb-4 border-b-2 border-wood-500">
                                {{ $category->name }}
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach($categoryMenus as $menu)
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                                    <div class="relative overflow-hidden h-56">
                                        @if($menu->image)
                                        <img src="{{ Storage::url($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                        @else
                                        <div class="w-full h-full bg-gradient-to-br from-wood-400 to-wood-600 flex items-center justify-center">
                                            <svg class="w-24 h-24 text-cream-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        @endif
                                        @if($menu->is_featured)
                                        <span class="absolute top-3 right-3 bg-yellow-500 text-bark-900 px-3 py-1 rounded-full text-xs font-bold shadow">
                                            Favorit
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <div class="p-6">
                                        <!-- Badges: Vegetarian & Spicy -->
                                        @if($menu->is_vegetarian || $menu->is_spicy)
                                        <div class="flex flex-wrap gap-2 mb-3">
                                            @if($menu->is_vegetarian)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                🌱 Vegetarian
                                            </span>
                                            @endif
                                            
                                            @if($menu->is_spicy)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                @if($menu->spicy_level == 'mild')
                                                    🌶️ Mild
                                                @elseif($menu->spicy_level == 'medium')
                                                    🌶️🌶️ Medium
                                                @elseif($menu->spicy_level == 'hot')
                                                    🌶️🌶️🌶️ Hot
                                                @elseif($menu->spicy_level == 'extra_hot')
                                                    🌶️🌶️🌶️🌶️ Extra Hot
                                                @else
                                                    🌶️ Pedas
                                                @endif
                                            </span>
                                            @endif
                                        </div>
                                        @endif
                                        
                                        <h3 class="font-heading text-2xl font-bold text-bark-900 mb-2">{{ $menu->name }}</h3>
                                        <p class="text-gray-600 mb-4">{{ $menu->description }}</p>
                                        
                                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-200">
                                            <span class="text-3xl font-bold text-wood-500">
                                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                                            </span>
                                            @if($menu->is_available)
                                            <span class="text-green-600 text-sm font-semibold flex items-center">
                                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Tersedia
                                            </span>
                                            @else
                                            <span class="text-red-600 text-sm font-semibold">Habis</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                @else
                    <!-- Display Filtered Items -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($menus as $menu)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                            <div class="relative overflow-hidden h-56">
                                @if($menu->image)
                                <img src="{{ Storage::url($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-wood-400 to-wood-600 flex items-center justify-center">
                                    <svg class="w-24 h-24 text-cream-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                @endif
                                @if($menu->is_featured)
                                <span class="absolute top-3 right-3 bg-yellow-500 text-bark-900 px-3 py-1 rounded-full text-xs font-bold shadow">
                                    Favorit
                                </span>
                                @endif
                            </div>
                            
                            <div class="p-6">
                                <!-- Badges: Vegetarian & Spicy -->
                                @if($menu->is_vegetarian || $menu->is_spicy)
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @if($menu->is_vegetarian)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        🌱 Vegetarian
                                    </span>
                                    @endif
                                    
                                    @if($menu->is_spicy)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        @if($menu->spicy_level == 'mild')
                                            🌶️ Mild
                                        @elseif($menu->spicy_level == 'medium')
                                            🌶️🌶️ Medium
                                        @elseif($menu->spicy_level == 'hot')
                                            🌶️🌶️🌶️ Hot
                                        @elseif($menu->spicy_level == 'extra_hot')
                                            🌶️🌶️🌶️🌶️ Extra Hot
                                        @else
                                            🌶️ Pedas
                                        @endif
                                    </span>
                                    @endif
                                </div>
                                @endif
                                
                                <h3 class="font-heading text-2xl font-bold text-bark-900 mb-2">{{ $menu->name }}</h3>
                                <p class="text-gray-600 mb-4">{{ $menu->description }}</p>
                                
                                <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-200">
                                    <span class="text-3xl font-bold text-wood-500">
                                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                                    </span>
                                    @if($menu->is_available)
                                    <span class="text-green-600 text-sm font-semibold flex items-center">
                                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Tersedia
                                    </span>
                                    @else
                                    <span class="text-red-600 text-sm font-semibold">Habis</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-400 mb-2">Tidak Ada Menu</h3>
                    <p class="text-gray-500">Menu akan segera tersedia</p>
                </div>
            @endif

        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="font-heading text-4xl font-bold text-bark-900 mb-4">Tertarik Dengan Menu Kami?</h2>
            <p class="text-gray-600 text-lg mb-8">Segera reservasi meja dan nikmati hidangan istimewa kami</p>
            <a href="{{ route('reservation') }}" class="inline-block bg-wood-500 hover:bg-wood-600 text-cream-100 px-10 py-4 rounded-lg font-bold text-lg transition-all transform hover:scale-105 shadow-lg">
                Reservasi Sekarang
            </a>
        </div>
    </section>
</x-app-layout>
