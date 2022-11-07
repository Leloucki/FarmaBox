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
        return $this->belongsTo('App\Models\Cliente', 'id_cliente');
    }

    public function assinatura(){
        return $this->belongsTo('App\Models\Assinatura', 'id_assin');
    }

    public function pedidos(){
        return $this->hasMany('App\Models\Pedido', 'id_cliente_assinatura');
    }
}
