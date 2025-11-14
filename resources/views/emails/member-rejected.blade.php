<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Tidak Disetujui</title>
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
        .warning-icon {
            width: 60px;
            height: 60px;
            background-color: #ef4444;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 20px 0;
        }
        .warning-icon svg {
            width: 36px;
            height: 36px;
            fill: white;
        }
        .content {
            margin: 20px 0;
        }
        .highlight {
            background-color: #fee2e2;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            border-left: 4px solid #ef4444;
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
            background-color: #fef3c7;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            border-left: 4px solid #f59e0b;
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
            <div class="warning-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
            </div>
        </div>

        <div class="content">
            <h2 style="color: #ef4444;">Pemberitahuan Status Pendaftaran</h2>
            
            <p>Halo <strong>{{ $user->name }}</strong>,</p>
            
            <p>Terima kasih atas minat Anda untuk bergabung dengan <strong>HIMPAUDI Bekasi Timur</strong>.</p>

            <div class="highlight">
                Setelah melakukan verifikasi, kami mohon maaf untuk memberitahukan bahwa pendaftaran Anda saat ini <strong>belum dapat disetujui</strong>.
            </div>

            <div class="info-box">
                <strong>Kemungkinan Alasan:</strong><br>
                • Data yang dimasukkan tidak lengkap atau tidak sesuai<br>
                • Dokumen pendukung tidak valid atau tidak terbaca<br>
                • Lembaga PAUD belum terverifikasi<br>
                • Informasi yang diberikan tidak sesuai dengan kriteria keanggotaan
            </div>

            <p><strong>Apa yang dapat Anda lakukan?</strong></p>
            
            <p>Anda dapat mendaftar kembali dengan memastikan bahwa:</p>
            <ul>
                <li>Semua data pribadi diisi dengan lengkap dan benar</li>
                <li>Data lembaga PAUD sesuai dengan kondisi aktual</li>
                <li>Email yang digunakan valid dan aktif</li>
                <li>Memenuhi kriteria sebagai pendidik/tenaga kependidikan PAUD di Bekasi Timur</li>
            </ul>

            <div style="text-align: center;">
                <a href="{{ route('register') }}" class="button">Daftar Ulang</a>
            </div>

            <p>Jika Anda memiliki pertanyaan atau memerlukan klarifikasi lebih lanjut, silakan hubungi kami melalui email atau kontak yang tersedia.</p>

            <p style="margin-top: 30px;">
                Salam hormat,<br>
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
