<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('user can upload profile photo via profile update', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    $file = UploadedFile::fake()->create('avatar.jpg', 20, 'image/jpeg');

    $payload = [
        'nama_lengkap' => 'Nama Lengkap',
        'niptk_nuptk' => null,
        'no_kta_lama' => null,
        'no_ktp' => '3275010101010001',
        'tempat_lahir' => 'Bekasi',
        'tanggal_lahir' => '1990-01-01',
        'jenis_kelamin' => 'Laki-laki',
        'pendidikan_terakhir' => 'S1',
        'jurusan' => 'PG-PAUD',
        'gaji' => 0,
        'tmt_kerja' => '2020-01-01',
        'riwayat_diklat' => ['Dasar'],
        'alamat_domisili' => 'Jl. Contoh No. 1',
        'no_hp' => '08123456789',
        'foto_profil' => $file,
    ];

    $response = $this
        ->actingAs($user)
        ->patch(route('profile.data-pribadi.update'), $payload);

    $response->assertRedirect(route('profile.edit'));
    $response->assertSessionHas('status', 'data-pribadi-updated');

    $user->refresh();
    $this->assertNotNull($user->dataPribadi);
    $this->assertNotNull($user->dataPribadi->foto_profil);

    // Assert file exists in fake storage
    Storage::disk('public')->assertExists($user->dataPribadi->foto_profil);
});
