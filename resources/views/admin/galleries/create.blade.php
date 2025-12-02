<x-admin-layout title="Tambah Foto Gallery">
    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-4 mb-4">
                    <a href="{{ route('admin.galeri.index') }}" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Tambah Foto Baru</h1>
                        <p class="mt-1 text-sm text-gray-600">Lengkapi form di bawah untuk menambah foto ke galeri</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="category" id="category" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('category') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Food</option>
                            <option value="interior" {{ old('category') == 'interior' ? 'selected' : '' }}>Interior</option>
                            <option value="ambiance" {{ old('category') == 'ambiance' ? 'selected' : '' }}>Ambiance</option>
                            <option value="event" {{ old('category') == 'event' ? 'selected' : '' }}>Event</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar <span class="text-red-500">*</span></label>
                        <input type="file" name="image" id="image" accept="image/*" required
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500 @error('image') border-red-500 @enderror"
                               onchange="previewImage(event)">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div id="imagePreview" class="mt-3 hidden">
                            <img src="" alt="Preview" class="w-full h-96 object-cover rounded-lg">
                        </div>
                    </div>

                    <!-- Is Active -->
                    <div class="mb-6">
                        <label class="flex items-center gap-3">
                            <input type="checkbox" name="is_active" value="1" checked
                                   class="rounded border-gray-300 text-wood-600 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                            <span class="text-sm font-medium text-gray-700">Aktifkan galeri ini (tampil di website)</span>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.galeri.index') }}" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-wood-600 hover:bg-wood-700 text-white font-semibold rounded-lg transition duration-200">
                            Simpan Foto
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
