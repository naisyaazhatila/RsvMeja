<x-admin-layout title="Tambah Testimoni">
    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-4 mb-4">
                    <a href="{{ route('admin.testimoni.index') }}" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Tambah Testimoni Baru</h1>
                        <p class="mt-1 text-sm text-gray-600">Lengkapi form di bawah untuk menambah testimoni</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <form action="{{ route('admin.testimoni.store') }}" method="POST">
                    @csrf

                    <!-- Customer Name -->
                    <div class="mb-6">
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Pelanggan <span class="text-red-500">*</span></label>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('customer_name') border-red-500 @enderror">
                        @error('customer_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rating -->
                    <div class="mb-6">
                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
                        <select name="rating" id="rating" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('rating') border-red-500 @enderror">
                            <option value="">Pilih Rating</option>
                            <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 - Sangat Baik)</option>
                            <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 - Baik)</option>
                            <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 - Cukup)</option>
                            <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ (2 - Kurang)</option>
                            <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ (1 - Sangat Kurang)</option>
                        </select>
                        @error('rating')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Testimonial -->
                    <div class="mb-6">
                        <label for="testimonial" class="block text-sm font-medium text-gray-700 mb-2">Testimoni <span class="text-red-500">*</span></label>
                        <textarea name="testimonial" id="testimonial" rows="6" required
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('testimonial') border-red-500 @enderror">{{ old('testimonial') }}</textarea>
                        @error('testimonial')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Is Featured Checkbox -->
                    <div class="mb-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                       class="w-4 h-4 text-wood-600 border-gray-300 rounded focus:ring-wood-500">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_featured" class="font-medium text-gray-700">Featured</label>
                                <p class="text-gray-500">Tampilkan di halaman utama</p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.testimoni.index') }}" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-wood-600 hover:bg-wood-700 text-white font-semibold rounded-lg transition duration-200">
                            Simpan Testimoni
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
