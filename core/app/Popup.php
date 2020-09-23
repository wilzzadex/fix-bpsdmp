<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $table = 'master_popup';
    protected $fillable = [
        'nama_file',
        'file',
        'is_active'
    ];
}
