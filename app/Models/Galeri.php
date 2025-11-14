<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'judul_kegiatan',
        'file_gambar',
        'deskripsi',
        'tanggal_kegiatan',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    /**
     * Scope queries
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('tanggal_kegiatan', 'desc');
    }
}
