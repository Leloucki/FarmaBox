<?php

namespace App\Http\Controllers\Costumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

class CadastroController extends Controller
{
    function index(Request $request){
        return view('costumer.cadastro.index');
    }

    function cadastrar(Request $request){        
        if($request->isMethod('post')){            
            $request->merge(['email' => $request->input('emailC')]);
            //dd($request->input('email'));
            $request->validate([
                'email' => ['required', 'email', 'regex:/^[a-z0-9.]+@[a-z0-9]+.[a-z]+.([a-z]+)?$/i'],
            ]);
            //dd($request->all());
            $data = $request->all();
            $result = Usuario::select('email')->where('email', $data['emailC'])->first();
            if(is_null($result)){
                $request->validate([
                    'passwordC' => 'required|min:3|confirmed',
                    'nome' => ['required'],
                    'logradouro' => ['required'],
                    'numero' => ['required'],
                    'celular' => ['regex:"^\(?[1-9]{2}\)? ?(?:[2-8]|9[1-9])[0-9]{3}\-?[0-9]{4}$"'],
                    'bairro' => ['required'],
                    'estado' => ['required'],
                    'pais' => ['required'],
                    'cep' => ['required'],
                    'cpf' => ['required', 'regex:/^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/'],
                    'dtNasc' => 'required|before:-18 years|date_format:d/m/Y'
                ]);
                try{
                    DB::beginTransaction();
                    $cliente = new Cliente;
                    $usuario = new Usuario;
                    $endereco = new Endereco;

                    $usuario->nome = $data['nome'];
                    $usuario->email = $data['emailC'];
                    $usuario->senha = Hash::make($data['passwordC']);
                    $usuario->ativado = true;

                    $endereco->logradouro = $data['logradouro'];
                    $endereco->numero = $data['numero'];
                    $endereco->bairro = $data['bairro'];
                    $endereco->cidade = $data['cidade'];
                    $endereco->estado = $data['estado'];
                    $endereco->pais = $data['pais'];
                    $endereco->cep = $data['cep'];

                    $cliente->celular = $data['celular'];
                    $cliente->cpf = $data['cpf'];
                    $date = str_replace('/', '-', $data['dtNasc']);
                    $time_input = strtotime($date); 
                    $dtNasc = date('Y-m-d',$time_input);
                    $cliente->dtNasc = $dtNasc;

                    $usuario->save();
                    $cliente->id_usuario = $usuario->id;
                    $cliente->save();

                    $endereco->id_cliente = $cliente->id;
                    $endereco->save();

                    event(new Registered($usuario));
                    DB::commit();
                    return back()->with('success', "<p>Cadastrado com sucesso!</p><br><p>Verifique o link enviado ao e-mail $usuario->email para validar a conta.</p>")->withInput();
                } catch(\Throwable $e){
                    DB::rollBack();
                    report($e);
                    return back()->with('error', 'Falha ao cadastrar '. $e->getMessage())->withInput();
                }
                
            } else {
                return back()->with('error', 'E-mail já cadastrado!')->withInput();
            }
        }
        return redirect()->back();
    }
}
