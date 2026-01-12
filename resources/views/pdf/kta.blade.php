<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>KTA - {{ $dataPribadi->nama_lengkap ?? $user->username }}</title>
    <style>
        @page { margin: 0px; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            background-color: #2563eb;
            margin: 0;
        }
        .kta-card {
            width: 480pt;
            height: 295pt;
            background-color: #2563eb;
            padding: 20px;
            overflow: hidden;
        }
        /* Dekorasi Lingkaran */
        .circle-deco {
            position: absolute;
            top: -50pt;
            right: -50pt;
            width: 150pt;
            height: 150pt;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        /* Header */
        .header-table {
            width: 100%;
            margin-bottom: 15pt;
        }
        .logo-img {
            width: 40pt;
            height: 40pt;
        }
        .brand-title {
            font-size: 18pt;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .brand-sub {
            font-size: 8pt;
            text-transform: uppercase;
            opacity: 0.9;
        }
        /* Content Body */
        .content-table {
            width: 100%;
        }
        .photo-box {
            width: 75pt;
            height: 100pt;
            border: 2pt solid rgba(255, 255, 255, 0.5);
            border-radius: 5pt;
            overflow: hidden;
            background-color: #e5e7eb;
        }
        .photo-img {
            width: 75pt;
            height: 100pt;
        }
        .info-cell {
            padding-left: 15pt;
            vertical-align: top;
        }
        .label {
            font-size: 7pt;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1pt;
        }
        .value {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 8pt;
        }
        .value-name {
            font-size: 16pt;
            margin-bottom: 10pt;
        }
        /* Footer */
        .footer-area {
            position: absolute;
            bottom: 20pt;
            left: 20pt;
            right: 20pt;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            padding-top: 8pt;
        }
        .footer-note {
            font-size: 8pt;
            font-style: italic;
            opacity: 0.9;
        }
        .footer-id {
            font-size: 9pt;
            font-family: monospace;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="kta-card">
        <div class="circle-deco"></div>
        
        <!-- Header -->
        <table class="header-table" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50">
                    <img src="{{ public_path('images/logo-himpaudi.png') }}" class="logo-img">
                </td>
                <td>
                    <div class="brand-title">HIMPAUDI</div>
                    <div class="brand-sub">Kartu Akses Akun Lokal</div>
                </td>
                <td align="right" valign="top">
                    <!-- Status badge removed -->
                </td>
            </tr>
        </table>

        <!-- Body -->
        <table class="content-table" cellpadding="0" cellspacing="0">
            <tr>
                <td width="75">
                    <div class="photo-box">
                        @php
                            $fotoPath = $dataPribadi && $dataPribadi->foto_profil 
                                ? storage_path('app/public/' . $dataPribadi->foto_profil) 
                                : null;
                        @endphp
                        @if($fotoPath && file_exists($fotoPath))
                            <img src="{{ $fotoPath }}" class="photo-img">
                        @else
                            <div style="text-align:center; padding-top:35pt; color:#1e40af; font-size:30pt; font-weight:bold;">
                                {{ strtoupper(substr($user->username, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </td>
                <td class="info-cell">
                    <div class="label">Nama Lengkap</div>
                    <div class="value value-name">{{ $dataPribadi->nama_lengkap ?? $user->username }}</div>

                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="50%">
                                <div class="label">No Anggota</div>
                                <div class="value">HMP-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td width="50%">
                                <div class="label">Wilayah</div>
                                <div class="value">Bekasi Timur</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="label">Unit Kerja</div>
                                <div class="value">{{ $dataLembaga->nama_lembaga ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="label">Jabatan</div>
                                <div class="value">{{ $dataLembaga->jabatan ?? '-' }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="label">Kelurahan</div>
                                <div class="value">{{ $dataLembaga->kelurahan ?? '-' }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer-area">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="footer-note">Untuk keanggotaan resmi nasional silakan kunjungi himpaudi.org.</td>
                    <td class="footer-id">ID: HMP-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
