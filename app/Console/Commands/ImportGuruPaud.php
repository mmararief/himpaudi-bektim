<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\DataPribadi;
use App\Models\DataLembaga;
use App\Models\LembagaMaster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ImportGuruPaud extends Command
{
    protected $signature = 'guru:import {file : Path to CSV file} {--update : Update data lembaga untuk user yang sudah ada}';
    protected $description = 'Import data guru PAUD dari file CSV';

    private $imported = 0;
    private $skipped = 0;
    private $updated = 0;
    private $errors = [];

    // Untuk carry forward data lembaga
    private $currentLembaga = '';
    private $currentAlamatLembaga = '';

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: {$filePath}");
            return 1;
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        if ($extension !== 'csv') {
            $this->error('File harus berformat CSV (.csv)');
            return 1;
        }

        $this->info('Memulai import data guru PAUD...');
        $this->newLine();

        try {
            $this->processCSV($filePath);

            $this->newLine();
            $this->info('✓ Import selesai!');
            $this->newLine();

            $this->table(
                ['Status', 'Jumlah'],
                [
                    ['Data berhasil diimpor', $this->imported],
                    ['Data lembaga diupdate', $this->updated],
                    ['Data dilewati', $this->skipped],
                    ['Error', count($this->errors)],
                ]
            );

            if (count($this->errors) > 0) {
                $this->newLine();
                $this->warn('Error yang terjadi (menampilkan 20 pertama):');
                foreach (array_slice($this->errors, 0, 20) as $error) {
                    $this->error($error);
                }
            }

            return 0;
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat import:');
            $this->error($e->getMessage());
            return 1;
        }
    }

    private function processCSV($filePath)
    {
        $handle = fopen($filePath, 'r');
        if ($handle === false) {
            throw new \Exception('Tidak bisa membuka file CSV');
        }

        // Skip header rows (2 baris pertama adalah header)
        fgetcsv($handle); // DATA GURU PAUD KECAMATAN BEKASI TIMUR
        fgetcsv($handle); // Baris kosong
        fgetcsv($handle); // Header kolom

        $bar = $this->output->createProgressBar();
        $bar->start();

        $rowNumber = 3;
        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;

            // Skip empty rows
            if (empty($row[0]) || empty($row[1]) || !is_numeric(trim($row[0]))) {
                continue;
            }

            try {
                $this->processRow($row, $rowNumber);
                $bar->advance();
            } catch (\Exception $e) {
                $this->errors[] = "Baris {$rowNumber}: " . $e->getMessage();
            }
        }

        $bar->finish();
        fclose($handle);
    }

    private function processRow($row, $rowNumber)
    {
        // Mapping kolom CSV
        // 0: No
        // 1: Nama Lengkap (berikut Gelar)
        // 2: Tempat / Tanggal Lahir
        // 3: Nomor KTA
        // 4: Nama Lembaga
        // 5: Alamat Lembaga
        // 6: Asal Kecamatan
        // 7: Lama Mengajar (dalam Tahun)
        // 8: Pendidikan Terakhir
        // 9: Pelatihan yang pernah diikuti
        // 10: Kompetensi yang ingin dimiliki

        $namaLengkap = trim($row[1] ?? '');

        if (empty($namaLengkap)) {
            $this->skipped++;
            return;
        }

        // Parse tempat dan tanggal lahir
        $tempatTanggalLahir = trim($row[2] ?? '');
        [$tempatLahir, $tanggalLahir] = $this->parseTempatTanggalLahir($tempatTanggalLahir);

        $noKta = $this->cleanNoKta(trim($row[3] ?? ''));
        $namaLembaga = trim($row[4] ?? '');
        $alamatLembaga = trim($row[5] ?? '');

        // Carry forward: jika nama lembaga kosong, gunakan lembaga sebelumnya
        if (!empty($namaLembaga)) {
            $this->currentLembaga = $namaLembaga;
            $this->currentAlamatLembaga = $alamatLembaga;
        } else {
            // Gunakan lembaga sebelumnya
            $namaLembaga = $this->currentLembaga;
            if (empty($alamatLembaga)) {
                $alamatLembaga = $this->currentAlamatLembaga;
            }
        }

        $kecamatan = trim($row[6] ?? 'Bekasi Timur');
        $lamaMengajar = $this->parseLamaMengajar(trim($row[7] ?? ''));
        $pendidikanTerakhir = trim($row[8] ?? '');
        $pelatihan = trim($row[9] ?? '');
        $kompetensi = trim($row[10] ?? '');

        // Generate username dan email
        $username = $this->generateUsername($namaLengkap);
        $email = $username . '@himpaudi-bektim.local';

        DB::transaction(function () use (
            $namaLengkap,
            $tempatLahir,
            $tanggalLahir,
            $noKta,
            $namaLembaga,
            $alamatLembaga,
            $kecamatan,
            $lamaMengajar,
            $pendidikanTerakhir,
            $pelatihan,
            $kompetensi,
            $username,
            $email
        ) {
            // Cek apakah user sudah ada berdasarkan nama
            $existingUser = User::whereHas('dataPribadi', function ($q) use ($namaLengkap) {
                $q->where('nama_lengkap', $namaLengkap);
            })->first();

            if ($existingUser) {
                // Jika option --update, update data lembaga untuk user yang sudah ada
                if ($this->option('update') && !empty($namaLembaga)) {
                    $this->updateDataLembaga($existingUser, $namaLembaga, $alamatLembaga);
                    $this->updated++;
                } else {
                    $this->skipped++;
                }
                return;
            }

            // Create user
            $user = User::create([
                'username' => $username,
                'email' => $email,
                'password' => Hash::make('password123'), // Default password
                'role' => 'member',
                'status' => 'active', // Langsung aktif karena data existing
            ]);

            // Hitung TMT Kerja dari lama mengajar
            $tmtKerja = Carbon::now()->subYears($lamaMengajar)->startOfYear();

            // Create data pribadi
            DataPribadi::create([
                'user_id' => $user->id,
                'no_kta_lama' => $noKta ?: null,
                'no_ktp' => $this->generateTempNoKtp($user->id),
                'nama_lengkap' => $namaLengkap,
                'tempat_lahir' => $tempatLahir ?: 'Tidak Diketahui',
                'tanggal_lahir' => $tanggalLahir ?: Carbon::create(1980, 1, 1),
                'jenis_kelamin' => 'Perempuan', // Default, bisa diupdate nanti
                'pendidikan_terakhir' => $this->normalizePendidikan($pendidikanTerakhir),
                'tmt_kerja' => $tmtKerja,
                'riwayat_diklat' => $pelatihan ? [$pelatihan] : null,
                'alamat_domisili' => $alamatLembaga ?: 'Bekasi Timur',
                'no_hp' => '08' . str_pad($user->id, 10, '0', STR_PAD_LEFT), // Temp HP
            ]);

            // Create data lembaga jika ada nama lembaga
            if (!empty($namaLembaga)) {
                // Cari atau buat lembaga master
                $lembagaMaster = LembagaMaster::firstOrCreate(
                    ['nama_sekolah' => $namaLembaga],
                    [
                        'npsn' => $this->generateTempNPSN(),
                        'alamat' => $alamatLembaga ?: 'Bekasi Timur',
                    ]
                );

                DataLembaga::create([
                    'user_id' => $user->id,
                    'npsn' => $lembagaMaster->npsn,
                    'nama_lembaga' => $namaLembaga,
                    'lembaga_master_id' => $lembagaMaster->id,
                    'jabatan' => 'Guru',
                    'kelurahan' => $this->normalizeKelurahan($alamatLembaga),
                ]);
            }

            $this->imported++;
        });
    }

    private function updateDataLembaga($user, $namaLembaga, $alamatLembaga)
    {
        // Cari atau buat lembaga master
        $lembagaMaster = LembagaMaster::firstOrCreate(
            ['nama_sekolah' => $namaLembaga],
            [
                'npsn' => $this->generateTempNPSN(),
                'alamat' => $alamatLembaga ?: 'Bekasi Timur',
            ]
        );

        // Cek apakah user sudah punya data lembaga
        $existingDataLembaga = DataLembaga::where('user_id', $user->id)->first();

        if ($existingDataLembaga) {
            // Update data lembaga yang sudah ada
            $existingDataLembaga->update([
                'npsn' => $lembagaMaster->npsn,
                'nama_lembaga' => $namaLembaga,
                'lembaga_master_id' => $lembagaMaster->id,
                'kelurahan' => $this->normalizeKelurahan($alamatLembaga),
            ]);
        } else {
            // Buat data lembaga baru
            DataLembaga::create([
                'user_id' => $user->id,
                'npsn' => $lembagaMaster->npsn,
                'nama_lembaga' => $namaLembaga,
                'lembaga_master_id' => $lembagaMaster->id,
                'jabatan' => 'Guru',
                'kelurahan' => $this->normalizeKelurahan($alamatLembaga),
            ]);
        }
    }

    private function parseTempatTanggalLahir($value)
    {
        $tempatLahir = '';
        $tanggalLahir = null;

        if (empty($value)) {
            return [$tempatLahir, $tanggalLahir];
        }

        // Format: "Tempat, Tanggal" atau "Tempat/Tanggal"
        $parts = preg_split('/[,\/]/', $value, 2);

        if (count($parts) >= 1) {
            $tempatLahir = trim($parts[0]);
        }

        if (count($parts) >= 2) {
            $tanggalLahir = $this->parseDate(trim($parts[1]));
        }

        return [$tempatLahir, $tanggalLahir];
    }

    private function parseDate($dateStr)
    {
        if (empty($dateStr)) {
            return null;
        }

        $dateStr = trim($dateStr);

        // Mapping bulan Indonesia ke angka
        $bulanMapping = [
            'januari' => 1,
            'februari' => 2,
            'maret' => 3,
            'april' => 4,
            'mei' => 5,
            'mey' => 5,
            'juni' => 6,
            'juli' => 7,
            'agustus' => 8,
            'september' => 9,
            'oktober' => 10,
            'november' => 11,
            'nopember' => 11,
            'desember' => 12
        ];

        // Try format: "DD Bulan YYYY" atau "DD-MM-YYYY" atau "DD/MM/YYYY"

        // Format: "5 Oktober 1955"
        if (preg_match('/(\d{1,2})\s+(\w+)\s+(\d{4})/i', $dateStr, $matches)) {
            $day = (int)$matches[1];
            $monthName = strtolower($matches[2]);
            $year = (int)$matches[3];

            if (isset($bulanMapping[$monthName])) {
                try {
                    return Carbon::create($year, $bulanMapping[$monthName], $day);
                } catch (\Exception $e) {
                    return null;
                }
            }
        }

        // Format: "DD-MM-YYYY" atau "DD/MM/YYYY"
        if (preg_match('/(\d{1,2})[-\/](\d{1,2})[-\/](\d{4})/', $dateStr, $matches)) {
            $day = (int)$matches[1];
            $month = (int)$matches[2];
            $year = (int)$matches[3];

            try {
                return Carbon::create($year, $month, $day);
            } catch (\Exception $e) {
                return null;
            }
        }

        // Format: "DD Bulan YYYY" dengan penulisan berbeda
        if (preg_match('/(\d{1,2})\s*(\w+)\s*(\d{4})/i', $dateStr, $matches)) {
            $day = (int)$matches[1];
            $monthName = strtolower(trim($matches[2]));
            $year = (int)$matches[3];

            if (isset($bulanMapping[$monthName])) {
                try {
                    return Carbon::create($year, $bulanMapping[$monthName], $day);
                } catch (\Exception $e) {
                    return null;
                }
            }
        }

        return null;
    }

    private function cleanNoKta($value)
    {
        if (empty($value) || $value === '-' || strtolower($value) === 'belum ada') {
            return null;
        }

        // Remove dots and spaces, keep only alphanumeric
        return preg_replace('/[^a-zA-Z0-9]/', '', $value);
    }

    private function parseLamaMengajar($value)
    {
        if (empty($value)) {
            return 1;
        }

        // Extract number from value like "15", "<1th", "1 th", etc.
        if (preg_match('/(\d+)/', $value, $matches)) {
            return max(1, (int)$matches[1]);
        }

        if (stripos($value, '<1') !== false) {
            return 1;
        }

        return 1;
    }

    private function generateUsername($namaLengkap)
    {
        // Remove gelar dan special characters
        $nama = preg_replace('/,.*$/', '', $namaLengkap); // Remove everything after comma
        $nama = preg_replace('/\b(S\.?Pd\.?I?|S\.?H|S\.?E|S\.?Kom|S\.?Si|M\.?M|M\.?Pd|Dra?\.?|Ir\.?|Hj?\.?|A\.?Md\.?|D-?[123]|MMSI)\b/i', '', $nama);
        $nama = preg_replace('/[^a-zA-Z\s]/', '', $nama);
        $nama = trim($nama);

        $parts = preg_split('/\s+/', $nama);
        $parts = array_filter($parts);

        if (count($parts) === 0) {
            $username = 'user' . time() . rand(100, 999);
        } elseif (count($parts) === 1) {
            $username = strtolower($parts[0]);
        } else {
            // Use first name + first letter of last name
            $username = strtolower($parts[0]) . strtolower(substr(end($parts), 0, 1));
        }

        // Ensure unique username
        $baseUsername = Str::slug($username, '');
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }

    private function generateTempNoKtp($userId)
    {
        // Generate temporary KTP number (will need to be updated later)
        return '3275' . str_pad($userId, 12, '0', STR_PAD_LEFT);
    }

    private function generateTempNPSN()
    {
        // Generate unique temp NPSN
        $npsn = 'P' . str_pad(rand(1, 9999999), 7, '0', STR_PAD_LEFT);

        while (LembagaMaster::where('npsn', $npsn)->exists()) {
            $npsn = 'P' . str_pad(rand(1, 9999999), 7, '0', STR_PAD_LEFT);
        }

        return $npsn;
    }

    private function normalizePendidikan($value)
    {
        if (empty($value)) {
            return 'SMA';
        }

        $value = trim(strtoupper($value));

        // Mapping pendidikan
        $mapping = [
            'SD' => 'SD',
            'SMP' => 'SMP',
            'SLTP' => 'SMP',
            'SMA' => 'SMA',
            'SLTA' => 'SMA',
            'SMK' => 'SMA',
            'SMKKN' => 'SMA',
            'SMEA' => 'SMA',
            'SPG' => 'SMA',
            'PGAN' => 'SMA',
            'SMTK' => 'SMA',
            'PAKET C' => 'SMA',
            'D1' => 'D1',
            'D-1' => 'D1',
            'D2' => 'D2',
            'D-2' => 'D2',
            'D3' => 'D3',
            'D-3' => 'D3',
            'D-III' => 'D3',
            'DIII' => 'D3',
            'S1' => 'S1',
            'S-1' => 'S1',
            'SARJANA' => 'S1',
            'S2' => 'S2',
            'S-2' => 'S2',
            'MAGISTER' => 'S2',
            'S3' => 'S3',
            'S-3' => 'S3',
        ];

        foreach ($mapping as $key => $result) {
            if (strpos($value, $key) !== false) {
                return $result;
            }
        }

        return 'SMA';
    }

    private function normalizeKelurahan($alamat)
    {
        $alamat = strtolower($alamat);

        $kelurahanMapping = [
            'aren jaya' => 'Aren Jaya',
            'arenjaya' => 'Aren Jaya',
            'bekasi jaya' => 'Bekasi Jaya',
            'duren jaya' => 'Duren Jaya',
            'durenjaya' => 'Duren Jaya',
            'margahayu' => 'Margahayu',
        ];

        foreach ($kelurahanMapping as $key => $result) {
            if (strpos($alamat, $key) !== false) {
                return $result;
            }
        }

        return 'Aren Jaya'; // Default
    }
}
