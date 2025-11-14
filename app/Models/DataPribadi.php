<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPribadi extends Model
{
    protected $table = 'data_pribadi';

    protected $fillable = [
        'user_id',
        'niptk_nuptk',
        'no_kta_lama',
        'no_ktp',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'jurusan',
        'gaji',
        'tmt_kerja',
        'riwayat_diklat',
        'alamat_domisili',
        'no_hp',
        'foto_profil',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tmt_kerja' => 'date',
        'riwayat_diklat' => 'array',
        'gaji' => 'decimal:2',
    ];

    /**
     * Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
