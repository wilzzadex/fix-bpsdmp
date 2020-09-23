<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';
    protected $fillable = [
        'id_matra',
        'nama',
        'slug',
        'singkatan',
        'alamat',
        'email',
        'no_telp',
        'website',
        'logo',
        'deskripsi_id',
        'deskripsi_en',
        'user_id',
    ];

    public function matra()
    {
        return $this->belongsTo(Matra::class,'id_matra');
    }

}
