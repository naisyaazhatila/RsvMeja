<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f5f5f5; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); color: #ffffff; padding: 40px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; }
        .content { padding: 30px; }
        .info-box { background: #fef2f2; border-left: 4px solid #dc2626; padding: 20px; margin: 20px 0; border-radius: 4px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #fee2e2; }
        .info-row:last-child { border-bottom: none; }
        .label { font-weight: bold; color: #555; }
        .value { color: #333; }
        .booking-code { background: #dc2626; color: #ffffff; padding: 15px; text-align: center; font-size: 24px; font-weight: bold; letter-spacing: 2px; border-radius: 4px; margin: 20px 0; }
        .footer { background: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #777; }
        .cancelled-badge { background: #dc2626; color: white; padding: 10px 20px; border-radius: 20px; display: inline-block; margin: 20px 0; font-weight: bold; }
        .notice-box { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 20px 0; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ setting('restaurant_name', 'Restaurant') }}</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Reservasi Dibatalkan</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $reservation->customer_name }}</strong>,</p>
            
            <div style="text-align: center;">
                <div class="cancelled-badge">
                    ✗ RESERVASI DIBATALKAN
                </div>
            </div>

            <p>Kami informasikan bahwa reservasi Anda di {{ setting('restaurant_name') }} dengan kode booking <strong>{{ $reservation->booking_code }}</strong> telah dibatalkan.</p>

            <div class="booking-code">
                {{ $reservation->booking_code }}
            </div>
            <p style="text-align: center; margin-top: -10px; color: #777; font-size: 14px;">Kode Booking yang Dibatalkan</p>

            <div class="info-box">
                <h3 style="margin-top: 0;">Detail Reservasi yang Dibatalkan</h3>
                
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
                    <span class="value">{{ $reservation->table ? $reservation->table->name : '-' }}</span>
                </div>
            </div>

            <div class="notice-box">
                <h4 style="margin-top: 0;">📌 Informasi Penting</h4>
                <p style="margin: 5px 0;">Jika Anda masih ingin memesan meja di {{ setting('restaurant_name') }}, silakan buat reservasi baru melalui website kami.</p>
            </div>

            <p>Jika Anda merasa ini adalah kesalahan atau memiliki pertanyaan, silakan hubungi kami:</p>
            <ul>
                <li>Telepon: {{ setting('restaurant_phone', '-') }}</li>
                <li>Email: {{ setting('restaurant_email', '-') }}</li>
                <li>Alamat: {{ setting('restaurant_address', '-') }}</li>
            </ul>

            <p>Terima kasih atas perhatian Anda. Kami berharap dapat melayani Anda di lain waktu.</p>
            
            <p style="margin-top: 30px;">Salam hangat,<br><strong>{{ setting('restaurant_name') }}</strong></p>
        </div>

        <div class="footer">
            <p style="margin: 5px 0;">&copy; {{ date('Y') }} {{ setting('restaurant_name') }}. All rights reserved.</p>
            <p style="margin: 5px 0;">{{ setting('restaurant_address') }}</p>
            <p style="margin: 5px 0;">
                Email: {{ setting('restaurant_email') }} | Phone: {{ setting('restaurant_phone') }}
            </p>
        </div>
    </div>
</body>
</html>
