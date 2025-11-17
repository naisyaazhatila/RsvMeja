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
                            <label for="restaurant_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="restaurant_email" id="restaurant_email" 
                                   value="{{ old('restaurant_email', setting('restaurant_email')) }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="restaurant_phone" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                            <input type="text" name="restaurant_phone" id="restaurant_phone" 
                                   value="{{ old('restaurant_phone', setting('restaurant_phone')) }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="restaurant_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="restaurant_address" id="restaurant_address" rows="3"
                                      class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">{{ old('restaurant_address', setting('restaurant_address')) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Media Sosial</h2>
                    
                    <div class="space-y-6">
                        <!-- Facebook -->
                        <div>
                            <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                            <input type="url" name="facebook_url" id="facebook_url" 
                                   value="{{ old('facebook_url', setting('facebook_url')) }}"
                                   placeholder="https://facebook.com/yourpage"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- Instagram -->
                        <div>
                            <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                            <input type="url" name="instagram_url" id="instagram_url" 
                                   value="{{ old('instagram_url', setting('instagram_url')) }}"
                                   placeholder="https://instagram.com/yourprofile"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- WhatsApp -->
                        <div>
                            <label for="whatsapp_number" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number</label>
                            <input type="text" name="whatsapp_number" id="whatsapp_number" 
                                   value="{{ old('whatsapp_number', setting('whatsapp_number')) }}"
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
                        <!-- Operating Hours Text -->
                        <div>
                            <label for="operating_hours" class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional</label>
                            <input type="text" name="operating_hours" id="operating_hours" 
                                   value="{{ old('operating_hours', setting('operating_hours')) }}"
                                   placeholder="10:00 - 22:00"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                            <p class="mt-1 text-sm text-gray-500">Format: HH:MM - HH:MM</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Opening Time -->
                            <div>
                                <label for="opening_time" class="block text-sm font-medium text-gray-700 mb-2">Jam Buka (Detail)</label>
                                <input type="time" name="opening_time" id="opening_time" 
                                       value="{{ old('opening_time', setting('opening_time')) }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                            </div>

                            <!-- Closing Time -->
                            <div>
                                <label for="closing_time" class="block text-sm font-medium text-gray-700 mb-2">Jam Tutup (Detail)</label>
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

                <!-- Payment Settings -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Pengaturan Pembayaran</h2>
                    
                    <div class="space-y-6">
                        <!-- DP Amount -->
                        <div>
                            <label for="dp_amount" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Down Payment (Rp)</label>
                            <input type="number" name="dp_amount" id="dp_amount" 
                                   value="{{ old('dp_amount', setting('dp_amount', 100000)) }}"
                                   min="0" step="10000"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                            <p class="mt-1 text-sm text-gray-500">DP yang harus dibayar untuk reservasi</p>
                        </div>

                        <!-- Bank Name -->
                        <div>
                            <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Bank</label>
                            <input type="text" name="bank_name" id="bank_name" 
                                   value="{{ old('bank_name', setting('bank_name')) }}"
                                   placeholder="BCA"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- Account Number -->
                        <div>
                            <label for="account_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Rekening</label>
                            <input type="text" name="account_number" id="account_number" 
                                   value="{{ old('account_number', setting('account_number')) }}"
                                   placeholder="5420123456"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>

                        <!-- Account Holder -->
                        <div>
                            <label for="account_holder" class="block text-sm font-medium text-gray-700 mb-2">Atas Nama</label>
                            <input type="text" name="account_holder" id="account_holder" 
                                   value="{{ old('account_holder', setting('account_holder')) }}"
                                   placeholder="Asya's Kitchen"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
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

                        <!-- Google Maps Embed -->
                        <div>
                            <label for="google_maps_embed" class="block text-sm font-medium text-gray-700 mb-2">Google Maps Embed Code</label>
                            <textarea name="google_maps_embed" id="google_maps_embed" rows="4"
                                      placeholder="<iframe src='https://www.google.com/maps/embed?...' width='600' height='450'></iframe>"
                                      class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">{{ old('google_maps_embed', setting('google_maps_embed')) }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Paste embed code dari Google Maps</p>
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
