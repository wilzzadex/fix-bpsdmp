<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matra extends Model
{
    protected $table = 'master_matra';

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class,'id_matra');
    }
}
