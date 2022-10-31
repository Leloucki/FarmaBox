<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{    
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produtos_clientes';

    protected $fillable = [
        'quantidade',
        'id_produto',
        'id_cliente'
    ];

    public function cliente(){
        return $this->belongsTo('App\Models\Cliente', 'id_cliente');
    }

    public function produto(){
        return $this->belongsTo('App\Models\Produto', 'id_produto');
    }
}
