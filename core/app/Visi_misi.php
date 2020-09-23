<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visi_misi extends Model
{
    protected $table = 'visi_misi';
    protected $fillable = [
        'flag',
        'deskripsi_id',
        'deskripsi_en',
    ];
}
