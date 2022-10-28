<?php

namespace App\Http\Controllers\Costumer;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\ProdutosCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutosController extends Controller
{
    function index(Request $request){
        $produtos = new Produto;
        $categorias = Categoria::get();
        if($request->has('search')){
            $produtos = $produtos->where('produtos.nome', 'like', '%'.$request->get('search').'%');
        }

        if($request->has('categoria')){
            if($request->get('categoria') != 0){                        
                $produtos = $produtos->select('produtos.*')
                ->join('categoria_produtos', 'produtos.id', '=', 'categoria_produtos.id_produto')
                ->join('categorias', 'categoria_produtos.id_categoria', '=', 'categorias.id')
                ->where('categoria_produtos.id_categoria', $request->get('categoria'));  
            }
        }

        return view('costumer.produto.index', ['produtos' => $produtos->paginate(9), 'categorias' => $categorias]);
    }

    function inserirClienteProduto(Request $request){
        $id_produto = $request->input('id_produto');
        $id_cliente = Cliente::select('id')->where('id_usuario', Auth::user()->id)->first()->id;
        $produtoExist = ProdutosCliente::where([['id_cliente', $id_cliente], ['id_produto', $id_produto]])->first();
        //dd($produtoExist);
        if($produtoExist){
            return  ['icon' => 'warning', 'message' => 'Produto já existente na assinatura!'];
        }

        $produtoC = new ProdutosCliente;
        $produtoC->id_produto = $id_produto;
        $produtoC->id_cliente = $id_cliente;
        $produtoC->quantidade = 1;
        $produtoC->save();

        return ['icon' => 'success', 'message' => 'Produto inserido a assinatura!'];
    }
}
