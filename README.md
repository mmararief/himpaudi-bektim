# HIMPAUDI Bekasi Timur - Platform Website

Platform digital terpadu untuk Himpunan Pendidik dan Tenaga Kependidikan Anak Usia Dini (HIMPAUDI) Kecamatan Bekasi Timur. Website ini menyediakan sistem manajemen anggota, berita, galeri, forum diskusi, dan berbagai fitur pendukung lainnya.

## 🚀 Fitur Utama

-   **Manajemen Anggota**: Pendaftaran online, verifikasi admin, profil lengkap (data pribadi & lembaga)
-   **Lembaga Master**: Database PAUD dengan import CSV, CRUD, dan linking ke data lembaga anggota
-   **Pencarian Publik**: Cari lembaga PAUD dan profil anggota yang sudah aktif
-   **Berita & Artikel**: Publikasi berita dengan multiple photos, thumbnail, komentar, dan slug otomatis
-   **Galeri Foto**: Dokumentasi kegiatan dengan kategori dan tanggal kegiatan
-   **Forum Diskusi**: Platform kolaborasi dan diskusi antar anggota dengan fitur pin dan lock
-   **Struktur Organisasi**: Tampilan struktur pengurus HIMPAUDI
-   **FAQ**: Pertanyaan yang sering diajukan
-   **Visi Misi**: Manajemen visi dan misi organisasi
-   **Info Kontak**: Informasi kontak dinamis
-   **Email Notification**: Notifikasi otomatis untuk approval/rejection member
-   **Multi-role**: Admin dan Member dengan dashboard terpisah

## 📊 Rancangan Komponen

### Flowchart Interaksi User

```mermaid
flowchart TD
    Start([Start]) --> BukaWebsite[Akses Website HIMPAUDI]
    BukaWebsite --> UserType{Status User}

    UserType -->|Guest| GuestMenu{Pilih Menu}
    GuestMenu -->|Beranda| LihatBeranda[Lihat Beranda]
    GuestMenu -->|Berita| LihatBerita[Baca Berita & Komentar]
    GuestMenu -->|Galeri| LihatGaleri[Lihat Galeri Kegiatan]
    GuestMenu -->|Forum| LihatForum[Baca Forum Diskusi]
    GuestMenu -->|Struktur Org| LihatStruktur[Lihat Struktur Organisasi]
    GuestMenu -->|Cari Lembaga| CariLembaga[Cari Data Lembaga/Profil]
    GuestMenu -->|Registrasi| Registrasi[Daftar Akun Member]
    GuestMenu -->|Login| Login[Login ke Sistem]

    LihatBeranda --> EndGuest1([End])
    LihatBerita --> EndGuest2([End])
    LihatGaleri --> EndGuest3([End])
    LihatForum --> EndGuest4([End])
    LihatStruktur --> EndGuest5([End])
    CariLembaga --> EndGuest6([End])
    Registrasi --> TungguApproval[Tunggu Approval Admin]
    TungguApproval --> EndGuest7([End])

    Login --> ValidasiLogin{Login Valid?}
    ValidasiLogin -->|Tidak| Login
    ValidasiLogin -->|Ya| CekRole{Cek Role}

    UserType -->|Member Login| CekRole

    CekRole -->|Admin| AdminMenu{Menu Admin}
    AdminMenu -->|Dashboard| AdminDashboard[Dashboard Admin]
    AdminMenu -->|Kelola Member| KelolaAnggota[Verifikasi & Kelola Anggota]
    AdminMenu -->|Kelola Berita| KelolaBerita[CRUD Berita & Foto]
    AdminMenu -->|Kelola Galeri| KelolaGaleriAdmin[CRUD Galeri]
    AdminMenu -->|Kelola Forum| KelolaForum[Moderasi Forum & Pin/Lock]
    AdminMenu -->|Kelola Lembaga| KelolaLembaga[Import/CRUD Lembaga Master]
    AdminMenu -->|Setting| KelolaSetting[Visi Misi, FAQ, Kontak]

    AdminDashboard --> EndAdmin1([End])
    KelolaAnggota --> EndAdmin2([End])
    KelolaBerita --> EndAdmin3([End])
    KelolaGaleriAdmin --> EndAdmin4([End])
    KelolaForum --> EndAdmin5([End])
    KelolaLembaga --> EndAdmin6([End])
    KelolaSetting --> EndAdmin7([End])

    CekRole -->|Member| MemberMenu{Menu Member}
    MemberMenu -->|Dashboard| MemberDashboard[Dashboard Member]
    MemberMenu -->|Profil| EditProfil[Edit Data Pribadi & Lembaga]
    MemberMenu -->|Berita| BeritaMember[Baca & Komentar Berita]
    MemberMenu -->|Forum| ForumMember[Buat Topik & Diskusi]
    MemberMenu -->|Galeri| GaleriMember[Lihat Galeri]
    MemberMenu -->|Cari| CariMember[Cari Lembaga/Anggota]

    MemberDashboard --> EndMember1([End])
    EditProfil --> EndMember2([End])
    BeritaMember --> EndMember3([End])
    ForumMember --> EndMember4([End])
    GaleriMember --> EndMember5([End])
    CariMember --> EndMember6([End])
```

### Flowchart Registrasi Member

```mermaid
flowchart TD
    Start2([Start]) --> BukaWeb[Buka Website HIMPAUDI]
    BukaWeb --> KlikRegister[Klik Menu Register]
    KlikRegister --> FormRegistrasi[Isi Form Registrasi]
    FormRegistrasi --> IsiDataPribadi[Isi Data Pribadi]
    IsiDataPribadi --> IsiDataLembaga[Isi Data Lembaga PAUD]
    IsiDataLembaga --> UploadFoto[Upload Foto Profil]
    UploadFoto --> ValidasiForm{Validasi Form}
    ValidasiForm -->|Tidak Valid| FormRegistrasi
    ValidasiForm -->|Valid| SimpanDatabase[Simpan ke Database]
    SimpanDatabase --> SetStatusPending[Set Status = Pending]
    SetStatusPending --> RedirectLogin[Redirect ke Halaman Login]
    RedirectLogin --> TungguVerifikasi[Tunggu Verifikasi Admin]
    TungguVerifikasi --> End2([End])
```

### Flowchart Verifikasi Admin

```mermaid
flowchart TD
    StartAdmin([Start]) --> LoginAdmin[Admin Login]
    LoginAdmin --> BukaDashboard[Buka Dashboard Admin]
    BukaDashboard --> MenuVerifikasi[Pilih Menu Verifikasi Anggota]
    MenuVerifikasi --> TampilPending[Tampilkan List Member Pending]
    TampilPending --> PilihMember[Pilih Member untuk Review]
    PilihMember --> LihatDetail[Lihat Detail Data Member]
    LihatDetail --> KeputusanAdmin{Keputusan Admin}
    KeputusanAdmin -->|Approve| UpdateActive[Update Status = Active]
    UpdateActive --> KirimEmailApprove[Kirim Email Approval]
    KirimEmailApprove --> NotifSuccess1[Notifikasi Success]
    NotifSuccess1 --> EndAdmin1([End])
    KeputusanAdmin -->|Reject| UpdateReject[Update Status = Rejected]
    UpdateReject --> KirimEmailReject[Kirim Email Rejection]
    KirimEmailReject --> NotifSuccess2[Notifikasi Success]
    NotifSuccess2 --> EndAdmin2([End])
```

### Flowchart Kelola Berita

```mermaid
flowchart TD
    StartBerita([Start]) --> LoginAdminBerita[Admin Login]
    LoginAdminBerita --> MenuBerita[Pilih Menu Kelola Berita]
    MenuBerita --> PilihAksi{Pilih Aksi}
    PilihAksi -->|Tambah| FormTambah[Form Tambah Berita]
    FormTambah --> IsiJudul[Isi Judul & Konten]
    IsiJudul --> UploadThumbnail[Upload Thumbnail]
    UploadThumbnail --> UploadFotos[Upload Multiple Foto]
    UploadFotos --> SetPublish{Set Publish?}
    SetPublish -->|Ya| SetTanggalPublish[Set Tanggal Publish]
    SetPublish -->|Tidak| StatusDraft[Status Draft]
    SetTanggalPublish --> SimpanBerita[Simpan Berita]
    StatusDraft --> SimpanBerita
    SimpanBerita --> EndBerita1([End])

    PilihAksi -->|Edit| PilihBerita[Pilih Berita]
    PilihBerita --> FormEdit[Form Edit Berita]
    FormEdit --> UpdateData[Update Data Berita]
    UpdateData --> HapusFoto{Hapus Foto Lama?}
    HapusFoto -->|Ya| DeleteFoto[Delete Foto dari Storage]
    HapusFoto -->|Tidak| TambahFotoBaru{Tambah Foto Baru?}
    DeleteFoto --> TambahFotoBaru
    TambahFotoBaru -->|Ya| UploadFotoBaru[Upload Foto Baru]
    TambahFotoBaru -->|Tidak| UpdateBerita[Update Berita]
    UploadFotoBaru --> UpdateBerita
    UpdateBerita --> EndBerita2([End])

    PilihAksi -->|Hapus| KonfirmasiHapus{Konfirmasi Hapus?}
    KonfirmasiHapus -->|Ya| DeleteBeritaFoto[Hapus Semua Foto]
    DeleteBeritaFoto --> DeleteBerita[Hapus Berita]
    DeleteBerita --> EndBerita3([End])
    KonfirmasiHapus -->|Tidak| MenuBerita
```

### Arsitektur Sistem

```mermaid
graph TB
    subgraph "Frontend Layer"
        A[Public Pages] --> A1[Landing Page]
        A --> A2[Berita]
        A --> A3[Galeri]
        A --> A4[Forum]
        A --> A5[Struktur Organisasi]

        B[Auth Pages] --> B1[Login]
        B --> B2[Register]

        C[Member Dashboard] --> C1[Profile]
        C --> C2[Data Lembaga]
        C --> C3[Forum Diskusi]

        D[Admin Dashboard] --> D1[Kelola Anggota]
        D --> D2[Kelola Berita]
        D --> D3[Kelola Galeri]
        D --> D4[Kelola Forum]
        D --> D5[Visi Misi]
        D --> D6[FAQ]
        D --> D7[Info Kontak]
    end

    subgraph "Backend Layer"
        E[Controllers] --> E1[Auth Controller]
        E --> E2[Member Controller]
        E --> E3[Berita Controller]
        E --> E4[Galeri Controller]
        E --> E5[Forum Controller]
        E --> E6[Lembaga Master Controller]

        F[Models] --> F1[User]
        F --> F2[DataPribadi]
        F --> F3[DataLembaga]
        F --> F4[Berita]
        F --> F5[BeritaPhoto]
        F --> F6[BeritaComment]
        F --> F7[Galeri]
        F --> F8[ForumTopik]
        F --> F9[ForumBalasan]
        F --> F10[LembagaMaster]
        F --> F11[VisiMisi]
        F --> F12[FAQ]
        F --> F13[ContactInfo]

        G[Services] --> G1[Email Service]
        G --> G2[Storage Service]
        G --> G3[Queue Service]
        G --> G4[Import Service]
    end

    subgraph "Database Layer"
        H[(MySQL)] --> H1[users]
        H --> H2[data_pribadi]
        H --> H3[data_lembaga]
        H --> H4[lembaga_masters]
        H --> H5[berita]
        H --> H6[berita_photos]
        H --> H7[berita_comments]
        H --> H8[galeri]
        H --> H9[forum_topik]
        H --> H10[forum_balasan]
        H --> H11[visi_misi]
        H --> H12[faq]
        H --> H13[contact_info]
    end

    A --> E
    B --> E1
    C --> E
    D --> E
    E --> F
    F --> H
    G1 -.Email Notification.-> E2
    G2 -.File Upload.-> E3
    G2 -.File Upload.-> E4
    G3 -.Queue Jobs.-> G1
```

### Alur Verifikasi Member

```mermaid
sequenceDiagram
    participant User
    participant System
    participant Admin
    participant Email

    User->>System: Registrasi (Data Pribadi + Lembaga)
    System->>System: Validasi Data
    System->>System: Set Status = Pending
    System-->>User: Redirect ke Login (Success Message)

    Admin->>System: Login & Buka Menu Verifikasi
    System-->>Admin: Tampilkan List Pending Members
    Admin->>System: Review Data Member

    alt Approve Member
        Admin->>System: Click Approve
        System->>System: Update Status = Active
        System->>Email: Kirim Email Approval
        Email-->>User: Notifikasi Approval
        System-->>Admin: Success Message
    else Reject Member
        Admin->>System: Click Reject
        System->>System: Update Status = Rejected
        System->>Email: Kirim Email Rejection
        Email-->>User: Notifikasi Rejection
        System-->>Admin: Success Message
    end
```

### Entity Relationship Diagram

```mermaid
erDiagram
    USERS ||--o| DATA_PRIBADI : has
    USERS ||--o| DATA_LEMBAGA : has
    USERS ||--o{ BERITA : creates
    USERS ||--o{ FORUM_TOPIK : creates
    USERS ||--o{ FORUM_BALASAN : creates
    USERS ||--o{ BERITA_COMMENTS : creates
    BERITA ||--o{ BERITA_PHOTOS : contains
    BERITA ||--o{ BERITA_COMMENTS : has
    FORUM_TOPIK ||--o{ FORUM_BALASAN : has
    LEMBAGA_MASTERS ||--o{ DATA_LEMBAGA : references
    DATA_LEMBAGA }o--|| LEMBAGA_MASTERS : linked_to

    USERS {
        int id PK
        string username
        string email
        string password
        enum role
        enum status
        datetime created_at
    }

    DATA_PRIBADI {
        int id PK
        int user_id FK
        string nama_lengkap
        string niptk_nuptk
        string no_kta_lama
        string no_ktp
        string tempat_lahir
        date tanggal_lahir
        enum jenis_kelamin
        string pendidikan_terakhir
        date tmt_kerja
        json riwayat_diklat
        string alamat_domisili
        string no_hp
        string foto_profil
    }

    DATA_LEMBAGA {
        int id PK
        int user_id FK
        int lembaga_master_id FK
        string nama_lembaga
        string npsn
    }

    LEMBAGA_MASTERS {
        int id PK
        string nama_lembaga
        string npsn
        string akreditasi
        string kepala_sekolah
        string alamat
        string kecamatan
        string kelurahan
        int jumlah_guru
        int jumlah_siswa
        string foto
    }

    BERITA {
        int id PK
        int user_id FK
        string judul
        string slug
        longtext konten
        string thumbnail
        boolean is_published
        datetime published_at
        int views
    }

    BERITA_PHOTOS {
        int id PK
        int berita_id FK
        string photo_path
        string caption
        int order
    }

    BERITA_COMMENTS {
        int id PK
        int berita_id FK
        int user_id FK
        text comment
        datetime created_at
    }

    GALERI {
        int id PK
        string judul_kegiatan
        string deskripsi
        string file_gambar
        date tanggal_kegiatan
    }

    FORUM_TOPIK {
        int id PK
        int user_id FK
        string judul
        string slug
        text konten
        int views
        boolean is_pinned
        boolean is_locked
    }

    FORUM_BALASAN {
        int id PK
        int forum_topik_id FK
        int user_id FK
        text konten
        datetime created_at
    }

    VISI_MISI {
        int id PK
        text visi
        text misi
        boolean is_active
    }

    FAQ {
        int id PK
        string pertanyaan
        text jawaban
        int urutan
        boolean is_active
    }

    CONTACT_INFO {
        int id PK
        string alamat
        string telepon
        string email
        string whatsapp
        boolean is_active
    }
```

### UML Class Diagram

```mermaid
classDiagram
    class User {
        +int id
        +string username
        +string email
        +string password
        +enum role
        +enum status
        +timestamps
        +dataPribadi()
        +dataLembaga()
        +berita()
        +forumTopik()
        +forumBalasan()
        +beritaComments()
    }

    class DataPribadi {
        +int id
        +int user_id
        +string nama_lengkap
        +string niptk_nuptk
        +string no_kta_lama
        +string no_ktp
        +string tempat_lahir
        +date tanggal_lahir
        +enum jenis_kelamin
        +string pendidikan_terakhir
        +date tmt_kerja
        +json riwayat_diklat
        +string alamat_domisili
        +string no_hp
        +string foto_profil
        +timestamps
        +user()
    }

    class DataLembaga {
        +int id
        +int user_id
        +int lembaga_master_id
        +string nama_lembaga
        +string npsn
        +timestamps
        +user()
        +lembagaMaster()
    }

    class LembagaMaster {
        +int id
        +string nama_lembaga
        +string npsn
        +string akreditasi
        +string kepala_sekolah
        +string alamat
        +string kecamatan
        +string kelurahan
        +int jumlah_guru
        +int jumlah_siswa
        +string foto
        +timestamps
        +dataLembaga()
    }

    class Berita {
        +int id
        +int user_id
        +string judul
        +string slug
        +longtext konten
        +string thumbnail
        +boolean is_published
        +datetime published_at
        +int views
        +timestamps
        +user()
        +photos()
        +comments()
        +scopePublished()
    }

    class BeritaPhoto {
        +int id
        +int berita_id
        +string photo_path
        +string caption
        +int order
        +timestamps
        +berita()
    }

    class BeritaComment {
        +int id
        +int berita_id
        +int user_id
        +text comment
        +timestamps
        +berita()
        +user()
    }

    class Galeri {
        +int id
        +string judul_kegiatan
        +string deskripsi
        +string file_gambar
        +date tanggal_kegiatan
        +timestamps
    }

    class ForumTopik {
        +int id
        +int user_id
        +string judul
        +string slug
        +text konten
        +int views
        +boolean is_pinned
        +boolean is_locked
        +timestamps
        +user()
        +balasan()
    }

    class ForumBalasan {
        +int id
        +int forum_topik_id
        +int user_id
        +text konten
        +timestamps
        +forumTopik()
        +user()
    }

    class VisiMisi {
        +int id
        +text visi
        +text misi
        +boolean is_active
        +timestamps
    }

    class FAQ {
        +int id
        +string pertanyaan
        +text jawaban
        +int urutan
        +boolean is_active
        +timestamps
    }

    class ContactInfo {
        +int id
        +string alamat
        +string telepon
        +string email
        +string whatsapp
        +boolean is_active
        +timestamps
    }

    User "1" --> "1" DataPribadi
    User "1" --> "1" DataLembaga
    User "1" --> "*" Berita
    User "1" --> "*" ForumTopik
    User "1" --> "*" ForumBalasan
    User "1" --> "*" BeritaComment
    DataLembaga "*" --> "1" LembagaMaster
    Berita "1" --> "*" BeritaPhoto
    Berita "1" --> "*" BeritaComment
    ForumTopik "1" --> "*" ForumBalasan
```

### UML Use Case Diagram

```mermaid
flowchart TB
    subgraph "HIMPAUDI System"
        UC1[Registrasi Member]
        UC2[Login]
        UC3[Lihat Berita]
        UC4[Lihat Galeri]
        UC5[Lihat Forum]
        UC6[Lihat Struktur Organisasi]
        UC7[Edit Profil]
        UC8[Edit Data Lembaga]
        UC9[Buat Topik Forum]
        UC10[Verifikasi Member]
        UC11[Kelola Berita]
        UC12[Kelola Galeri]
        UC13[Kelola Forum]
        UC14[Kelola Visi Misi]
        UC15[Kelola FAQ]
        UC16[Kelola Info Kontak]
    end

    Guest((Guest User))
    Member((Member))
    Admin((Admin))

    Guest --> UC1
    Guest --> UC2
    Guest --> UC3
    Guest --> UC4
    Guest --> UC5
    Guest --> UC6

    Member --> UC2
    Member --> UC3
    Member --> UC4
    Member --> UC5
    Member --> UC6
    Member --> UC7
    Member --> UC8
    Member --> UC9

    Admin --> UC2
    Admin --> UC10
    Admin --> UC11
    Admin --> UC12
    Admin --> UC13
    Admin --> UC14
    Admin --> UC15
    Admin --> UC16
```

### UML Activity Diagram - Proses Verifikasi Member

```mermaid
flowchart TD
    Start([Start: Member Registrasi]) --> InputData[Member Input Data Registrasi]
    InputData --> ValidasiInput{Validasi Input}
    ValidasiInput -->|Invalid| ShowError[Tampilkan Error Message]
    ShowError --> InputData
    ValidasiInput -->|Valid| SimpanData[Simpan Data ke Database]
    SimpanData --> SetPending[Set Status Member = Pending]
    SetPending --> Notif1[Tampilkan Notifikasi Success]
    Notif1 --> WaitAdmin[Menunggu Verifikasi Admin]

    WaitAdmin --> AdminLogin[Admin Login ke Dashboard]
    AdminLogin --> LihatList[Admin Lihat List Pending Member]
    LihatList --> ReviewData[Admin Review Data Member]
    ReviewData --> Decision{Keputusan Admin}

    Decision -->|Approve| UpdateActive[Update Status = Active]
    UpdateActive --> SendApprove[Kirim Email Approval]
    SendApprove --> LogApprove[Log Activity Approval]
    LogApprove --> NotifAdmin1[Tampilkan Success ke Admin]
    NotifAdmin1 --> MemberActive[Member Dapat Login]
    MemberActive --> End1([End: Member Aktif])

    Decision -->|Reject| UpdateReject[Update Status = Rejected]
    UpdateReject --> SendReject[Kirim Email Rejection]
    SendReject --> LogReject[Log Activity Rejection]
    LogReject --> NotifAdmin2[Tampilkan Success ke Admin]
    NotifAdmin2 --> MemberReject[Member Tidak Dapat Login]
    MemberReject --> End2([End: Member Ditolak])
```

### UML Activity Diagram - Kelola Berita dengan Multiple Photos

```mermaid
flowchart TD
    Start([Start: Admin Kelola Berita]) --> MenuAction{Pilih Aksi}

    MenuAction -->|Create| FormCreate[Buka Form Tambah Berita]
    FormCreate --> InputBerita[Input Judul, Konten, Thumbnail]
    InputBerita --> UploadPhotos[Upload Multiple Photos]
    UploadPhotos --> SetPublish{Set Published?}
    SetPublish -->|Yes| SetDate[Set Published Date]
    SetPublish -->|No| Draft1[Save as Draft]
    SetDate --> ValidateCreate{Validasi Data}
    Draft1 --> ValidateCreate
    ValidateCreate -->|Invalid| ErrorCreate[Tampilkan Error]
    ErrorCreate --> FormCreate
    ValidateCreate -->|Valid| SaveBerita[Simpan Berita ke Database]
    SaveBerita --> LoopPhotos[Loop Through Photos]
    LoopPhotos --> SavePhoto[Simpan Photo ke berita_photos]
    SavePhoto --> CheckMore{Masih Ada Photo?}
    CheckMore -->|Yes| LoopPhotos
    CheckMore -->|No| SuccessCreate[Tampilkan Success Message]
    SuccessCreate --> EndCreate([End])

    MenuAction -->|Edit| SelectBerita[Pilih Berita untuk Edit]
    SelectBerita --> LoadData[Load Data Berita & Photos]
    LoadData --> FormEdit[Tampilkan Form Edit]
    FormEdit --> UpdateData[Update Judul, Konten, Thumbnail]
    UpdateData --> DeletePhotos{Hapus Photo Lama?}
    DeletePhotos -->|Yes| LoopDelete[Loop Photo untuk Dihapus]
    LoopDelete --> DeleteFile[Hapus File dari Storage]
    DeleteFile --> DeleteDB[Hapus Record dari DB]
    DeleteDB --> CheckMoreDelete{Masih Ada yang Dihapus?}
    CheckMoreDelete -->|Yes| LoopDelete
    CheckMoreDelete -->|No| AddNew{Tambah Photo Baru?}
    DeletePhotos -->|No| AddNew
    AddNew -->|Yes| UploadNew[Upload Photo Baru]
    UploadNew --> SaveNew[Simpan Photo Baru]
    SaveNew --> ValidateEdit{Validasi Data}
    AddNew -->|No| ValidateEdit
    ValidateEdit -->|Invalid| ErrorEdit[Tampilkan Error]
    ErrorEdit --> FormEdit
    ValidateEdit -->|Valid| UpdateBerita[Update Data Berita]
    UpdateBerita --> SuccessEdit[Tampilkan Success Message]
    SuccessEdit --> EndEdit([End])

    MenuAction -->|Delete| SelectDelete[Pilih Berita untuk Hapus]
    SelectDelete --> Confirm{Konfirmasi Hapus?}
    Confirm -->|No| EndCancel([End: Dibatalkan])
    Confirm -->|Yes| GetPhotos[Ambil Semua Photos Berita]
    GetPhotos --> DeleteAllFiles[Hapus Semua File Photos]
    DeleteAllFiles --> DeleteBerita[Hapus Record Berita]
    DeleteBerita --> CascadeDelete[Cascade Delete berita_photos]
    CascadeDelete --> SuccessDelete[Tampilkan Success Message]
    SuccessDelete --> EndDelete([End])
```

## 📋 Persyaratan Sistem

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL/MariaDB >= 5.7
-   Web Server (Apache/Nginx)

## 🛠️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/mmararief/himpaudi-bektim.git
cd himpaudi-bektim
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file .env example
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=himpaudi_bektim
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Konfigurasi Email (Opsional)

Untuk fitur notifikasi email, konfigurasikan SMTP di file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="HIMPAUDI Bekasi Timur"
```

**Catatan**: Untuk Gmail, gunakan [App Password](https://support.google.com/accounts/answer/185833) bukan password biasa.

### 6. Migrasi Database dan Seeder

```bash
# Jalankan migrasi
php artisan migrate

# (Opsional) Jalankan seeder untuk data awal
php artisan db:seed
```

### 7. Setup Storage

```bash
# Buat symbolic link untuk storage
php artisan storage:link
```

### 8. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 9. Jalankan Aplikasi

```bash
# Development server
php artisan serve
```

Buka browser dan akses: `http://localhost:8000`

### 10. Setup Queue Worker (Opsional)

Untuk email notification yang optimal:

```bash
# Development
php artisan queue:work

# Atau dengan listen (auto-reload)
php artisan queue:listen
```

## 👤 Akun Default

Setelah menjalankan seeder, Anda dapat login dengan akun:

**Admin:**

-   Email: admin@himpaudi-bektim.org
-   Password: password

## 📁 Struktur Folder Penting

```
himpaudi-bektim/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Controller untuk admin
│   │   ├── Auth/           # Authentication controllers
│   │   └── ...
│   ├── Models/             # Eloquent models
│   └── Mail/               # Email templates (Mailables)
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── public/
│   └── images/             # Logo dan gambar statis
├── resources/
│   ├── views/              # Blade templates
│   │   ├── admin/          # Admin views
│   │   ├── auth/           # Authentication views
│   │   ├── berita/         # Berita public views
│   │   ├── galeri/         # Galeri views
│   │   └── ...
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   └── web.php             # Web routes
└── storage/
    └── app/public/         # Uploaded files
```

## 🎨 Teknologi yang Digunakan

-   **Framework**: Laravel 11.x
-   **Frontend**: Tailwind CSS, Alpine.js (via Breeze)
-   **Authentication**: Laravel Breeze
-   **Database**: MySQL
-   **Email**: Laravel Mail + Queue
-   **File Storage**: Laravel Storage (local/public disk)

## 📝 Fitur Admin

1. **Dashboard**: Overview statistik
2. **Manajemen Anggota**: Verifikasi (approve/reject), edit, hapus member
3. **Kelola Berita**: CRUD berita dengan multiple photos dan komentar
4. **Kelola Galeri**: Upload dan manajemen foto kegiatan
5. **Kelola Forum**: Moderasi diskusi (pin/lock topik, hapus balasan)
6. **Kelola Lembaga Master**: Import CSV, CRUD data lembaga PAUD
7. **Kelola User**: CRUD user account dan role management
8. **Visi Misi**: Update visi dan misi
9. **FAQ**: Manajemen pertanyaan umum
10. **Info Kontak**: Update informasi kontak

## 📝 Fitur Member

1. **Dashboard**: Akses informasi personal dan berita terbaru
2. **Profil**: Edit data pribadi, data lembaga, dan lihat info lembaga master (jika terhubung)
3. **Berita**: Baca berita terbaru dan beri komentar
4. **Forum**: Buat topik diskusi dan balas diskusi
5. **Galeri**: Lihat dokumentasi kegiatan
6. **Pencarian**: Cari lembaga PAUD dan profil anggota lain

## 🔐 Keamanan

-   Password hashing menggunakan bcrypt
-   CSRF protection
-   SQL injection prevention (Eloquent ORM)
-   XSS protection
-   Email verification (optional)
-   Role-based access control

## 🐛 Troubleshooting

### Error 500 setelah instalasi

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Gambar tidak muncul

```bash
php artisan storage:link
```

### Email tidak terkirim

-   Pastikan konfigurasi SMTP di `.env` sudah benar
-   Untuk Gmail, gunakan App Password
-   Jalankan `php artisan queue:work`
-   Cek log di `storage/logs/laravel.log`

### Asset tidak ter-build

```bash
npm install
npm run build
```

## 📄 License

Project ini menggunakan framework Laravel yang berlisensi [MIT license](https://opensource.org/licenses/MIT).

---
