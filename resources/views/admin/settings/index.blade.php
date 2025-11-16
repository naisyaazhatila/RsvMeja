<x-admin-layout title="Settings">
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Pengaturan Restoran</h1>
                <p class="mt-2 text-sm text-gray-600">Kelola informasi dan konfigurasi restoran</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Settings Form -->
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Restaurant Info -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Informasi Restoran</h2>
                    
                    <div class="space-y-6">
                        <!-- Restaurant Name -->
                        <div>
                            <label for="restaurant_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Restoran</label>
                            <input type="text" name="restaurant_name" id="restaurant_name" 
                                   value="{{ old('restaurant_name', setting('restaurant_name')) }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" 
                                   value="{{ old('email', setting('email')) }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                            <input type="text" name="phone" id="phone" 
                                   value="{{ old('phone', setting('phone')) }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="address" id="address" rows="3"
                                      class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">{{ old('address', setting('address')) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Media Sosial</h2>
                    
                    <div class="space-y-6">
                        <!-- Facebook -->
                        <div>
                            <label for="facebook" class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                            <input type="url" name="facebook" id="facebook" 
                                   value="{{ old('facebook', setting('facebook')) }}"
                                   placeholder="https://facebook.com/yourpage"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- Instagram -->
                        <div>
                            <label for="instagram" class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                            <input type="url" name="instagram" id="instagram" 
                                   value="{{ old('instagram', setting('instagram')) }}"
                                   placeholder="https://instagram.com/yourprofile"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- WhatsApp -->
                        <div>
                            <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number</label>
                            <input type="text" name="whatsapp" id="whatsapp" 
                                   value="{{ old('whatsapp', setting('whatsapp')) }}"
                                   placeholder="628123456789"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                            <p class="mt-1 text-sm text-gray-500">Format: 628xxxxxxxxxx (tanpa +)</p>
                        </div>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Jam Operasional</h2>
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Opening Time -->
                            <div>
                                <label for="opening_time" class="block text-sm font-medium text-gray-700 mb-2">Jam Buka</label>
                                <input type="time" name="opening_time" id="opening_time" 
                                       value="{{ old('opening_time', setting('opening_time')) }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                            </div>

                            <!-- Closing Time -->
                            <div>
                                <label for="closing_time" class="block text-sm font-medium text-gray-700 mb-2">Jam Tutup</label>
                                <input type="time" name="closing_time" id="closing_time" 
                                       value="{{ old('closing_time', setting('closing_time')) }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                            </div>
                        </div>

                        <!-- Closed Monday -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="is_closed_monday" id="is_closed_monday" value="1" 
                                       {{ old('is_closed_monday', setting('is_closed_monday')) ? 'checked' : '' }}
                                       class="w-4 h-4 text-wood-600 border-gray-300 rounded focus:ring-wood-500">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_closed_monday" class="font-medium text-gray-700">Tutup pada hari Senin</label>
                                <p class="text-gray-500">Centang jika restoran tutup setiap hari Senin</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other Settings -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Pengaturan Lainnya</h2>
                    
                    <div class="space-y-6">
                        <!-- Logo Upload -->
                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Logo Restoran</label>
                            @if(setting('logo'))
                                <div class="mb-3">
                                    <img src="{{ Storage::url(setting('logo')) }}" alt="Logo" class="w-32 h-32 object-contain">
                                    <p class="mt-1 text-sm text-gray-500">Logo saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="logo" id="logo" accept="image/*"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500"
                                   onchange="previewLogo(event)">
                            <div id="logoPreview" class="mt-3 hidden">
                                <img src="" alt="Preview" class="w-32 h-32 object-contain">
                                <p class="mt-1 text-sm text-gray-500">Preview logo baru</p>
                            </div>
                        </div>

                        <!-- Min DP Amount -->
                        <div>
                            <label for="min_dp_amount" class="block text-sm font-medium text-gray-700 mb-2">Minimal Down Payment (Rp)</label>
                            <input type="number" name="min_dp_amount" id="min_dp_amount" 
                                   value="{{ old('min_dp_amount', setting('min_dp_amount', 100000)) }}"
                                   min="0" step="10000"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                            <p class="mt-1 text-sm text-gray-500">Minimal DP yang harus dibayar untuk reservasi</p>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex items-center justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-wood-600 hover:bg-wood-700 text-white font-semibold rounded-lg transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewLogo(event) {
            const preview = document.getElementById('logoPreview');
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
