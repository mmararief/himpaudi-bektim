<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaComment extends Model
{
    protected $table = 'berita_comments';

    protected $fillable = [
        'berita_id',
        'user_id',
        'comment',
    ];

    /**
     * Relationship
     */
    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
