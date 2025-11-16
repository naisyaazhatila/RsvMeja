<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f5f5f5; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #8B4513 0%, #6B3410 100%); color: #F5E6D3; padding: 40px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; }
        .content { padding: 30px; }
        .info-box { background: #FFF8DC; border-left: 4px solid #8B4513; padding: 20px; margin: 20px 0; border-radius: 4px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; }
        .info-row:last-child { border-bottom: none; }
        .label { font-weight: bold; color: #555; }
        .value { color: #333; }
        .booking-code { background: #8B4513; color: #F5E6D3; padding: 15px; text-align: center; font-size: 24px; font-weight: bold; letter-spacing: 2px; border-radius: 4px; margin: 20px 0; }
        .footer { background: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #777; }
        .button { display: inline-block; background: #8B4513; color: #F5E6D3; padding: 12px 30px; text-decoration: none; border-radius: 4px; margin: 20px 0; font-weight: bold; }
        .alert { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ setting('restaurant_name', 'Restaurant') }}</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Reservasi Berhasil Dibuat</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $reservation->customer_name }}</strong>,</p>
            
            <p>Terima kasih telah melakukan reservasi di {{ setting('restaurant_name') }}. Reservasi Anda telah kami terima dan sedang menunggu konfirmasi dari tim kami.</p>

            <div class="booking-code">
                {{ $reservation->booking_code }}
            </div>
            <p style="text-align: center; margin-top: -10px; color: #777; font-size: 14px;">Kode Booking Anda</p>

            <div class="info-box">
                <h3 style="margin-top: 0;">Detail Reservasi</h3>
                
                <div class="info-row">
                    <span class="label">Nama</span>
                    <span class="value">{{ $reservation->customer_name }}</span>
                </div>
                
                <div class="info-row">
                    <span class="label">Email</span>
                    <span class="value">{{ $reservation->customer_email }}</span>
                </div>
                
                <div class="info-row">
                    <span class="label">Telepon</span>
                    <span class="value">{{ $reservation->customer_phone }}</span>
                </div>
                
                <div class="info-row">
                    <span class="label">Tanggal</span>
                    <span class="value">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d F Y') }}</span>
                </div>
                
                <div class="info-row">
                    <span class="label">Waktu</span>
                    <span class="value">{{ $reservation->reservation_time }}</span>
                </div>
                
                <div class="info-row">
                    <span class="label">Jumlah Tamu</span>
                    <span class="value">{{ $reservation->guest_count }} orang</span>
                </div>
                
                <div class="info-row">
                    <span class="label">Meja</span>
                    <span class="value">{{ $reservation->table->name }}</span>
                </div>
                
                @if($reservation->special_requests)
                <div class="info-row">
                    <span class="label">Permintaan Khusus</span>
                    <span class="value">{{ $reservation->special_requests }}</span>
                </div>
                @endif
                
                <div class="info-row">
                    <span class="label">Status</span>
                    <span class="value" style="color: #ff9800; font-weight: bold;">MENUNGGU KONFIRMASI</span>
                </div>
            </div>

            <div class="alert">
                <strong>⏰ Menunggu Konfirmasi</strong><br>
                Tim kami akan meninjau reservasi Anda dan mengirimkan email konfirmasi dalam waktu 24 jam. Mohon simpan kode booking Anda untuk referensi.
            </div>

            <p>Jika Anda memiliki pertanyaan atau perlu melakukan perubahan, silakan hubungi kami:</p>
            <ul style="margin: 10px 0;">
                <li>Telepon: {{ setting('contact_phone', '021-12345678') }}</li>
                <li>Email: {{ setting('contact_email', 'info@restaurant.com') }}</li>
            </ul>

            <p>Kami menantikan kedatangan Anda!</p>
            
            <p style="margin-top: 30px;">
                Salam hangat,<br>
                <strong>Tim {{ setting('restaurant_name') }}</strong>
            </p>
        </div>

        <div class="footer">
            <p>Email ini dikirim otomatis. Mohon tidak membalas email ini.</p>
            <p>{{ setting('restaurant_address', 'Jakarta, Indonesia') }}</p>
            <p>&copy; {{ date('Y') }} {{ setting('restaurant_name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
