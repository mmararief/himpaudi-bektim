<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumBalasan extends Model
{
    protected $table = 'forum_balasan';

    protected $fillable = [
        'forum_topik_id',
        'user_id',
        'konten',
    ];

    /**
     * Relationships
     */
    public function topik()
    {
        return $this->belongsTo(ForumTopik::class, 'forum_topik_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
