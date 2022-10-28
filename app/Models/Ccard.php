<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ccard extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'numero',
        'dataExp',
        'cvv'
    ];

    function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
}
