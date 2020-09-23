<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';
    protected $fillable = [
        'pertanyaan_id',
        'pertanyaan_en',
        'jawaban_id',
        'jawaban_en'
    ];
}
