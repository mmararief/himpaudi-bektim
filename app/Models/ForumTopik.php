<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ForumTopik extends Model
{
    protected $table = 'forum_topik';

    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'konten',
        'views',
        'is_pinned',
        'is_locked',
    ];

    protected $casts = [
        'views' => 'integer',
        'is_pinned' => 'boolean',
        'is_locked' => 'boolean',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($topik) {
            if (empty($topik->slug)) {
                $topik->slug = Str::slug($topik->judul);
            }
        });

        static::updating(function ($topik) {
            if ($topik->isDirty('judul')) {
                $topik->slug = Str::slug($topik->judul);
            }
        });
    }

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balasan()
    {
        return $this->hasMany(ForumBalasan::class);
    }

    /**
     * Scope queries
     */
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }

    public function scopeNotLocked($query)
    {
        return $query->where('is_locked', false);
    }

    /**
     * Increment views
     */
    public function incrementViews()
    {
        $this->increment('views');
    }
}
