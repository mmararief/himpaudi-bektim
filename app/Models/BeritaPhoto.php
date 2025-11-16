<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaPhoto extends Model
{
    protected $table = 'berita_photos';

    protected $fillable = [
        'berita_id',
        'photo_path',
        'caption',
        'order',
    ];

    /**
     * Relationship
     */
    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
