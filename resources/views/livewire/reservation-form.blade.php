<div>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-bark-900 to-wood-800 text-cream-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-4">Reservasi Meja</h1>
            <p class="text-xl text-cream-200">Pesan meja Anda dengan mudah dalam 4 langkah</p>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-16 bg-cream-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Progress Steps -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-4">
                    @for($i = 1; $i <= $totalSteps; $i++)
                    <div class="flex-1 {{ $i < $totalSteps ? 'mr-2' : '' }}">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center font-bold
                                {{ $currentStep > $i ? 'bg-green-500 text-white' : ($currentStep === $i ? 'bg-wood-500 text-white' : 'bg-gray-300 text-gray-600') }}">
                                @if($currentStep > $i)
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                @else
                                {{ $i }}
                                @endif
                            </div>
                            @if($i < $totalSteps)
                            <div class="flex-1 h-1 ml-2 
                                {{ $currentStep > $i ? 'bg-green-500' : 'bg-gray-300' }}">
                            </div>
                            @endif
                        </div>
                        <div class="mt-2 text-xs md:text-sm font-medium 
                            {{ $currentStep >= $i ? 'text-bark-900' : 'text-gray-500' }}">
                            @if($i === 1) Data Tamu
                            @elseif($i === 2) Tanggal & Waktu
                            @elseif($i === 3) Pilih Meja
                            @else Konfirmasi
                            @endif
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-xl p-8">
                
                <!-- Step 1: Guest Information -->
                @if($currentStep === 1)
                <div>
                    <h2 class="font-heading text-3xl font-bold text-bark-900 mb-6">Informasi Tamu</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model.live="customer_name" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-wood-500 focus:border-transparent transition"
                                   placeholder="Masukkan nama lengkap">
                            @error('customer_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" wire:model.live="customer_email" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-wood-500 focus:border-transparent transition"
                                   placeholder="nama@email.com">
                            @error('customer_email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" wire:model.live="customer_phone" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-wood-500 focus:border-transparent transition"
                                   placeholder="08123456789">
                            @error('customer_phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                @endif

                <!-- Step 2: Date & Time -->
                @if($currentStep === 2)
                <div>
                    <h2 class="font-heading text-3xl font-bold text-bark-900 mb-6">Tanggal & Waktu</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Reservasi <span class="text-red-500">*</span>
                            </label>
                            <input type="date" wire:model="reservation_date" 
                                   min="{{ now()->format('Y-m-d') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-wood-500 focus:border-transparent transition">
                            @error('reservation_date') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Waktu Reservasi <span class="text-red-500">*</span>
                            </label>
                            <select wire:model="reservation_time" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-wood-500 focus:border-transparent transition">
                                <option value="">Pilih Waktu</option>
                                @foreach(range(10, 21) as $hour)
                                    @foreach(['00', '30'] as $minute)
                                    <option value="{{ sprintf('%02d:%s', $hour, $minute) }}">
                                        {{ sprintf('%02d:%s', $hour, $minute) }}
                                    </option>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('reservation_time') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jumlah Tamu <span class="text-red-500">*</span>
                            </label>
                            <input type="number" wire:model="guest_count" min="1" max="20"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-wood-500 focus:border-transparent transition">
                            @error('guest_count') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                @endif

                <!-- Step 3: Table Selection -->
                @if($currentStep === 3)
                <div>
                    <h2 class="font-heading text-3xl font-bold text-bark-900 mb-6">Pilih Meja - Denah Restaurant</h2>
                    
                    @if(count($availableTables) > 0)
                    
                    <!-- Legend -->
                    <div class="flex flex-wrap gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-green-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Tersedia</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-wood-500 rounded mr-2 ring-4 ring-wood-200"></div>
                            <span class="text-sm text-gray-700">Dipilih</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-gray-300 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Tidak Tersedia</span>
                        </div>
                    </div>

                    <!-- Visual Table Map -->
                    <div class="relative bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-8 border-2 border-amber-200 min-h-[500px]">
                        
                        <!-- Restaurant Name Badge -->
                        <div class="absolute top-4 left-1/2 transform -translate-x-1/2 bg-bark-900 text-cream-100 px-6 py-2 rounded-full text-sm font-bold shadow-lg">
                            🍽️ Asya's Kitchen
                        </div>

                        <!-- Entrance -->
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-center">
                            <div class="bg-gray-200 px-6 py-2 rounded-t-lg font-semibold text-gray-700">
                                🚪 PINTU MASUK
                            </div>
                        </div>

                        <!-- Kitchen Area (Top Left) -->
                        <div class="absolute top-16 left-4 bg-gray-200 px-4 py-3 rounded-lg border-2 border-gray-300">
                            <span class="text-xs font-bold text-gray-600">👨‍🍳 DAPUR</span>
                        </div>

                        <!-- Cashier (Top Right) -->
                        <div class="absolute top-16 right-4 bg-gray-200 px-4 py-3 rounded-lg border-2 border-gray-300">
                            <span class="text-xs font-bold text-gray-600">💳 KASIR</span>
                        </div>

                        <!-- Tables Grid Layout -->
                        <div class="grid grid-cols-4 gap-6 pt-32 pb-20 px-8">
                            @php
                                // Get all tables and mark which are available
                                $allTableIds = $availableTables->pluck('id')->toArray();
                                // Create a 4x3 grid (12 positions) - adjust based on your actual tables
                                $tablePositions = [
                                    ['row' => 1, 'col' => 1], ['row' => 1, 'col' => 2], ['row' => 1, 'col' => 3], ['row' => 1, 'col' => 4],
                                    ['row' => 2, 'col' => 1], ['row' => 2, 'col' => 2], ['row' => 2, 'col' => 3], ['row' => 2, 'col' => 4],
                                    ['row' => 3, 'col' => 1], ['row' => 3, 'col' => 2], ['row' => 3, 'col' => 3], ['row' => 3, 'col' => 4],
                                ];
                            @endphp

                            @foreach($availableTables as $index => $table)
                            <div wire:click="$set('table_id', {{ $table->id }})" 
                                 class="cursor-pointer relative group">
                                
                                <!-- Table Visual -->
                                <div class="relative aspect-square rounded-xl transition-all duration-300 transform hover:scale-105
                                    {{ $table_id == $table->id ? 'bg-wood-500 ring-4 ring-wood-200 shadow-xl' : 'bg-green-500 hover:bg-green-600 shadow-lg' }}">
                                    
                                    <!-- Table Number Badge -->
                                    <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shadow-md
                                        {{ $table_id == $table->id ? 'bg-bark-900 text-cream-100' : 'bg-white text-bark-900' }}">
                                        {{ $table->table_number ?? ($index + 1) }}
                                    </div>

                                    <!-- Table Icon -->
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        @if($table_id == $table->id)
                                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        @else
                                        <svg class="w-10 h-10 text-white opacity-70" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                        </svg>
                                        @endif
                                    </div>

                                    <!-- Capacity Badge -->
                                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 bg-white bg-opacity-90 px-2 py-1 rounded-full text-xs font-bold text-bark-900">
                                        👥 {{ $table->capacity }}
                                    </div>
                                </div>

                                <!-- Table Info Tooltip (on hover) -->
                                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block z-10">
                                    <div class="bg-bark-900 text-cream-100 px-3 py-2 rounded-lg text-xs whitespace-nowrap shadow-xl">
                                        <div class="font-bold">{{ $table->name }}</div>
                                        @if($table->description)
                                        <div class="text-cream-200 text-xs mt-1">{{ $table->description }}</div>
                                        @endif
                                    </div>
                                    <div class="w-2 h-2 bg-bark-900 transform rotate-45 mx-auto -mt-1"></div>
                                </div>
                            </div>
                            @endforeach

                            @php
                                // Fill empty slots if less than 12 tables
                                $emptySlots = 12 - count($availableTables);
                            @endphp
                            @for($i = 0; $i < $emptySlots; $i++)
                            <div class="relative aspect-square rounded-xl bg-gray-200 border-2 border-dashed border-gray-300 flex items-center justify-center opacity-50">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            @endfor
                        </div>

                        <!-- Selected Table Info -->
                        @if($table_id)
                        @php
                            $selectedTable = $availableTables->firstWhere('id', $table_id);
                        @endphp
                        <div class="mt-6 bg-wood-500 text-white p-4 rounded-lg shadow-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-lg">✓ Meja Terpilih: {{ $selectedTable->name }}</h4>
                                    <p class="text-sm text-cream-200 mt-1">
                                        Kapasitas {{ $selectedTable->capacity }} orang
                                        @if($selectedTable->description)
                                        · {{ $selectedTable->description }}
                                        @endif
                                    </p>
                                </div>
                                <button wire:click="$set('table_id', null)" type="button" class="text-white hover:text-cream-300 transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endif

                    </div>
                    @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-lg font-bold text-gray-400 mb-2">Tidak Ada Meja Tersedia</h3>
                        <p class="text-gray-500">Silakan pilih tanggal, waktu, atau jumlah tamu yang berbeda</p>
                    </div>
                    @endif
                    @error('table_id') <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> @enderror
                </div>
                @endif

                <!-- Step 4: Confirmation & Special Requests -->
                @if($currentStep === 4)
                <div>
                    <h2 class="font-heading text-3xl font-bold text-bark-900 mb-6">Konfirmasi Reservasi</h2>
                    
                    <!-- Summary -->
                    <div class="bg-cream-50 rounded-lg p-6 mb-6">
                        <h3 class="font-bold text-lg text-bark-900 mb-4">Detail Reservasi</h3>
                        <div class="space-y-3 text-gray-700">
                            <div class="flex justify-between">
                                <span>Nama:</span>
                                <span class="font-semibold">{{ $customer_name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Email:</span>
                                <span class="font-semibold">{{ $customer_email }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Telepon:</span>
                                <span class="font-semibold">{{ $customer_phone }}</span>
                            </div>
                            <div class="border-t border-gray-300 my-3"></div>
                            <div class="flex justify-between">
                                <span>Tanggal:</span>
                                <span class="font-semibold">{{ \Carbon\Carbon::parse($reservation_date)->format('d F Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Waktu:</span>
                                <span class="font-semibold">{{ $reservation_time }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Jumlah Tamu:</span>
                                <span class="font-semibold">{{ $guest_count }} orang</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Meja:</span>
                                <span class="font-semibold">
                                    @if($table_id && $availableTables->firstWhere('id', $table_id))
                                        {{ $availableTables->firstWhere('id', $table_id)->name }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Permintaan Khusus (Opsional)
                        </label>
                        <textarea wire:model="special_requests" rows="4"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-wood-500 focus:border-transparent transition"
                                  placeholder="Contoh: Dekorasi ulang tahun, alergi makanan, posisi meja dekat jendela, dll."></textarea>
                        @error('special_requests') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        <p class="text-sm text-gray-500 mt-1">Maksimal 500 karakter</p>
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-gray-700">
                            <strong>Catatan:</strong> Reservasi Anda akan dikonfirmasi oleh tim kami. Anda akan menerima email konfirmasi setelah reservasi disetujui.
                        </p>
                    </div>
                </div>
                @endif

                <!-- Navigation Buttons -->
                <div class="mt-8 flex justify-between">
                    <button type="button" 
                            wire:click="previousStep"
                            @if($currentStep === 1) disabled @endif
                            class="px-6 py-3 rounded-lg font-semibold transition-all
                            {{ $currentStep === 1 ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-300 hover:bg-gray-400 text-gray-700' }}">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Kembali
                        </span>
                    </button>

                    @if($currentStep < $totalSteps)
                    <button type="button" 
                            wire:click="nextStep"
                            class="px-6 py-3 bg-wood-500 hover:bg-wood-600 text-cream-100 rounded-lg font-semibold transition-all">
                        <span class="flex items-center">
                            Lanjutkan
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </button>
                    @else
                    <button type="button" 
                            wire:click="submit"
                            class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-bold transition-all transform hover:scale-105 shadow-lg">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Konfirmasi Reservasi
                        </span>
                    </button>
                    @endif
                </div>

            </div>

        </div>
    </section>
</div>

