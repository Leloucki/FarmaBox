<?php

namespace App\Http\Controllers\Costumer;

use App\Http\Controllers\Controller;
use App\Models\Ccard;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\ProdutosCliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    function index(Request $request){
        $cliente = Cliente::join('usuarios', 'id_usuario', 'usuarios.id')
        ->where('id_usuario', Auth::user()->id)->first();
        $endereco = $cliente->endereco()->first();
        return view('costumer.perfil.minhaConta',
        [
        'cliente' => $cliente,
        'endereco' => $endereco,
        ]
        );
    }

    function pagamento(Request $request){
        $cliente = Cliente::join('usuarios', 'id_usuario', 'usuarios.id')
        ->where('id_usuario', Auth::user()->id)->first();
        $cartao = Ccard::where('id_cliente', $cliente->id)->first();
        return view('costumer.perfil.pagamento',
        [
        'cartao' => $cartao,
        ]
        );
    }

    function produtos(Request $request){
        $cliente = Cliente::join('usuarios', 'id_usuario', 'usuarios.id')
        ->where('id_usuario', Auth::user()->id)->first();
        $produtosCli = ProdutosCliente::where('id_cliente', $cliente->id)->get();
        return view('costumer.perfil.produtos',
        [
        'produtosCli' => $produtosCli,
        ]
        );
    }

    function salvarProdutos(Request $request){
        $produtos = $request->input('produtos');
        $cliente = Cliente::where('id_usuario', Auth::user()->id)->first();
        ProdutosCliente::where('id_cliente', $cliente->id)->delete();
        if($produtos != null){
            foreach($produtos as $produto){
                //dd($produto);
                $produtosCli = new ProdutosCliente;
                $produtosCli->quantidade = $produto['quantidade'];
                $produtosCli->id_produto = $produto['id'];
                $produtosCli->id_cliente = $cliente->id;
                $produtosCli->save();
            }
        }

        return back()->with(['messageIcon' => 'success', 'messageTitle' => 'Sucesso', 'message' => 'Dados salvos!']);
    }

    function salvarPagamento(Request $request){
        $cliente = Cliente::where('id_usuario', Auth::user()->id)->first();

        $nomeC = $request->input('nomeC');
        $numeroC = $request->input('numeroC');
        $dataExpC = $request->input('dataExpC');
        $cvvC = $request->input('cvvC');

        $cartao = Ccard::where('id_cliente', $cliente->id)->first();
        $cartao->nome = $nomeC;
        $cartao->numero = $numeroC;
        $cartao->dataExp = $dataExpC;
        $cartao->cvv = $cvvC;
        $cartao->save();

        return back()->with(['messageIcon' => 'success', 'messageTitle' => 'Sucesso', 'message' => 'Dados salvos!']);
    }

    function salvarConta(Request $request){
        //dd($request->all());        
        $nome = $request->input('nomeP');
        $email = $request->input('emailP');
        $celular = $request->input('celularP');
        $cpf = $request->input('cpfP');
        $lougradouro = $request->input('lougradouro');
        $cep = $request->input('cep');
        $numero = $request->input('numero');
        $cidade = $request->input('cidade');
        $estado = $request->input('estado');
        $pais = $request->input('pais');
        
        $cliente = Cliente::where('id_usuario', Auth::user()->id)->first();
        $cliente->usuario->nome = $nome;
        $cliente->usuario->email = $email;
        $cliente->celular = $celular;
        $cliente->cpf = $cpf;
        $cliente->usuario->save();
        $cliente->save();

        $endereco = Endereco::where('id_cliente', $cliente->id)->first();
        $endereco->logradouro = $lougradouro;
        $endereco->cep = $cep;
        $endereco->numero = $numero;
        $endereco->cidade = $cidade;
        $endereco->estado = $estado;
        $endereco->pais = $pais;
        $endereco->save();

        return back()->with(['messageIcon' => 'success', 'messageTitle' => 'Sucesso', 'message' => 'Dados salvos!']);
    }
}
