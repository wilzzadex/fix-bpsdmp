<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    protected $table = 'satker';
    protected $fillable = [
        'id_parent',
        'nama',
        'slug',
        'deskripsi_id',
        'deskripsi_en'
    ];
}
