<x-admin-layout title="Kelola Reservasi">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Kelola Reservasi</h1>
                    <p class="mt-1 text-sm text-gray-600">Kelola semua reservasi pelanggan</p>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <a href="{{ route('admin.reservasi.index') }}" 
                       class="border-b-2 {{ !request('status') ? 'border-wood-500 text-wood-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 font-medium text-sm">
                        Semua
                        <span class="ml-2 bg-gray-100 text-gray-900 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $reservations->total() }}</span>
                    </a>
                    <a href="{{ route('admin.reservasi.index', ['status' => 'pending']) }}" 
                       class="border-b-2 {{ request('status') === 'pending' ? 'border-wood-500 text-wood-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 font-medium text-sm">
                        Menunggu
                    </a>
                    <a href="{{ route('admin.reservasi.index', ['status' => 'confirmed']) }}" 
                       class="border-b-2 {{ request('status') === 'confirmed' ? 'border-wood-500 text-wood-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 font-medium text-sm">
                        Dikonfirmasi
                    </a>
                    <a href="{{ route('admin.reservasi.index', ['status' => 'cancelled']) }}" 
                       class="border-b-2 {{ request('status') === 'cancelled' ? 'border-wood-500 text-wood-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 font-medium text-sm">
                        Dibatalkan
                    </a>
                    <a href="{{ route('admin.reservasi.index', ['status' => 'completed']) }}" 
                       class="border-b-2 {{ request('status') === 'completed' ? 'border-wood-500 text-wood-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 font-medium text-sm">
                        Selesai
                    </a>
                </nav>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Booking</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meja</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tamu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembayaran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($reservations as $reservation)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $reservation->booking_code }}</div>
                                    <div class="text-xs text-gray-500">{{ $reservation->created_at->format('d M Y H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $reservation->customer_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $reservation->customer_email }}</div>
                                    <div class="text-xs text-gray-500">{{ $reservation->customer_phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $reservation->reservation_time }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $reservation->table->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $reservation->guest_count }} orang
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($reservation->status === 'pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                    @elseif($reservation->status === 'confirmed')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Dikonfirmasi
                                        </span>
                                    @elseif($reservation->status === 'cancelled')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Dibatalkan
                                        </span>
                                    @elseif($reservation->status === 'completed')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            ✓ Selesai
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($reservation->payment_status === 'paid')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            ✓ Lunas
                                        </span>
                                    @elseif($reservation->payment_status === 'pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            ⏳ Verifikasi
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600">
                                            Belum Bayar
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.reservasi.show', $reservation) }}" class="text-blue-600 hover:text-blue-900 mr-3">Detail</a>
                                    @if($reservation->status === 'pending')
                                        <form action="{{ route('admin.reservasi.confirm', $reservation) }}" method="POST" class="inline" onsubmit="return confirm('Konfirmasi reservasi ini? Email akan dikirim ke pelanggan.')">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-3 font-semibold">Konfirmasi</button>
                                        </form>
                                        <form action="{{ route('admin.reservasi.cancel', $reservation) }}" method="POST" class="inline" onsubmit="return confirm('Batalkan reservasi ini? Email akan dikirim ke pelanggan.')">
                                            @csrf
                                            <button type="submit" class="text-orange-600 hover:text-orange-900 mr-3">Batalkan</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.reservasi.destroy', $reservation) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus reservasi ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="mt-4">Belum ada reservasi</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($reservations->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $reservations->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
