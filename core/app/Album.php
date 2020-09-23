<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album';
    protected $fillable = [
        'judul_id',
        'judul_en',
        'slug',
        'user_id',
    ];
}
