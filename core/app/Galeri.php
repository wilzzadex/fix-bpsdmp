<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'gallery';
    protected $fillable = [
        'relasi',
        'relasi_id',
        'img',
        'judul_id',
        'judul_en',
    ];

   
    
}
