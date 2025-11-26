<x-admin-layout title="Detail Reservasi">
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('admin.reservasi.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mb-4 inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Daftar Reservasi
                </a>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">Detail Reservasi</h1>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Status Banner -->
                <div class="px-6 py-4 border-b border-gray-200 
                    @if($reservation->status === 'pending') bg-yellow-50
                    @elseif($reservation->status === 'confirmed') bg-green-50
                    @elseif($reservation->status === 'cancelled') bg-red-50
                    @else bg-blue-50 @endif">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold">{{ $reservation->booking_code }}</h2>
                            <p class="text-sm text-gray-600">Dibuat: {{ $reservation->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <div>
                            @if($reservation->status === 'pending')
                                <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu Konfirmasi
                                </span>
                            @elseif($reservation->status === 'confirmed')
                                <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    Dikonfirmasi
                                </span>
                            @elseif($reservation->status === 'cancelled')
                                <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                    Dibatalkan
                                </span>
                            @else
                                <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="px-6 py-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informasi Pelanggan -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Informasi Pelanggan</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-xs text-gray-500">Nama Lengkap</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $reservation->customer_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500">Email</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $reservation->customer_email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500">No. Telepon</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $reservation->customer_phone }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Informasi Reservasi -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Detail Reservasi</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-xs text-gray-500">Tanggal</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d F Y') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500">Waktu</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $reservation->reservation_time }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500">Jumlah Tamu</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $reservation->guest_count }} orang</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500">Meja</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $reservation->table->name ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Permintaan Khusus -->
                    @if($reservation->special_requests)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-3">Permintaan Khusus</h3>
                        <p class="text-sm text-gray-700 bg-gray-50 rounded-lg p-4">{{ $reservation->special_requests }}</p>
                    </div>
                    @endif

                    <!-- Informasi Pembayaran -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Informasi Pembayaran</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-xs text-gray-500">Jumlah DP</dt>
                                <dd class="text-lg font-bold text-gray-900">Rp {{ number_format($reservation->dp_amount ?? 0, 0, ',', '.') }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">Status Pembayaran</dt>
                                <dd class="text-sm font-medium">
                                    @if($reservation->payment_status === 'paid')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Sudah Dibayar
                                        </span>
                                    @elseif($reservation->payment_status === 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            Menunggu Verifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                            Belum Dibayar
                                        </span>
                                    @endif
                                </dd>
                            </div>
                        </dl>

                        @if($reservation->payment_confirmed_at)
                        <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                            <p class="text-sm text-green-800">
                                <strong>Pembayaran dikonfirmasi:</strong> {{ $reservation->payment_confirmed_at->format('d F Y, H:i') }}
                            </p>
                        </div>
                        @endif

                        @if($reservation->payment_proof)
                        <div class="mt-4">
                            <dt class="text-xs text-gray-500 mb-2">Bukti Transfer</dt>
                            <div class="border border-gray-300 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $reservation->payment_proof) }}" 
                                     alt="Bukti Transfer" 
                                     class="w-full max-w-md h-auto">
                            </div>
                            
                            @if($reservation->payment_status === 'pending')
                            <div class="mt-4 flex space-x-3">
                                <form action="{{ route('admin.reservasi.confirmPayment', $reservation) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('Konfirmasi pembayaran ini?')"
                                            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Konfirmasi Pembayaran
                                    </button>
                                </form>
                                <form action="{{ route('admin.reservasi.rejectPayment', $reservation) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('Tolak pembayaran ini? Pelanggan harus upload ulang bukti transfer.')"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Tolak Pembayaran
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                        @elseif($reservation->payment_status === 'unpaid')
                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm text-yellow-800">
                                <strong>Menunggu:</strong> Pelanggan belum upload bukti transfer
                            </p>
                        </div>
                        @endif
                    </div>

                    <!-- Konfirmasi Info -->
                    @if($reservation->confirmed_at)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-3">Informasi Konfirmasi</h3>
                        <p class="text-sm text-gray-700">
                            Dikonfirmasi pada {{ $reservation->confirmed_at->format('d F Y, H:i') }}
                            @if($reservation->confirmedBy)
                                oleh <span class="font-medium">{{ $reservation->confirmedBy->name }}</span>
                            @endif
                        </p>
                    </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                    @if($reservation->status === 'pending')
                        <form action="{{ route('admin.reservasi.confirm', $reservation) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Konfirmasi Reservasi
                            </button>
                        </form>
                        <form action="{{ route('admin.reservasi.cancel', $reservation) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Batalkan Reservasi
                            </button>
                        </form>
                    @endif
                    
                    <form action="{{ route('admin.reservasi.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
