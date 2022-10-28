<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'complemento',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'pais',
        'cep'
    ];

    public function cliente(){
        return $this->belongsTo('App\Models\Cliente', 'id_cliente');
    }


}
