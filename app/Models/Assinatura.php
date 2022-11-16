<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function clienteAssinatura(){
        return $this->hasMany('App\Models\ClienteAssinatura', 'id_assin');
    }

}
