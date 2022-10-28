<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function produto(){
        return $this->hasMany('App\Models\Produto');
    }
}