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
        'lembaga_master_id',
        'jabatan',
        'kelurahan',
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
}
