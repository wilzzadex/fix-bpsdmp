<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas_fungsi extends Model
{
    protected $table = 'tugas_fungsi';
    protected $fillable = [
        'flag',
        'deskripsi_id',
        'deskripsi_en',
    ];
}
