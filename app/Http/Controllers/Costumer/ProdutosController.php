<?php

namespace App\Http\Controllers\Costumer;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Pedido;
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
        $cliente = Cliente::select('id')->where('id_usuario', Auth::user()->id)->first();
        if($cliente->clienteAssinatura == null){
            return  ['icon' => 'warning', 'message' => 'Assine algum de nossos planos primeiro!'];
        }
        $pedidoExist = Pedido::where([['id_cliente_assinatura', $cliente->clienteAssinatura->id], ['id_produto', $id_produto]])->first();
        //dd($pedidoExist);
        if($pedidoExist){
            return  ['icon' => 'warning', 'message' => 'Produto já existente na assinatura!'];
        }

        $pedido = new Pedido;
        $pedido->id_produto = $id_produto;
        $pedido->id_cliente_assinatura = $cliente->clienteAssinatura->id;
        $pedido->quantidade = 1;
        $pedido->save();

        $qtdPC = Pedido::where('id_cliente_assinatura', $cliente->clienteAssinatura->id)->count();
        $html = view('costumer.layout.qtdProduto', ['qtdPC' => $qtdPC])->render();
        return ['icon' => 'success', 'message' => 'Produto inserido a assinatura!', 'html' => $html];
    }

    function inserirClienteProduto2(Request $request){
        $request->validate([
            'id_produto' => ['required', 'integer'],
            'quantidade' => ['required', 'integer']
        ]);

        $id_produto = $request->input('id_produto');
        $qtd = $request->input('quantidade');
        $cliente = Cliente::select('id')->where('id_usuario', Auth::user()->id)->first();
        if($cliente->clienteAssinatura == null){
            return back()->with(['messageIcon' => 'warning', 'messageTitle' => 'Ops...', 'message' => 'Assine algum de nossos planos primeiro!']);
        }
        $pedidoExist = Pedido::where([['id_cliente_assinatura', $cliente->clienteAssinatura->id], ['id_produto', $id_produto]])->first();
        //dd($pedidoExist);
        if($pedidoExist){
            return back()->with(['messageIcon' => 'warning', 'messageTitle' => 'Ops...', 'message' => 'Produto já existente na assinatura!']);
        }

        $pedido = new Pedido;
        $pedido->id_produto = $id_produto;
        $pedido->id_cliente_assinatura = $cliente->clienteAssinatura->id;
        $pedido->quantidade = $qtd;
        $pedido->save();

        return back()->with(['messageIcon' => 'success', 'messageTitle' => 'Sucesso', 'message' => 'Produto inserido a assinatura!']);
    }

    function produto(Request $request, $id){
        if(is_numeric($id)){           
            $produto = Produto::where('id', $id)->first();
            if($produto){
                $categoriasP = $produto->categoriaProduto()->get();
                $produtos = Produto::select('produtos.*')->join('categoria_produtos', 'produtos.id', '=','categoria_produtos.id_produto')
                ->where('produtos.id', '!=', $produto->id);
                $i = 0;
                foreach($categoriasP as $categoria){
                    if($i == 0){
                        $i++;
                        $produtos = $produtos->where('categoria_produtos.id_categoria', $categoria->id_categoria);
                    }else{
                        $produtos = $produtos->orWhere('categoria_produtos.id_categoria', $categoria->id_categoria);
                    }            
                }
                
                return view('costumer.produto.detalhes', [
                'produto' => $produto, 
                'produtos' => $i == 1 ? $produtos->get() : null
                ]);
            }
        }

        return back()->with(['messageIcon' => 'warning', 'messageTitle' => 'Ops...', 'message' => 'Produto não encontrado']);
    }
}
