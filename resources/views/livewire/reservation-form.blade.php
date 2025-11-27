<div wire:poll.3s="refreshTables">
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
                                   x-data
                                   x-init="$el.min = new Date().toISOString().split('T')[0]"
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
                                    @php
                                        $time24 = sprintf('%02d:%s', $hour, $minute);
                                        $time12 = date('g:i A', strtotime($time24));
                                    @endphp
                                    <option value="{{ $time24 }}">
                                        {{ $time12 }}
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

                    <!-- Timezone Info -->
                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg" x-data="{
                        timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
                        offset: new Date().getTimezoneOffset() / -60
                    }">
                        <div class="flex items-center text-sm text-blue-800">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Waktu disesuaikan dengan timezone Anda: <strong x-text="timezone"></strong> (GMT<span x-text="offset >= 0 ? '+' + offset : offset"></span>)</span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Step 3: Table Selection -->
                @if($currentStep === 3)
                <div>
                    <h2 class="font-heading text-3xl font-bold text-bark-900 mb-6">Pilih Meja - Denah Restaurant</h2>
                    
                    @if(count($availableTables) > 0)
                    
                    <!-- Real-time Update Notice -->
                    <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm text-blue-800 font-medium">Status meja diperbarui otomatis setiap 5 detik</span>
                    </div>
                    
                    <!-- Legend -->
                    <div class="flex flex-wrap gap-4 mb-6 p-4 bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-green-500 rounded mr-2"></div>
                            <span class="text-sm font-medium text-gray-700">Tersedia untuk Anda</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-wood-500 rounded mr-2 ring-4 ring-wood-200"></div>
                            <span class="text-sm font-medium text-gray-700">Dipilih</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-gray-400 rounded mr-2"></div>
                            <span class="text-sm font-medium text-gray-700">Sudah Dibooking</span>
                        </div>
                    </div>

                    <!-- Visual Table Map -->
                    <div class="relative bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 md:p-12 border-2 border-amber-200 overflow-hidden">
                        
                        <!-- Restaurant Name Badge -->
                        <div class="flex justify-center mb-6">
                            <div class="bg-bark-900 text-cream-100 px-6 py-2 rounded-lg text-sm font-bold shadow-lg">
                                ASYA'S KITCHEN
                            </div>
                        </div>

                        <!-- Kitchen and Cashier Row -->
                        <div class="flex justify-between mb-8 px-2">
                            <div class="bg-gray-300 px-4 py-2 rounded-lg border-2 border-gray-400 shadow-md">
                                <span class="text-xs font-bold text-gray-700">DAPUR</span>
                            </div>
                            <div class="bg-gray-300 px-4 py-2 rounded-lg border-2 border-gray-400 shadow-md">
                                <span class="text-xs font-bold text-gray-700">KASIR</span>
                            </div>
                        </div>

                        <!-- Tables Layout -->
                        <div class="mb-8">
                            <!-- Tables Grid - 3 columns layout -->
                            <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 relative">
                                @foreach($availableTables as $index => $table)
                                @php
                                    $isBooked = $table->is_reserved ?? false;
                                    $isSelected = $table_id == $table->id;
                                    $canSelect = !$isBooked;
                                @endphp
                                
                                <div class="group {{ $canSelect ? 'cursor-pointer' : 'cursor-not-allowed' }}"
                                     @if($canSelect) wire:click="selectTable({{ $table->id }})" @endif>
                                    
                                    <!-- Table Card -->
                                    <div class="bg-white rounded-2xl shadow-md transition-all duration-300 overflow-hidden border-2
                                        {{ $isSelected ? 'border-wood-500 shadow-2xl scale-105 ring-4 ring-wood-200' : 
                                           ($canSelect ? 'border-green-500 hover:scale-102 hover:shadow-xl' : 'border-gray-300 opacity-60 bg-gray-50') }}">
                                        
                                        <!-- Header Section -->
                                        <div class="relative h-32 flex items-center justify-center
                                            {{ $isSelected ? 'bg-gradient-to-br from-wood-500 to-wood-600' : 
                                               ($canSelect ? 'bg-gradient-to-br from-green-500 to-green-600' : 'bg-gradient-to-br from-gray-400 to-gray-500') }}">
                                            
                                            <!-- Table Number Badge -->
                                            <div class="absolute top-4 left-4 z-20">
                                                <div class="bg-white rounded-lg px-3 py-1.5 shadow-md">
                                                    <span class="text-bark-900 font-bold text-sm">No. {{ $table->table_number ?? ($index + 1) }}</span>
                                                </div>
                                            </div>

                                            <!-- Status Badge -->
                                            <div class="absolute top-4 right-4 z-20">
                                                @if($isSelected)
                                                <div class="bg-white rounded-full p-2 shadow-lg">
                                                    <svg class="w-5 h-5 text-wood-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                @elseif($isBooked)
                                                <div class="bg-red-500 rounded-lg px-2 py-1 shadow-md">
                                                    <span class="text-white text-xs font-bold">Terisi</span>
                                                </div>
                                                @elseif($canSelect)
                                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg px-2 py-1">
                                                    <span class="text-white text-xs font-medium">Tersedia</span>
                                                </div>
                                                @else
                                                <div class="bg-gray-700 rounded-lg px-2 py-1 shadow-md">
                                                    <span class="text-white text-xs font-bold">N/A</span>
                                                </div>
                                                @endif
                                            </div>

                                            <!-- Table Icon -->
                                            <div class="relative z-10">
                                                <svg class="w-16 h-16 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M5 21V7l8-4v18M21 21V10l-8-3"/>
                                                    <circle cx="12" cy="14" r="6" stroke-width="1.5"/>
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Body Section -->
                                        <div class="p-5">
                                            <!-- Table Name -->
                                            <h3 class="text-bark-900 font-bold text-lg mb-3 text-center">{{ $table->name }}</h3>
                                            
                                            <!-- Details Grid -->
                                            <div class="space-y-2.5">
                                                <!-- Capacity -->
                                                <div class="flex items-center justify-center gap-2 p-3 bg-gray-50 rounded-lg">
                                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                                    </svg>
                                                    <span class="text-base font-bold text-bark-900">{{ $table->capacity }} Orang</span>
                                                </div>

                                                <!-- Visual Seats -->
                                                <div class="flex items-center justify-center gap-1.5 p-2.5 bg-gray-50 rounded-lg">
                                                    @for($i = 0; $i < min($table->capacity, 6); $i++)
                                                    <div class="w-2.5 h-2.5 bg-bark-900 rounded-full"></div>
                                                    @endfor
                                                    @if($table->capacity > 6)
                                                    <span class="text-xs text-gray-600 ml-1">+{{ $table->capacity - 6 }}</span>
                                                    @endif
                                                </div>

                                                @if($table->description)
                                                <!-- Location/Description -->
                                                <div class="flex items-start gap-2 p-2.5 bg-gray-50 rounded-lg">
                                                    <svg class="w-5 h-5 text-gray-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <span class="text-xs text-gray-600 leading-relaxed">{{ $table->description }}</span>
                                                </div>
                                                @endif
                                            </div>

                                            <!-- Status Message -->
                                            @if(!$canSelect)
                                            <div class="mt-4 p-3 rounded-lg text-center
                                                {{ $isBooked ? 'bg-red-50 border border-red-200' : 'bg-gray-50 border border-gray-200' }}">
                                                @if($isBooked)
                                                <p class="text-xs font-semibold text-red-700">Meja sudah dipesan untuk waktu ini</p>
                                                @else
                                                <p class="text-xs font-semibold text-gray-600">
                                                    @if($table->capacity < $guest_count)
                                                    Kapasitas terlalu kecil ({{ $guest_count }} tamu)
                                                    @else
                                                    Kapasitas terlalu besar ({{ $guest_count }} tamu)
                                                    @endif
                                                </p>
                                                @endif
                                            </div>
                                            @else
                                            <!-- Action Hint -->
                                            <div class="mt-4 text-center">
                                                @if($isSelected)
                                                <div class="bg-wood-50 border border-wood-200 rounded-lg p-3">
                                                    <p class="text-xs font-bold text-wood-700">Meja Terpilih</p>
                                                </div>
                                                @else
                                                <div class="bg-green-50 border border-green-200 rounded-lg p-3 group-hover:bg-green-100 transition-colors">
                                                    <p class="text-xs font-semibold text-green-700">Klik untuk pilih meja ini</p>
                                                </div>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Entrance -->
                        <div class="flex justify-center mt-8">
                            <div class="bg-gray-300 px-6 py-2 rounded-lg font-bold text-gray-700 text-sm border-2 border-gray-400 shadow-md">
                                PINTU MASUK
                            </div>
                        </div>

                        <!-- Selected Table Info -->
                        @if($table_id)
                        @php
                            $selectedTable = $availableTables->firstWhere('id', $table_id);
                        @endphp
                        @if($selectedTable)
                        <div class="mt-8 bg-wood-500 text-white p-6 rounded-xl shadow-lg">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start gap-4">
                                    <div class="bg-white bg-opacity-20 p-3 rounded-lg">
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-xl">Meja Terpilih: {{ $selectedTable->name }}</h4>
                                        <p class="text-cream-100 mt-2">
                                            Kapasitas maksimal {{ $selectedTable->capacity }} orang
                                        </p>
                                        @if($selectedTable->description)
                                        <p class="text-cream-200 text-sm mt-1">{{ $selectedTable->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                <button wire:click="$set('table_id', null)" type="button" 
                                    class="text-white hover:text-cream-300 transition p-2 hover:bg-white hover:bg-opacity-10 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endif
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
                                <span class="font-semibold">{{ date('g:i A', strtotime($reservation_time)) }}</span>
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


