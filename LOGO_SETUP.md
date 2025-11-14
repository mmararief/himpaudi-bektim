# Instruksi Penempatan Logo HIMPAUDI

## 📋 Langkah-langkah:

### 1. Simpan File Logo

Simpan logo HIMPAUDI (gambar dengan bendera merah-putih dan figur kuning-biru) dengan nama **`logo-himpaudi.png`** di folder:

```
public/images/logo-himpaudi.png
```

### 2. Format Logo yang Direkomendasikan

-   **Format**: PNG dengan background transparan
-   **Ukuran**: Minimal 200x200 pixels (untuk kualitas HD)
-   **Aspect Ratio**: Pertahankan rasio asli logo

### 3. Lokasi Logo yang Sudah Ditambahkan

Logo HIMPAUDI sekarang akan muncul di:

#### ✓ Navigasi Bar (Semua Halaman)

-   **welcome.blade.php** - Halaman utama
-   **layouts/public.blade.php** - Layout public (Galeri, Forum)
-   **layouts/admin.blade.php** - Dashboard admin

**Ukuran di Navigasi**: `h-12 w-auto` (height 48px, width otomatis)

#### ✓ Hero Section (Halaman Utama)

-   **welcome.blade.php** - Section hero dengan background biru

**Ukuran di Hero**: `h-24 w-auto` (height 96px, width otomatis) dengan drop-shadow

#### ✓ Footer (Semua Halaman)

-   **welcome.blade.php** - Footer halaman utama
-   **layouts/public.blade.php** - Footer layout public

**Ukuran di Footer**: `h-12 w-auto` (height 48px, width otomatis)

### 4. Alternative: Jika Belum Ada Folder Images

Jika folder `public/images` belum ada, buat dengan command:

**Windows PowerShell:**

```powershell
New-Item -ItemType Directory -Path "public/images"
```

**Command Prompt / Terminal:**

```bash
mkdir public\images
```

### 5. Verifikasi Logo

Setelah menempatkan logo, cek di browser:

1. Buka halaman: `http://localhost:8000`
2. Logo harus muncul di:
    - Navbar atas
    - Hero section (logo besar di tengah)
    - Footer bawah

### 6. Troubleshooting

**Jika logo tidak muncul:**

1. **Cek path file**: Pastikan file ada di `public/images/logo-himpaudi.png`
2. **Cek nama file**: Harus persis `logo-himpaudi.png` (huruf kecil semua)
3. **Clear cache browser**: Tekan `Ctrl + F5` atau `Cmd + Shift + R`
4. **Clear Laravel cache**:
    ```bash
    php artisan cache:clear
    php artisan view:clear
    php artisan config:clear
    ```

### 7. Optimasi Logo (Opsional)

Untuk performa lebih baik, Anda bisa membuat beberapa versi:

-   `logo-himpaudi.png` - Versi original (untuk hero section)
-   `logo-himpaudi-small.png` - Versi kecil (untuk navbar & footer)

Dan update path di code jika perlu optimasi lebih lanjut.

## 📝 Catatan

-   Logo menggunakan `w-auto` untuk menjaga aspect ratio original
-   Semua logo menggunakan `alt="Logo HIMPAUDI"` untuk aksesibilitas
-   Logo di hero section menggunakan `drop-shadow-lg` untuk efek bayangan
-   Jika ingin mengubah ukuran, edit class `h-12` atau `h-24` di file Blade

## ✅ Checklist

-   [ ] Simpan logo di `public/images/logo-himpaudi.png`
-   [ ] Refresh browser dengan `Ctrl + F5`
-   [ ] Cek logo muncul di navbar
-   [ ] Cek logo muncul di hero section
-   [ ] Cek logo muncul di footer
-   [ ] Cek logo pada halaman admin
-   [ ] Test pada semua halaman (Home, Galeri, Forum, Dashboard)
