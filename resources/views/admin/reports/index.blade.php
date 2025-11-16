<x-admin-layout title="Laporan Reservasi">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Laporan Reservasi</h1>
                <p class="mt-2 text-sm text-gray-600">Statistik dan laporan reservasi restoran</p>
            </div>

            <!-- Filter Form -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <form method="GET" action="{{ route('admin.report.index') }}" class="space-y-4">
                    <div class="flex flex-wrap gap-4">
                        <div class="flex-1 min-w-[180px]">
                            <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from', now()->startOfMonth()->format('Y-m-d')) }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>
                        <div class="flex-1 min-w-[180px]">
                            <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to', now()->format('Y-m-d')) }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                        </div>
                        <div class="flex-1 min-w-[180px]">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Reservasi</label>
                            <select name="status" id="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="flex-1 min-w-[180px]">
                            <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                            <select name="payment_status" id="payment_status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                                <option value="">Semua</option>
                                <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending Verifikasi</option>
                                <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1 min-w-[180px]">
                            <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">Urutkan Berdasarkan</label>
                            <select name="sort_by" id="sort_by" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Tanggal Dibuat</option>
                                <option value="reservation_date" {{ request('sort_by') == 'reservation_date' ? 'selected' : '' }}>Tanggal Reservasi</option>
                                <option value="customer_name" {{ request('sort_by') == 'customer_name' ? 'selected' : '' }}>Nama Customer</option>
                                <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
                                <option value="payment_status" {{ request('sort_by') == 'payment_status' ? 'selected' : '' }}>Status Pembayaran</option>
                            </select>
                        </div>
                        <div class="flex-1 min-w-[180px]">
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                            <select name="sort_order" id="sort_order" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-wood-500 focus:ring-wood-500">
                                <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                                <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Terlama</option>
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="px-6 py-2 bg-wood-600 hover:bg-wood-700 text-white font-semibold rounded-lg transition duration-200">
                                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('admin.report.index') }}" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition duration-200">
                                Reset
                            </a>
                            @if($reservations->total() > 0)
                            <button type="button" onclick="exportData()" class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Export Excel
                            </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <script>
            function exportData() {
                const params = new URLSearchParams(window.location.search);
                params.set('format', 'xlsx');
                window.location.href = '{{ route("admin.report.export") }}?' + params.toString();
            }
            </script>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Reservations -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Reservasi</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_reservations'] ?? 0 }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Confirmed -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Terkonfirmasi</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['confirmed'] ?? 0 }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Menunggu</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['pending'] ?? 0 }}</p>
                        </div>
                        <div class="bg-yellow-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Revenue -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-wood-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Pendapatan DP</p>
                            <p class="text-2xl font-bold text-gray-900 mt-2">Rp {{ number_format($stats['revenue'] ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-wood-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-wood-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reservations Summary Table -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Detail Reservasi</h2>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Tamu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meja</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DP</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reservations as $reservation)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $reservation->reservation_date->format('d M Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $reservation->reservation_time }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $reservation->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $reservation->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $reservation->guest_count }} orang
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $reservation->table->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        {{ $reservation->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $reservation->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $reservation->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $reservation->status == 'completed' ? 'bg-blue-100 text-blue-800' : '' }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Rp {{ number_format($reservation->dp_amount ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Tidak ada data reservasi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

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
