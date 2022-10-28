<?php

namespace App\Http\Controllers\Costumer;

use App\Http\Controllers\Controller;
use App\Models\Ccard;
use App\Models\Cliente;
use App\Models\ClienteAssinatura;
use Illuminate\Http\Request;

class AssinaturaController extends Controller
{
    function index(Request $request){
        return view('costumer.assinatura.index');
    }

    function cadastroView(Request $request, $id){
        if(!in_array($id, [1, 2])){return redirect('/');}
        if($request->user() == null){return redirect('/cadastro');}
        
        $tipoAss = $id == 1 ? 'Básico' : 'Personalizado';
        if($id == 2){
            return view('costumer.assinatura.personalizado.cadastro', ['id' => $id, 'tipoAss' => $tipoAss]);
        }

        if($id == 1){
            return redirect('/');
        }
    }

    function cadastrarAssin(Request $request, $id){
        //dd($request->user());
        //dd($request->all());
        $cliente = Cliente::where('id_usuario', $request->user()->id)->first();
        $cAssinExist = ClienteAssinatura::where([['id_cliente', $cliente->id], ['id_assin', $id]])->first();
        if($cAssinExist != null){
            return back()->with([            
                'messageIcon' => 'warning',
                'messageTitle' => 'Aviso',
                'message' => 'Você já possui cadastro nesta assinatura.'
                ]
            );
        }
        //dd($cliente);
        $cAssin = new ClienteAssinatura;
        $cartao = new Ccard;
        $cAssin->sexo = $request->input('sexo');
        $cAssin->alergia = $request->input('alergia');
        $cAssin->observacao = $request->input('observacao');
        $cAssin->id_cliente = $cliente->id;
        $cAssin->id_assin = $id;

        $cliente->id_assin = $id;

        $cartao->nome = $request->input('nome');
        $cartao->numero = $request->input('numero');
        $cartao->dataExp = $request->input('dataExp');
        $cartao->cvv = $request->input('cvv');
        $cartao->id_cliente = $cliente->id;

        $cAssin->save();
        $cartao->save();

        return back()->with([            
            'messageIcon' => 'success',
            'messageTitle' => 'Sucesso',
            'message' => 'Assinatura ativada!'
            ]
        );
    }
}
