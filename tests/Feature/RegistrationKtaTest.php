<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\DataPribadi;

uses(RefreshDatabase::class);

it('saves no_kta_lama during registration', function () {
    $payload = [
        'username' => 'user' . uniqid(),
        'email' => 'user' . uniqid() . '@example.com',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
        // Data Pribadi
        'nama_lengkap' => 'Nama Lengkap',
        'niptk_nuptk' => null,
        'no_kta_lama' => 'KTA-TEST-001',
        'no_ktp' => '1234567890123456',
        'tempat_lahir' => 'Jakarta',
        'tanggal_lahir' => '1990-01-01',
        'jenis_kelamin' => 'Laki-laki',
        'pendidikan_terakhir' => 'S1',
        'tmt_kerja' => '2020-01-01',
        'alamat_domisili' => 'Alamat Domisili',
        'no_hp' => '081234567890',
        // Data Lembaga
        'nama_lembaga' => 'PAUD Test',
        'npsn' => '12345678',
    ];

    $response = $this->post('/register', $payload);

    $response->assertRedirect('/login');

    $this->assertDatabaseHas('data_pribadi', [
        'no_kta_lama' => 'KTA-TEST-001',
        'no_ktp' => '1234567890123456',
        'nama_lengkap' => 'Nama Lengkap',
    ]);
});
