<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\VisiMisi::create([
            'visi' => 'Menjadi organisasi profesi pendidik PAUD yang unggul, profesional, dan berdaya saing dalam mengembangkan pendidikan anak usia dini di wilayah Bekasi Timur.',
            'misi' => "1. Meningkatkan kompetensi dan profesionalisme pendidik PAUD melalui pelatihan dan pengembangan berkelanjutan.\n2. Membangun jaringan kerjasama yang kuat antara lembaga PAUD, pemerintah, dan masyarakat.\n3. Mewadahi aspirasi dan kepentingan para pendidik PAUD di Bekasi Timur.\n4. Mengadvokasi kebijakan pendidikan yang mendukung perkembangan optimal anak usia dini.\n5. Menyelenggarakan kegiatan inovatif dan kreatif untuk meningkatkan kualitas layanan PAUD.",
            'is_active' => true,
        ]);
    }
}
