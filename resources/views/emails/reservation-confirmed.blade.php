<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f5f5f5; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #059669 0%, #047857 100%); color: #ffffff; padding: 40px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; }
        .content { padding: 30px; }
        .info-box { background: #f0fdf4; border-left: 4px solid #059669; padding: 20px; margin: 20px 0; border-radius: 4px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #dcfce7; }
        .info-row:last-child { border-bottom: none; }
        .label { font-weight: bold; color: #555; }
        .value { color: #333; }
        .booking-code { background: #059669; color: #ffffff; padding: 15px; text-align: center; font-size: 24px; font-weight: bold; letter-spacing: 2px; border-radius: 4px; margin: 20px 0; }
        .footer { background: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #777; }
        .success-badge { background: #059669; color: white; padding: 10px 20px; border-radius: 20px; display: inline-block; margin: 20px 0; font-weight: bold; }
        .reminder-box { background: #dbeafe; border-left: 4px solid #3b82f6; padding: 15px; margin: 20px 0; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ setting('restaurant_name', 'Restaurant') }}</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Reservasi Dikonfirmasi ✓</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $reservation->customer_name }}</strong>,</p>
            
            <div style="text-align: center;">
                <div class="success-badge">
                    ✓ RESERVASI DIKONFIRMASI
                </div>
            </div>

            <p>Kabar baik! Reservasi Anda di {{ setting('restaurant_name') }} telah <strong>dikonfirmasi</strong> oleh tim kami. Kami sangat menantikan kedatangan Anda!</p>

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
                    <span class="label">Dikonfirmasi Pada</span>
                    <span class="value">{{ $reservation->confirmed_at->format('d F Y, H:i') }}</span>
                </div>
            </div>

            <div class="reminder-box">
                <strong>📝 Catatan Penting:</strong><br>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Harap datang <strong>15 menit</strong> sebelum waktu reservasi</li>
                    <li>Tunjukkan kode booking ini saat tiba di restaurant</li>
                    <li>Meja akan ditahan selama <strong>15 menit</strong> setelah waktu reservasi</li>
                    <li>Jika terlambat atau berhalangan, mohon hubungi kami</li>
                </ul>
            </div>

            <h3 style="margin-top: 30px;">Lokasi Kami</h3>
            <p>{{ setting('restaurant_address', 'Jakarta, Indonesia') }}</p>
            
            <h3>Kontak</h3>
            <ul style="margin: 10px 0;">
                <li>Telepon: {{ setting('contact_phone', '021-12345678') }}</li>
                <li>Email: {{ setting('contact_email', 'info@restaurant.com') }}</li>
            </ul>

            <p style="margin-top: 30px;">Terima kasih telah memilih {{ setting('restaurant_name') }}. Kami berkomitmen memberikan pengalaman kuliner terbaik untuk Anda!</p>
            
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
