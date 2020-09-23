<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kerja_sama extends Model
{
    protected $table = 'kerja_sama';
    protected $fillable = [
        'nomor',
        'tanggal_kerjasama',
        'uraian',
        'institusi',
        'file',
        'user_id',
    ];
}
