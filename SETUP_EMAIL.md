# Setup Email Notification dengan Gmail

## Langkah-langkah Setup:

### 1. Siapkan App Password Gmail

Karena Gmail memerlukan autentikasi 2 faktor, Anda perlu membuat **App Password**:

1. Buka [Google Account](https://myaccount.google.com/)
2. Pilih **Security** di menu sebelah kiri
3. Aktifkan **2-Step Verification** jika belum aktif
4. Setelah 2FA aktif, cari **App passwords**
5. Buat App Password baru:
    - Pilih app: **Mail**
    - Pilih device: **Windows Computer** atau **Other**
    - Klik **Generate**
6. Salin password 16 digit yang muncul (format: xxxx xxxx xxxx xxxx)

### 2. Update File .env

Buka file `.env` dan update konfigurasi email:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=emailanda@gmail.com
MAIL_PASSWORD=xxxx xxxx xxxx xxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="emailanda@gmail.com"
MAIL_FROM_NAME="HIMPAUDI Bekasi Timur"
```

**Penting:**

-   Ganti `emailanda@gmail.com` dengan email Gmail Anda
-   Ganti `xxxx xxxx xxxx xxxx` dengan App Password yang sudah dibuat
-   Jangan gunakan password Gmail biasa, harus menggunakan App Password

### 3. Setup Queue Worker (Opsional tapi Direkomendasikan)

Email dikirim menggunakan queue untuk performa lebih baik. Jalankan queue worker:

```bash
php artisan queue:work
```

Atau untuk development, bisa jalankan di background dengan:

```bash
php artisan queue:listen
```

### 4. Testing Email

Untuk testing apakah email sudah terkirim:

1. Login sebagai admin
2. Buka menu **Verifikasi Anggota**
3. Approve atau Reject salah satu member pending
4. Cek email member tersebut untuk memastikan notifikasi masuk

### 5. Troubleshooting

**Jika email tidak terkirim:**

1. **Cek App Password**: Pastikan sudah menggunakan App Password, bukan password Gmail biasa

2. **Cek 2-Step Verification**: Pastikan sudah aktif di akun Gmail

3. **Cek Logs**: Lihat log Laravel untuk error:

    ```bash
    tail -f storage/logs/laravel.log
    ```

4. **Test Koneksi SMTP**:

    ```bash
    php artisan tinker
    ```

    Kemudian jalankan:

    ```php
    Mail::raw('Test email', function($message) {
        $message->to('test@example.com')->subject('Test');
    });
    ```

5. **Less Secure Apps**: Jika masih error, coba aktifkan "Less secure app access" di Gmail (tidak direkomendasikan, lebih baik gunakan App Password)

### 6. Email Templates

Email templates sudah dibuat di:

-   `resources/views/emails/member-approved.blade.php` - Email untuk member yang disetujui
-   `resources/views/emails/member-rejected.blade.php` - Email untuk member yang ditolak

Template sudah termasuk:

-   ✓ Design responsive dan professional
-   ✓ Informasi lengkap tentang status approval
-   ✓ Button untuk login/daftar ulang
-   ✓ Branding HIMPAUDI Bekasi Timur

### 7. Konfigurasi Queue di .env (Sudah Diset)

```env
QUEUE_CONNECTION=database
```

Pastikan tabel jobs sudah ada dengan menjalankan migration:

```bash
php artisan migrate
```

### 8. Production Setup (untuk server production)

Untuk production, gunakan supervisor untuk menjalankan queue worker terus menerus:

1. Install supervisor:

    ```bash
    sudo apt-get install supervisor
    ```

2. Buat config file: `/etc/supervisor/conf.d/laravel-worker.conf`

    ```ini
    [program:laravel-worker]
    process_name=%(program_name)s_%(process_num)02d
    command=php /path/to/artisan queue:work --sleep=3 --tries=3
    autostart=true
    autorestart=true
    user=www-data
    numprocs=1
    redirect_stderr=true
    stdout_logfile=/path/to/storage/logs/worker.log
    ```

3. Reload supervisor:
    ```bash
    sudo supervisorctl reread
    sudo supervisorctl update
    sudo supervisorctl start laravel-worker:*
    ```

## Fitur Email Notification

✅ **Email Approval**: Dikirim otomatis saat admin menyetujui member
✅ **Email Rejection**: Dikirim otomatis saat admin menolak member
✅ **Queue Support**: Email dikirim via queue untuk performa optimal
✅ **Professional Design**: Template email responsive dan menarik
✅ **Gmail Integration**: Menggunakan Gmail SMTP yang reliable

## Catatan Keamanan

⚠️ **JANGAN** commit file `.env` ke Git
⚠️ **JANGAN** share App Password ke siapapun
⚠️ Gunakan App Password, bukan password Gmail biasa
⚠️ Aktifkan 2-Factor Authentication di Gmail untuk keamanan
