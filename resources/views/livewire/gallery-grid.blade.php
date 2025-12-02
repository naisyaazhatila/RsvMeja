<div wire:poll.5s>
    <!-- Category Filter -->
    <div class="flex flex-wrap gap-3 mb-12 justify-center">
        <button @click="filterCategory = 'all'" 
                :class="filterCategory === 'all' ? 'bg-wood-500 text-cream-100' : 'bg-white text-gray-700 hover:bg-gray-100'"
                class="px-6 py-2 rounded-full font-semibold transition-all">
            Semua
        </button>
        @foreach($categories as $cat)
        <button @click="filterCategory = '{{ $cat }}'" 
                :class="filterCategory === '{{ $cat }}' ? 'bg-wood-500 text-cream-100' : 'bg-white text-gray-700 hover:bg-gray-100'"
                class="px-6 py-2 rounded-full font-semibold transition-all">
            {{ ucfirst($cat) }}
        </button>
        @endforeach
    </div>

    <!-- Gallery Grid -->
    @if($images->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($images as $image)
        <div class="relative overflow-hidden rounded-lg shadow-lg group cursor-pointer aspect-square bg-gray-200"
             x-show="filterCategory === 'all' || filterCategory === '{{ $image->category }}'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             @click="openLightbox({{ $image->id }})">
            
            <img src="{{ asset($image->image_path) }}" 
                 alt="{{ $image->title }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
            
            <div class="absolute inset-0 bg-gradient-to-t from-bark-900/80 via-bark-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                <h3 class="text-cream-100 font-bold text-lg mb-1">{{ $image->title }}</h3>
                @if($image->description)
                <p class="text-cream-200 text-sm">{{ Str::limit($image->description, 60) }}</p>
                @endif
                <span class="absolute top-3 right-3 bg-wood-500 text-cream-100 px-3 py-1 rounded-full text-xs font-semibold">
                    {{ ucfirst($image->category) }}
                </span>
            </div>

            <!-- Magnify Icon -->
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <div class="bg-white/90 p-4 rounded-full">
                    <svg class="w-8 h-8 text-bark-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                    </svg>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16">
        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <h3 class="text-2xl font-bold text-gray-400 mb-2">Galeri Kosong</h3>
        <p class="text-gray-500">Foto akan segera ditambahkan</p>
    </div>
    @endif

    <script>
        // Update images data for lightbox
        window.galleryImages = @json($allImages);
    </script>
</div>
