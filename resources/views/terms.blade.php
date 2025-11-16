<x-app-layout>
    <div class="min-h-screen bg-ivory py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-bark-900 mb-4">
                    Syarat dan Ketentuan
                </h1>
                <p class="text-lg text-gray-600">
                    Terakhir diperbarui: {{ now()->format('d F Y') }}
                </p>
            </div>

            <div class="card p-8 md:p-12 space-y-8">
                
                <!-- Introduction -->
                <section>
                    <p class="text-gray-700 leading-relaxed">
                        Selamat datang di {{ setting('restaurant_name', 'Restaurant Nusantara') }}. Dengan mengakses dan menggunakan situs web ini serta layanan reservasi kami, Anda setuju untuk terikat dengan syarat dan ketentuan berikut. Harap baca dengan seksama sebelum melanjutkan.
                    </p>
                </section>

                <!-- Section 1 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        1. Reservasi
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <h3 class="font-semibold text-bark-900">1.1 Proses Reservasi</h3>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Reservasi dapat dilakukan melalui website dengan mengisi formulir yang tersedia</li>
                            <li>Konfirmasi reservasi akan dikirimkan melalui email setelah pembayaran deposit dikonfirmasi</li>
                            <li>Reservasi dianggap sah setelah mendapat konfirmasi dari pihak restoran</li>
                        </ul>

                        <h3 class="font-semibold text-bark-900 mt-4">1.2 Deposit Pembayaran</h3>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Deposit sebesar {{ format_rupiah(setting('dp_amount', 100000)) }} diperlukan untuk mengamankan reservasi Anda</li>
                            <li>Deposit harus dibayarkan dalam waktu 24 jam setelah reservasi dibuat</li>
                            <li>Bukti pembayaran harus dikirimkan melalui WhatsApp atau email</li>
                            <li>Deposit akan dikurangkan dari total tagihan saat Anda makan di restoran</li>
                        </ul>

                        <h3 class="font-semibold text-bark-900 mt-4">1.3 Keterlambatan</h3>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Meja akan ditahan hingga 15 menit setelah waktu reservasi</li>
                            <li>Jika Anda terlambat lebih dari 15 menit tanpa pemberitahuan, reservasi dapat dibatalkan</li>
                            <li>Harap hubungi kami jika Anda akan terlambat</li>
                        </ul>
                    </div>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        2. Pembatalan dan Perubahan
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <h3 class="font-semibold text-bark-900">2.1 Pembatalan oleh Pelanggan</h3>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Pembatalan minimal 24 jam sebelum waktu reservasi: deposit dapat dikembalikan 100%</li>
                            <li>Pembatalan 12-24 jam sebelum waktu reservasi: deposit dikembalikan 50%</li>
                            <li>Pembatalan kurang dari 12 jam: deposit tidak dapat dikembalikan</li>
                            <li>No-show tanpa pemberitahuan: deposit hangus</li>
                        </ul>

                        <h3 class="font-semibold text-bark-900 mt-4">2.2 Perubahan Reservasi</h3>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Perubahan tanggal, waktu, atau jumlah tamu dapat dilakukan minimal 24 jam sebelumnya</li>
                            <li>Perubahan tergantung ketersediaan meja</li>
                            <li>Hubungi kami melalui telepon atau WhatsApp untuk perubahan reservasi</li>
                        </ul>

                        <h3 class="font-semibold text-bark-900 mt-4">2.3 Pembatalan oleh Restoran</h3>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Kami berhak membatalkan reservasi karena force majeure atau kondisi darurat</li>
                            <li>Deposit akan dikembalikan 100% jika pembatalan dari pihak restoran</li>
                            <li>Pemberitahuan akan diberikan sesegera mungkin</li>
                        </ul>
                    </div>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        3. Peraturan Restoran
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Berpakaian sopan dan rapi</li>
                            <li>Dilarang membawa makanan dan minuman dari luar</li>
                            <li>Merokok hanya diperbolehkan di area yang ditentukan</li>
                            <li>Menjaga ketenangan dan kenyamanan tamu lain</li>
                            <li>Kami berhak menolak melayani tamu yang melanggar peraturan</li>
                        </ul>
                    </div>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        4. Acara Khusus dan Group Booking
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Reservasi untuk 10 orang atau lebih dianggap group booking</li>
                            <li>Group booking memerlukan deposit yang lebih besar dan konfirmasi khusus</li>
                            <li>Menu set mungkin diperlukan untuk group booking besar</li>
                            <li>Hubungi kami langsung untuk acara khusus atau private dining</li>
                        </ul>
                    </div>
                </section>

                <!-- Section 5 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        5. Tanggung Jawab
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Kami tidak bertanggung jawab atas barang pribadi yang hilang atau rusak</li>
                            <li>Tamu bertanggung jawab atas kerusakan yang disengaja pada properti restoran</li>
                            <li>Kami tidak bertanggung jawab atas reaksi alergi terhadap makanan - harap informasikan alergi Anda</li>
                        </ul>
                    </div>
                </section>

                <!-- Section 6 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        6. Harga dan Pembayaran
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Semua harga dalam Rupiah dan sudah termasuk pajak</li>
                            <li>Kami menerima pembayaran tunai dan transfer bank</li>
                            <li>Harga dapat berubah sewaktu-waktu tanpa pemberitahuan</li>
                            <li>Promo dan diskon tidak dapat digabungkan kecuali dinyatakan lain</li>
                        </ul>
                    </div>
                </section>

                <!-- Section 7 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        7. Informasi Pribadi
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        Penggunaan informasi pribadi Anda diatur oleh <a href="{{ route('privacy') }}" class="text-wood-500 hover:text-wood-600 underline">Kebijakan Privasi</a> kami. Dengan melakukan reservasi, Anda menyetujui pengumpulan dan penggunaan informasi sesuai kebijakan tersebut.
                    </p>
                </section>

                <!-- Section 8 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        8. Perubahan Syarat dan Ketentuan
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        Kami berhak mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan berlaku segera setelah dipublikasikan di website. Penggunaan layanan kami setelah perubahan berarti Anda menyetujui syarat dan ketentuan yang baru.
                    </p>
                </section>

                <!-- Section 9 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        9. Hukum yang Berlaku
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        Syarat dan ketentuan ini diatur oleh dan ditafsirkan sesuai dengan hukum Republik Indonesia. Setiap perselisihan akan diselesaikan di pengadilan yang berwenang di Jakarta.
                    </p>
                </section>

                <!-- Section 10 -->
                <section>
                    <h2 class="text-2xl font-heading font-bold text-bark-900 mb-4">
                        10. Kontak
                    </h2>
                    <div class="space-y-4 text-gray-700">
                        <p>Jika Anda memiliki pertanyaan tentang Syarat dan Ketentuan ini, silakan hubungi kami:</p>
                        <ul class="space-y-2">
                            <li><strong>Email:</strong> <a href="mailto:{{ setting('restaurant_email', 'info@restaurant.com') }}" class="text-wood-500 hover:text-wood-600">{{ setting('restaurant_email', 'info@restaurant.com') }}</a></li>
                            <li><strong>Telepon:</strong> <a href="tel:{{ setting('restaurant_phone', '021-12345678') }}" class="text-wood-500 hover:text-wood-600">{{ setting('restaurant_phone', '021-12345678') }}</a></li>
                            <li><strong>WhatsApp:</strong> <a href="{{ whatsapp_link(setting('whatsapp', '6281234567890'), 'Halo, saya ingin bertanya tentang syarat dan ketentuan') }}" class="text-wood-500 hover:text-wood-600" target="_blank">{{ setting('whatsapp', '081234567890') }}</a></li>
                        </ul>
                    </div>
                </section>

                <!-- Acceptance -->
                <section class="bg-cream-100 -mx-8 md:-mx-12 px-8 md:px-12 py-6 rounded-lg">
                    <p class="text-sm text-gray-600 italic">
                        Dengan melakukan reservasi melalui website kami, Anda mengakui bahwa Anda telah membaca, memahami, dan setuju untuk terikat dengan Syarat dan Ketentuan ini.
                    </p>
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
