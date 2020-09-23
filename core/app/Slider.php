<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
    protected $fillable = [
        'judul_id',
        'judul_en',
        'img'
    ];
}
