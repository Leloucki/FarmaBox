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
        return $this->belongsTo('App\Models\Cliente');
    }

    public function assinatura(){
        return $this->belongsTo('App\Models\Assinatura');
    }
}
