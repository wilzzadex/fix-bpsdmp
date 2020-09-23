<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regulasi extends Model
{
    protected $table = 'regulasi';
    protected $fillable = [
        'tahun',
        'tipe_peraturan',
        'nomor_peraturan',
        'tentang',
        'file',
        'user_id',
    ];
}
