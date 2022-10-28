<?php

namespace App\Http\Controllers\Costumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;

class CadastroController extends Controller
{
    function index(Request $request){
        return view('costumer.cadastro.index');
    }

    function cadastrar(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'emailC' => ['required', 'email'],
                'passwordC' => 'required|min:3|confirmed',
            ]);

            $data = $request->all();
            $result = Usuario::select('email')->where('email', $data['emailC'])->first();
            if(is_null($result)){
                $cliente = new Cliente;
                $usuario = new Usuario;
                $endereco = new Endereco;

                $usuario->nome = $data['nome'];
                $usuario->email = $data['emailC'];
                $usuario->senha = Hash::make($data['passwordC']);
                $usuario->ativado = true;

                $endereco->logradouro = $data['logradouro'] ?? '';
                $endereco->numero = $data['numero'] ?? '';
                $endereco->bairro = $data['bairro'] ?? '';
                $endereco->cidade = $data['cidade'] ?? '';
                $endereco->estado = $data['estado'] ?? '';
                $endereco->pais = $data['pais'] ?? '';
                $endereco->cep = $data['cep'] ?? '';

                $cliente->celular = $data['celular'] ?? '';
                $cliente->cpf = $data['cpf'];

                $usuario->save();
                $cliente->id_usuario = $usuario->id;
                $cliente->save();

                $endereco->id_cliente = $cliente->id;
                $endereco->save();

                event(new Registered($usuario));

                return redirect()->back()->with('success', "<p>Cadastrado com sucesso!</p><br><p>Verifique o link enviado ao e-mail $usuario->email para validar a conta.</p>");
            } else {
                return redirect()->back()->with('error', 'E-mail já cadastrado!');
            }
        }
        return redirect()->back();
    }
}
