<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'pertanyaan' => 'Apa itu HIMPAUDI Bekasi Timur?',
                'jawaban' => 'HIMPAUDI (Himpunan Pendidik dan Tenaga Kependidikan Anak Usia Dini Indonesia) Bekasi Timur adalah organisasi profesi yang mewadahi para pendidik dan tenaga kependidikan PAUD di wilayah Bekasi Timur.',
                'urutan' => 1,
            ],
            [
                'pertanyaan' => 'Siapa yang bisa menjadi anggota HIMPAUDI?',
                'jawaban' => 'Guru, pendidik, dan tenaga kependidikan yang bekerja di lembaga PAUD (Pendidikan Anak Usia Dini) di wilayah Bekasi Timur dapat menjadi anggota HIMPAUDI.',
                'urutan' => 2,
            ],
            [
                'pertanyaan' => 'Bagaimana cara mendaftar sebagai anggota?',
                'jawaban' => 'Anda dapat mendaftar melalui website ini dengan mengisi formulir pendaftaran. Setelah mendaftar, data Anda akan diverifikasi oleh admin. Jika disetujui, Anda akan mendapatkan akses ke sistem.',
                'urutan' => 3,
            ],
            [
                'pertanyaan' => 'Berapa lama proses verifikasi pendaftaran?',
                'jawaban' => 'Proses verifikasi biasanya memakan waktu 1-3 hari kerja. Anda akan mendapatkan notifikasi melalui email setelah akun Anda disetujui.',
                'urutan' => 4,
            ],
            [
                'pertanyaan' => 'Apa saja syarat menjadi anggota?',
                'jawaban' => 'Syarat menjadi anggota meliputi: memiliki NIPTK/NUPTK atau dokumen identitas pendidik, bekerja di lembaga PAUD yang berada di wilayah Bekasi Timur, dan mengisi formulir pendaftaran dengan lengkap.',
                'urutan' => 5,
            ],
            [
                'pertanyaan' => 'Apakah ada biaya keanggotaan?',
                'jawaban' => 'Untuk informasi terkait biaya keanggotaan, silakan hubungi pengurus HIMPAUDI Bekasi Timur melalui kontak yang tersedia di website.',
                'urutan' => 6,
            ],
            [
                'pertanyaan' => 'Apa saja manfaat menjadi anggota HIMPAUDI?',
                'jawaban' => 'Manfaat menjadi anggota antara lain: akses ke pelatihan dan workshop, networking dengan sesama pendidik PAUD, informasi terkini tentang dunia pendidikan anak usia dini, dan sertifikasi kegiatan.',
                'urutan' => 7,
            ],
            [
                'pertanyaan' => 'Bagaimana cara menghubungi pengurus HIMPAUDI?',
                'jawaban' => 'Anda dapat menghubungi pengurus melalui email, telepon, atau datang langsung ke sekretariat HIMPAUDI Bekasi Timur. Informasi kontak dapat ditemukan di halaman kontak website.',
                'urutan' => 8,
            ],
        ];

        foreach ($faqs as $faq) {
            \App\Models\Faq::create($faq);
        }
    }
}
