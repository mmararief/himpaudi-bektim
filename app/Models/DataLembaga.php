<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataLembaga extends Model
{
    protected $table = 'data_lembaga';

    protected $fillable = [
        'user_id',
        'npsn',
        'nama_lembaga',
        'alamat_lembaga',
        'kelurahan',
        'kecamatan',
        'kota',
        'no_telp_lembaga',
        'email_lembaga',
        'lembaga_master_id',
    ];

    /**
     * Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lembagaMaster()
    {
        return $this->belongsTo(LembagaMaster::class, 'lembaga_master_id');
    }

    /**
     * Get kelurahan options
     */
    public static function getKelurahanOptions()
    {
        return [
            'Aren Jaya',
            'Bekasi Jaya',
            'Duren Jaya',
            'Margahayu',
        ];
    }
}
