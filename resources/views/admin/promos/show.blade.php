<x-admin-layout title="Detail Promo">
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.promo.index') }}" class="text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Detail Promo</h1>
                            <p class="mt-1 text-sm text-gray-600">Informasi lengkap promo</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.promo.edit', $promo) }}" 
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
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- Image -->
                @if($promo->image)
                    <div class="w-full h-96">
                        <img src="{{ Storage::url($promo->image) }}" 
                             alt="{{ $promo->title }}" 
                             class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-6 space-y-6">
                    <!-- Title & Status -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $promo->title }}</h2>
                        <div class="flex items-center gap-2 mt-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $promo->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $promo->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-wood-100 text-wood-800">
                                @if($promo->discount_type == 'percentage')
                                    Diskon {{ $promo->discount_value }}%
                                @else
                                    Diskon Rp {{ number_format($promo->discount_value, 0, ',', '.') }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="border-t border-gray-200 pt-6">
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                                <dd class="mt-1 text-gray-900 leading-relaxed">{{ $promo->description }}</dd>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Berlaku Dari</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $promo->valid_from->format('d F Y') }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Berlaku Sampai</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $promo->valid_until->format('d F Y') }}</dd>
                                </div>
                            </div>

                            @if($promo->terms)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Syarat & Ketentuan</dt>
                                <dd class="mt-1 text-gray-700 leading-relaxed whitespace-pre-line">{{ $promo->terms }}</dd>
                            </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Dibuat pada</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $promo->created_at->format('d F Y H:i') }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Terakhir diupdate</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $promo->updated_at->format('d F Y H:i') }}</dd>
                                </div>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                    <form action="{{ route('admin.promo.destroy', $promo) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus promo ini?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Promo
                        </button>
                    </form>

                    <a href="{{ route('admin.promo.index') }}" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition duration-200">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
