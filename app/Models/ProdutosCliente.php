<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosCliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantidade',
        'id_produto',
        'id_cliente'
    ];

    public function cliente(){
        return $this->hasOne('App\Models\Cliente', 'id_cliente');
    }

    public function produto(){
        return $this->hasOne('App\Models\Produto', 'id_produto');
    }
}
