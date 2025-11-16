<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LembagaMaster extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'alamat',
        'nama_kepala_sekolah',
        'jumlah_guru',
        'jumlah_siswa',
        'akreditasi',
        'tahun_akreditasi',
        'foto_sekolah',
        // Removed status-related fields
    ];

    protected $casts = [
        'jumlah_guru' => 'integer',
        'jumlah_siswa' => 'integer',
        'tahun_akreditasi' => 'integer',
        'approved_at' => 'datetime',
    ];


    /**
     * Relationship to users (anggota dari lembaga ini)
     */
    public function dataLembaga()
    {
        return $this->hasMany(DataLembaga::class, 'lembaga_master_id');
    }

    /**
     * Admin who approved this lembaga
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Status helpers removed (status column deleted)
}
