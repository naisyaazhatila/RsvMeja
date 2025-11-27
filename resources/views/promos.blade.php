<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-bark-900 to-wood-800 text-cream-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading text-5xl md:text-6xl font-bold mb-4">Promo Spesial</h1>
            <p class="text-xl text-cream-200">Dapatkan penawaran terbaik dari kami</p>
        </div>
    </section>

    <!-- Promo Section -->
    <section class="py-16 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @livewire('promo-list')

        </div>
    </section>

    <!-- Info Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="font-heading text-3xl font-bold text-bark-900 mb-4">Syarat & Ketentuan Promo</h2>
            <div class="text-left bg-cream-50 rounded-lg p-8 space-y-3 text-gray-700">
                <div class="flex items-start">
                    <span class="text-wood-500 font-bold mr-3">•</span>
                    <p>Promo berlaku sesuai periode yang tertera</p>
                </div>
                <div class="flex items-start">
                    <span class="text-wood-500 font-bold mr-3">•</span>
                    <p>Minimal pembelian berlaku jika tertera pada detail promo</p>
                </div>
                <div class="flex items-start">
                    <span class="text-wood-500 font-bold mr-3">•</span>
                    <p>Promo tidak dapat digabungkan dengan promo lainnya kecuali disebutkan</p>
                </div>
                <div class="flex items-start">
                    <span class="text-wood-500 font-bold mr-3">•</span>
                    <p>Reservasi wajib menyebutkan kode promo saat booking</p>
                </div>
                <div class="flex items-start">
                    <span class="text-wood-500 font-bold mr-3">•</span>
                    <p>Manajemen berhak mengubah atau membatalkan promo tanpa pemberitahuan sebelumnya</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
