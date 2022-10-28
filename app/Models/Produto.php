<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nomeP',
        'desc',
        'valor',
        'id_lab'
    ];

    public function laboratorio(){
        return $this->belongsTo('App\Models\Laboratorio', 'id_lab');
    }

    public function categoriaProduto(){
        return $this->hasMany('App\Models\CategoriaProduto', 'id_produto');
    }
}
