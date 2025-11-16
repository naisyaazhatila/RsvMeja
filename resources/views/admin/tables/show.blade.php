<x-admin-layout title="Detail Meja">
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.meja.index') }}" class="text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Detail Meja</h1>
                            <p class="mt-1 text-sm text-gray-600">Informasi lengkap meja</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.meja.edit', $table) }}" 
                           class="inline-flex items-center px-4 py-2 bg-wood-600 hover:bg-wood-700 text-white font-semibold rounded-lg transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="space-y-6">
                    <!-- Table Name & Status -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $table->name }}</h2>
                            <div class="flex items-center gap-2 mt-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $table->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $table->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="border-t border-gray-200 pt-6">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Kapasitas
                                </dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $table->capacity }} Orang</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    Posisi
                                </dt>
                                <dd class="mt-1 text-lg text-gray-900">X: {{ $table->position_x }}, Y: {{ $table->position_y }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Dibuat pada</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $table->created_at->format('d F Y H:i') }}</dd>
                            </div>                    <!-- Details -->
                    <div class="border-t border-gray-200 pt-6">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Kapasitas
                                </dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $table->capacity }} Orang</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Lokasi
                                </dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ ucfirst($table->location ?? 'Indoor') }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Dibuat pada</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $table->created_at->format('d F Y H:i') }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Terakhir diupdate</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $table->updated_at->format('d F Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Recent Reservations -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Reservasi Terbaru</h3>
                        @if($table->reservations->count() > 0)
                            <div class="space-y-3">
                                @foreach($table->reservations->take(5) as $reservation)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $reservation->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $reservation->reservation_date->format('d M Y') }} - {{ $reservation->reservation_time }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            {{ $reservation->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $reservation->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $reservation->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">Belum ada reservasi</p>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-6 border-t border-gray-200 flex items-center justify-between">
                    <form action="{{ route('admin.meja.destroy', $table) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus meja ini?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Meja
                        </button>
                    </form>

                    <a href="{{ route('admin.meja.index') }}" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition duration-200">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
