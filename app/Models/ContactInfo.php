<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'contact_info';

    protected $fillable = [
        'alamat',
        'email',
        'telepon',
        'whatsapp',
        'maps_embed',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
