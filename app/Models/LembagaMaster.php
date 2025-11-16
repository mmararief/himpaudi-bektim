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
        'email_pic',
        'no_hp_pic',
        'nama_pic',
        'status',
        'rejection_reason',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'jumlah_guru' => 'integer',
        'jumlah_siswa' => 'integer',
        'tahun_akreditasi' => 'integer',
        'approved_at' => 'datetime',
    ];

    /**
     * Scope for approved lembaga only
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for pending lembaga
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

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

    /**
     * Check if lembaga is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if lembaga is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if lembaga is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
