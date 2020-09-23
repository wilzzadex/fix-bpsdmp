<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table = 'alamat';
    protected $fillable = [
        'alamat',
        'email',
        'no_telp',
        'faq',
    ];
}
