<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_produto',
        'id_categoria'
    ];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto', 'id_produto');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'id_categoria');
    }
}
