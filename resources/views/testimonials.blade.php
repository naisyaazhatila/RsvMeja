<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-bark-900 to-wood-800 text-cream-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-4">Testimoni Pelanggan</h1>
            <p class="text-xl text-cream-200">Apa kata mereka yang sudah merasakan pengalaman di tempat kami</p>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-12 bg-wood-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center text-cream-100">
                <div>
                    <div class="text-5xl font-bold mb-2">{{ $totalTestimonials }}</div>
                    <div class="text-cream-200">Total Testimoni</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2 flex items-center justify-center">
                        {{ number_format($averageRating, 1) }}
                        <svg class="w-10 h-10 text-yellow-400 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div class="text-cream-200">Rating Rata-rata</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2">99%</div>
                    <div class="text-cream-200">Kepuasan Pelanggan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Grid -->
    <section class="py-16 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($testimonials->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-2xl transition-all duration-300 flex flex-col relative">
                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-6 h-6 {{ $i < $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        @endfor
                        <span class="ml-2 text-sm text-gray-500">({{ $testimonial->rating }}/5)</span>
                    </div>

                    <!-- Comment -->
                    <blockquote class="flex-grow mb-6">
                        <svg class="w-8 h-8 text-wood-300 mb-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="text-gray-700 italic leading-relaxed">
                            "{{ $testimonial->comment }}"
                        </p>
                    </blockquote>

                    <!-- Customer Info -->
                    <div class="flex items-center border-t pt-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-wood-500 to-wood-700 rounded-full flex items-center justify-center text-cream-100 font-bold text-xl shadow-lg">
                            {{ strtoupper(substr($testimonial->customer_name, 0, 1)) }}
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold text-bark-900 text-lg">{{ $testimonial->customer_name }}</div>
                            <div class="text-sm text-gray-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                {{ $testimonial->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    <!-- Featured Badge -->
                    @if($testimonial->is_featured)
                    <div class="absolute top-4 right-4">
                        <span class="bg-yellow-400 text-bark-900 text-xs font-bold px-3 py-1 rounded-full shadow-lg flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Featured
                        </span>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $testimonials->links() }}
            </div>

            @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <h3 class="text-2xl font-semibold text-gray-700 mb-2">Belum Ada Testimoni</h3>
                <p class="text-gray-500">Jadilah yang pertama untuk memberikan testimoni!</p>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-br from-wood-500 to-wood-700 text-cream-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-4xl font-bold mb-4">Punya Pengalaman Menarik?</h2>
            <p class="text-xl text-cream-200 mb-8">
                Bagikan pengalaman Anda bersama kami dan bantu calon pelanggan lainnya!
            </p>
            <a href="{{ route('reservation') }}" class="inline-flex items-center bg-cream-100 text-wood-700 px-8 py-4 rounded-lg font-semibold hover:bg-cream-200 transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Buat Reservasi Sekarang
            </a>
        </div>
    </section>
</x-app-layout>
