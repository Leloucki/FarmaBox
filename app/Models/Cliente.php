<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'celular',
        'cpf',
        'dtNasc'
    ];

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'id_usuario');
    }

    public function endereco()
    {
        return $this->hasOne('App\Models\Endereco', 'id_cliente');
    }

    public function clienteAssinatura()
    {
        return $this->hasOne('App\Models\ClienteAssinatura', 'id_cliente');
    }
}
