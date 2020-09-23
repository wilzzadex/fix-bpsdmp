<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    protected $table = 'sejarah';
    protected $fillable = [
        'deskripsi_id',
        'deskripsi_en',
    ];
}
