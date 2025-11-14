<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Disetujui</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2563eb;
        }
        .logo {
            width: 60px;
            height: 60px;
            background-color: #2563eb;
            color: white;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        h1 {
            color: #2563eb;
            font-size: 24px;
            margin: 10px 0;
        }
        .success-icon {
            width: 60px;
            height: 60px;
            background-color: #10b981;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 20px 0;
        }
        .success-icon svg {
            width: 36px;
            height: 36px;
            fill: white;
        }
        .content {
            margin: 20px 0;
        }
        .highlight {
            background-color: #dbeafe;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            border-left: 4px solid #2563eb;
        }
        .button {
            display: inline-block;
            padding: 14px 28px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .button:hover {
            background-color: #1d4ed8;
        }
        .info-box {
            background-color: #f0f9ff;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .info-box strong {
            color: #2563eb;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
            text-align: center;
        }
        .footer a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo" style="background:none;width:auto;height:auto;padding:0;">
                <img src="{{ asset('images/logo-himpaudi.png') }}" alt="HIMPAUDI" style="max-width:90px;height:auto;display:block;margin:0 auto;" onerror="this.style.display='none';">
            </div>
            <h1 style="margin-top:10px;">HIMPAUDI Bekasi Timur</h1>
        </div>

        <div style="text-align: center;">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                </svg>
            </div>
        </div>

        <div class="content">
            <h2 style="color: #10b981;">Selamat! Pendaftaran Anda Disetujui ✓</h2>
            
            <p>Halo <strong>{{ $user->name }}</strong>,</p>
            
            <p>Kami dengan senang hati memberitahukan bahwa pendaftaran Anda sebagai anggota <strong>HIMPAUDI Bekasi Timur</strong> telah disetujui oleh admin.</p>

            <div class="highlight">
                <strong>Status Akun:</strong> Aktif<br>
                <strong>Email:</strong> {{ $user->email }}<br>
                <strong>Tanggal Disetujui:</strong> {{ now()->format('d F Y, H:i') }} WIB
            </div>

            <p>Sekarang Anda dapat mengakses semua fitur dan layanan yang tersedia di platform kami, termasuk:</p>
            
            <div class="info-box">
                ✓ Akses ke dashboard member<br>
                ✓ Mengikuti forum diskusi<br>
                ✓ Melihat dan mengunduh materi kegiatan<br>
                ✓ Berpartisipasi dalam kegiatan HIMPAUDI<br>
                ✓ Akses ke galeri dan dokumentasi
            </div>

            <div style="text-align: center;">
                <a href="{{ route('login') }}" class="button">Login ke Dashboard</a>
            </div>

            <p>Jika Anda memiliki pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi kami.</p>

            <p>Terima kasih telah bergabung dengan kami!</p>

            <p style="margin-top: 30px;">
                Salam hangat,<br>
                <strong>Tim HIMPAUDI Bekasi Timur</strong>
            </p>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>
                <a href="{{ route('home') }}">Website</a> | 
                <a href="mailto:{{ config('mail.from.address') }}">Kontak Kami</a>
            </p>
            <p style="margin-top: 10px; color: #9ca3af;">
                © {{ date('Y') }} HIMPAUDI Bekasi Timur. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
