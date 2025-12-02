<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-bark-900 to-wood-800 text-cream-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-4">Galeri</h1>
            <p class="text-xl text-cream-200">Lihat momen indah dan suasana di restaurant kami</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-16 bg-cream-50" x-data="gallery()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @livewire('gallery-grid')

        </div>

        <!-- Lightbox Modal -->
        <div x-show="lightboxOpen" 
             x-cloak
             @keydown.escape.window="closeLightbox()"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/95 p-4"
             @click="closeLightbox()">
            
            <!-- Close Button -->
            <button @click="closeLightbox()" class="absolute top-4 right-4 text-cream-100 hover:text-wood-400 transition z-10">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Previous Button -->
            <button @click.stop="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 text-cream-100 hover:text-wood-400 transition p-2">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Next Button -->
            <button @click.stop="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 text-cream-100 hover:text-wood-400 transition p-2">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Image Container -->
            <div @click.stop class="max-w-6xl w-full">
                <template x-if="currentImage">
                    <div class="text-center">
                        <img :src="currentImage.url" 
                             :alt="currentImage.title"
                             class="max-h-[80vh] mx-auto rounded-lg shadow-2xl">
                        <div class="mt-6 text-cream-100">
                            <h3 class="text-2xl font-heading font-bold mb-2" x-text="currentImage.title"></h3>
                            <p class="text-cream-200" x-text="currentImage.description"></p>
                            <p class="text-sm text-cream-300 mt-2">
                                <span class="bg-wood-500 px-3 py-1 rounded-full" x-text="currentImage.category"></span>
                            </p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Cache busting: {{ now()->timestamp }}
        function gallery() {
            return {
                filterCategory: 'all',
                lightboxOpen: false,
                currentImageId: null,
                
                get images() {
                    return window.galleryImages || @json($allImages || []);
                },

                get currentImage() {
                    return this.images.find(img => img.id === this.currentImageId) || null;
                },

                get currentIndex() {
                    return this.images.findIndex(img => img.id === this.currentImageId);
                },

                openLightbox(imageId) {
                    this.currentImageId = imageId;
                    this.lightboxOpen = true;
                    document.body.style.overflow = 'hidden';
                },

                closeLightbox() {
                    this.lightboxOpen = false;
                    document.body.style.overflow = '';
                },

                nextImage() {
                    const nextIndex = (this.currentIndex + 1) % this.images.length;
                    this.currentImageId = this.images[nextIndex].id;
                },

                prevImage() {
                    const prevIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                    this.currentImageId = this.images[prevIndex].id;
                }
            }
        }
    </script>
    @endpush
</x-app-layout>
