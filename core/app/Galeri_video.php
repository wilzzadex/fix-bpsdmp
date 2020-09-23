<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeri_video extends Model
{
    protected $table = 'gallery_video';
    protected $fillable = [
        'judul_id',
        'judul_en',
        'slug',
        'deskripsi_id',
        'deskripsi_en',
        'url_video',
        'user_id',
    ];
}
