<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    protected $table = 'publikasi';
    protected $fillable = [
        'kategori_id',
        'judul_id',
        'judul_en',
        'slug',
        'deskripsi_id',
        'deskripsi_en',
        'tanggal_awal',
        'tanggal_akhir',
        'lokasi',
        'is_youtube',
        'media',
        'is_draft',
        'hit',
        'user_id'
    ];
}
