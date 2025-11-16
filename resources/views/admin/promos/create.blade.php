<x-admin-layout title="Tambah Promo">
    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-4 mb-4">
                    <a href="{{ route('admin.promo.index') }}" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Tambah Promo Baru</h1>
                        <p class="mt-1 text-sm text-gray-600">Lengkapi form di bawah untuk menambah promo</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <form action="{{ route('admin.promo.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Promo <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="4" required
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Discount Type -->
                    <div class="mb-6">
                        <label for="discount_type" class="block text-sm font-medium text-gray-700 mb-2">Tipe Diskon <span class="text-red-500">*</span></label>
                        <select name="discount_type" id="discount_type" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('discount_type') border-red-500 @enderror">
                            <option value="">Pilih Tipe Diskon</option>
                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Nominal (Rp)</option>
                        </select>
                        @error('discount_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Discount Value -->
                    <div class="mb-6">
                        <label for="discount_value" class="block text-sm font-medium text-gray-700 mb-2">Nilai Diskon <span class="text-red-500">*</span></label>
                        <input type="number" name="discount_value" id="discount_value" value="{{ old('discount_value') }}" min="0" step="0.01" required
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('discount_value') border-red-500 @enderror">
                        @error('discount_value')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Promo</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('image') border-red-500 @enderror"
                               onchange="previewImage(event)">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div id="imagePreview" class="mt-3 hidden">
                            <img src="" alt="Preview" class="w-full h-64 object-cover rounded-lg">
                        </div>
                    </div>

                    <!-- Valid Period -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="valid_from" class="block text-sm font-medium text-gray-700 mb-2">Berlaku Dari <span class="text-red-500">*</span></label>
                            <input type="date" name="valid_from" id="valid_from" value="{{ old('valid_from') }}" required
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('valid_from') border-red-500 @enderror">
                            @error('valid_from')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="valid_until" class="block text-sm font-medium text-gray-700 mb-2">Berlaku Sampai <span class="text-red-500">*</span></label>
                            <input type="date" name="valid_until" id="valid_until" value="{{ old('valid_until') }}" required
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('valid_until') border-red-500 @enderror">
                            @error('valid_until')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="mb-6">
                        <label for="terms" class="block text-sm font-medium text-gray-700 mb-2">Syarat & Ketentuan</label>
                        <textarea name="terms" id="terms" rows="4"
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('terms') border-red-500 @enderror">{{ old('terms') }}</textarea>
                        @error('terms')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Is Active Checkbox -->
                    <div class="mb-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="w-4 h-4 text-wood-600 border-gray-300 rounded focus:ring-wood-500">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_active" class="font-medium text-gray-700">Promo Aktif</label>
                                <p class="text-gray-500">Promo ditampilkan di website</p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.promo.index') }}" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-wood-600 hover:bg-wood-700 text-white font-semibold rounded-lg transition duration-200">
                            Simpan Promo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const img = preview.querySelector('img');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        }
    </script>
    @endpush
</x-admin-layout>
