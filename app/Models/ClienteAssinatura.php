<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteAssinatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'sexo',
        'alergia',
        'observacao'
    ];

    public function cliente(){
        return $this->hasOne('App\Models\Cliente');
    }

    public function assinatura(){
        return $this->hasOne('App\Models\Assinatura');
    }
}
