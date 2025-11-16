<x-app-layout>
    <div class="min-h-screen bg-ivory py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-bark-900 mb-4">
                    Kebijakan Privasi
                </h1>
                <p class="text-lg text-gray-600">
                    Terakhir diperbarui: {{ now()->format('d F Y') }}
                </p>
            </div>

            <div class="card p-8 md:p-12 space-y-8">
                
                <!-- Introduction -->
                <section>
                    <p class="text-gray-700 leading-relaxed">
                        {{ setting('restaurant_name', 'Restaurant Nusantara') }} ("kami", "kita", atau "milik kami") berkomitmen untuk melindungi privasi Anda. Kebijakan Privasi ini menjelaskan bagaimana informasi pribadi Anda dikumpulkan, digunakan, dan dibagikan ketika Anda mengunjungi atau melakukan reservasi melalui situs web kami.
                    </p>
                </section>

                <!-- Section 1 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        1. Informasi yang Kami Kumpulkan
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>Kami mengumpulkan informasi berikut ketika Anda menggunakan layanan kami:</p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li><strong>Informasi Pribadi:</strong> Nama lengkap, alamat email, nomor telepon</li>
                            <li><strong>Informasi Reservasi:</strong> Tanggal, waktu, jumlah tamu, permintaan khusus</li>
                            <li><strong>Informasi Pembayaran:</strong> Detail bukti transfer untuk deposit pembayaran</li>
                            <li><strong>Informasi Teknis:</strong> Alamat IP, jenis browser, waktu akses</li>
                        </ul>
                    </div>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        2. Bagaimana Kami Menggunakan Informasi Anda
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>Informasi yang kami kumpulkan digunakan untuk:</p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Memproses dan mengkonfirmasi reservasi Anda</li>
                            <li>Menghubungi Anda terkait reservasi atau pertanyaan</li>
                            <li>Mengirimkan konfirmasi dan pengingat reservasi via email</li>
                            <li>Meningkatkan layanan dan pengalaman pengguna kami</li>
                            <li>Memenuhi kewajiban hukum</li>
                        </ul>
                    </div>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        3. Keamanan Data
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        Kami mengambil langkah-langkah keamanan yang wajar untuk melindungi informasi pribadi Anda dari akses yang tidak sah, pengungkapan, perubahan, atau penghancuran. Namun, tidak ada metode transmisi melalui internet atau penyimpanan elektronik yang 100% aman.
                    </p>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        4. Berbagi Informasi
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        Kami tidak menjual, memperdagangkan, atau mentransfer informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali untuk penyedia layanan yang membantu kami mengoperasikan situs web atau melayani Anda, sepanjang pihak tersebut setuju untuk menjaga kerahasiaan informasi ini.
                    </p>
                </section>

                <!-- Section 5 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        5. Cookies
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        Situs web kami menggunakan cookies untuk meningkatkan pengalaman Anda. Cookies adalah file kecil yang ditempatkan di komputer Anda oleh situs web yang Anda kunjungi. Anda dapat mengatur browser Anda untuk menolak cookies, tetapi ini mungkin membatasi fungsionalitas situs web.
                    </p>
                </section>

                <!-- Section 6 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        6. Hak Anda
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>Anda memiliki hak untuk:</p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Mengakses informasi pribadi yang kami simpan tentang Anda</li>
                            <li>Meminta koreksi data yang tidak akurat</li>
                            <li>Meminta penghapusan informasi pribadi Anda</li>
                            <li>Menolak pemrosesan informasi pribadi Anda</li>
                            <li>Meminta pembatasan pemrosesan data Anda</li>
                        </ul>
                    </div>
                </section>

                <!-- Section 7 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        7. Penyimpanan Data
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        Kami akan menyimpan informasi pribadi Anda selama diperlukan untuk tujuan yang dijelaskan dalam kebijakan privasi ini, kecuali periode penyimpanan yang lebih lama diperlukan atau diizinkan oleh hukum.
                    </p>
                </section>

                <!-- Section 8 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        8. Perubahan Kebijakan Privasi
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Kami akan memberi tahu Anda tentang perubahan dengan memposting kebijakan privasi baru di halaman ini dan memperbarui tanggal "Terakhir diperbarui" di bagian atas kebijakan ini.
                    </p>
                </section>

                <!-- Section 9 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        9. Hubungi Kami
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini, silakan hubungi kami:</p>
                        <ul class="space-y-2">
                            <li><strong>Email:</strong> <a href="mailto:{{ setting('restaurant_email', 'info@restaurant.com') }}" class="text-wood-500 hover:text-wood-600">{{ setting('restaurant_email', 'info@restaurant.com') }}</a></li>
                            <li><strong>Telepon:</strong> <a href="tel:{{ setting('restaurant_phone', '021-12345678') }}" class="text-wood-500 hover:text-wood-600">{{ setting('restaurant_phone', '021-12345678') }}</a></li>
                            <li><strong>Alamat:</strong> {{ setting('restaurant_address', 'Jl. Contoh No. 123, Jakarta') }}</li>
                        </ul>
                    </div>
                </section>

                <!-- Back Button -->
                <div class="pt-8 border-t border-gray-200">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-wood-500 hover:text-wood-600 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
