<?php

namespace App\Imports;

use App\Models\LembagaMaster;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LembagaMastersImport
{
    protected $imported = 0;
    protected $updated = 0;
    protected $skipped = 0;
    protected $errors = [];

    /**
     * Import from CSV file
     * Expected columns: Nama Sekolah, NPSN, Alamat, Nama Kepala Sekolah, 
     * Jumlah Guru, Jumlah Siswa, Akreditasi, Tahun Akreditasi Terakhir
     */
    public function import($filePath)
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File tidak ditemukan");
        }

        // Read file content and remove BOM if exists
        $content = file_get_contents($filePath);
        $content = preg_replace('/^\xEF\xBB\xBF/', '', $content); // Remove UTF-8 BOM

        // Create temporary file without BOM
        $tempFile = tempnam(sys_get_temp_dir(), 'csv');
        file_put_contents($tempFile, $content);

        $handle = fopen($tempFile, 'r');
        if (!$handle) {
            throw new \Exception("Tidak dapat membuka file");
        }

        // Auto-detect header row within the first 10 lines
        $headerMap = [];
        $rowNumber = 0;
        for ($i = 1; $i <= 10; $i++) {
            $probe = fgetcsv($handle);
            if ($probe === false) break;
            $rowNumber = $i;
            // Build temporary normalized map
            $tempMap = [];
            foreach ($probe as $idx => $h) {
                $cleaned = trim((string)$h);
                if ($cleaned !== '') {
                    $tempMap[$idx] = $this->normalizeHeader($cleaned);
                }
            }
            // Consider it a header row if it contains any expected key
            $keys = array_values($tempMap);
            if (in_array('nama_sekolah', $keys) || in_array('npsn', $keys) || in_array('alamat', $keys)) {
                $headerMap = $tempMap;
                break;
            }
        }

        if (empty($headerMap)) {
            fclose($handle);
            unlink($tempFile);
            throw new \Exception('Tidak menemukan header yang valid dalam 10 baris pertama');
        }

        Log::info('CSV Header Map (auto-detected):', $headerMap);

        // Process data rows (continue reading after header line)
        while (($data = fgetcsv($handle)) !== false) {
            $rowNumber++;

            // Skip if all cells are empty
            if (empty(array_filter($data))) {
                continue;
            }

            // Map data to named array
            $row = [];
            foreach ($headerMap as $index => $key) {
                $row[$key] = $data[$index] ?? '';
            }

            $this->processRow($row);
        }

        fclose($handle);
        unlink($tempFile);
    }

    protected function normalizeHeader($header)
    {
        $normalized = trim($header);
        // Remove brackets and special characters
        $normalized = preg_replace('/[()\/]/', '', $normalized);
        // Replace multiple spaces with single space
        $normalized = preg_replace('/\s+/', ' ', $normalized);
        // Replace spaces with underscores and lowercase
        $normalized = strtolower(str_replace(' ', '_', $normalized));
        return $normalized;
    }

    /**
     * Process a single row
     */
    protected function processRow(array $row)
    {
        try {
            // Try different possible column names for nama_sekolah
            $namaSekolah = $row['nama_sekolah'] ?? null;

            // If not found, try the first non-empty value (usually the school name)
            if (empty($namaSekolah)) {
                foreach ($row as $key => $value) {
                    if (!empty($value) && !is_numeric($value) && strlen($value) > 2) {
                        $namaSekolah = $value;
                        break;
                    }
                }
            }

            if (empty($namaSekolah) || strtolower(trim($namaSekolah)) === 'contoh') {
                $this->skipped++;
                return;
            }

            $npsn = $row['npsn'] ?? null;

            // Check if already exists by NPSN or nama_sekolah
            $existing = null;
            if (!empty($npsn)) {
                $existing = LembagaMaster::where('npsn', $npsn)->first();
            }

            if (!$existing && !empty($namaSekolah)) {
                $existing = LembagaMaster::where('nama_sekolah', $namaSekolah)->first();
            }

            // Handle akreditasi field with variations
            $akreditasiRaw = $row['akreditasi_diisi_a_b_c']
                ?? $row['akreditasi_d_iisi_a__b__c']
                ?? $row['akreditasi']
                ?? null;
            $akreditasi = strtoupper(trim($akreditasiRaw ?? ''));
            if (!in_array($akreditasi, ['A', 'B', 'C', '-'])) {
                $akreditasi = null;
            }
            // Fallback: scan row values if still null
            if ($akreditasi === null) {
                foreach ($row as $val) {
                    $v = strtoupper(trim($val));
                    if (in_array($v, ['A', 'B', 'C', '-'])) {
                        $akreditasi = $v;
                        break;
                    }
                }
            }

            // Tahun Akreditasi raw
            $tahunAkreditasiRaw = $row['tahun_akreditasi'] ?? $row['tahun_akreditasi_terakhir'] ?? null;
            $tahunAkreditasi = null;
            if (!empty($tahunAkreditasiRaw)) {
                $tahunAkreditasiRaw = trim($tahunAkreditasiRaw);
                if (preg_match('/^(19|20)\d{2}$/', $tahunAkreditasiRaw)) {
                    $tahunAkreditasi = (int) $tahunAkreditasiRaw;
                }
            }
            // Fallback: scan for year pattern if still null
            if ($tahunAkreditasi === null) {
                foreach ($row as $val) {
                    $valTrim = trim($val);
                    if (preg_match('/^(19|20)\d{2}$/', $valTrim)) {
                        $tahunAkreditasi = (int)$valTrim;
                        break;
                    }
                }
            }

            $data = [
                'nama_sekolah' => $namaSekolah,
                'npsn' => $npsn,
                'alamat' => $row['alamat'] ?? null,
                'nama_kepala_sekolah' => $row['nama_kepala_sekolah'] ?? null,
                'jumlah_guru' => !empty($row['jumlah_guru']) ? (int) $row['jumlah_guru'] : null,
                'jumlah_siswa' => !empty($row['jumlah_siswa']) ? (int) $row['jumlah_siswa'] : null,
                'akreditasi' => $akreditasi,
                'tahun_akreditasi' => $tahunAkreditasi,
            ];

            if ($existing) {
                $existing->update($data);
                $this->updated++;
                return null;
            }

            LembagaMaster::create($data);
            $this->imported++;
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
            $this->skipped++;
        }
    }

    public function getImported(): int
    {
        return $this->imported;
    }

    public function getUpdated(): int
    {
        return $this->updated;
    }

    public function getSkipped(): int
    {
        return $this->skipped;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
