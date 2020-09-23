<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontak';
    protected $fillable = [
        'nama',
        'email',
        'no_telp',
        'subject',
        'isi_pesan',
        'is_read'
    ];
}
