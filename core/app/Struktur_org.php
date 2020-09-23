<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Struktur_org extends Model
{
    protected $table = 'struktur_org';
    protected $fillable = [
        'id_parent',
        'nama',
        'img',
        'slug'
    ];
}
