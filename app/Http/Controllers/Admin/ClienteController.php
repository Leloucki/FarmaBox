<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Rules\Cpf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index(Request $request){
        $clientes = $this->getclientes($request);
        //dd($cliente->clienteAssinatura());
        return view('adminV.clientes.index', ['clientes' => $clientes->paginate(5)]);
    }

    public function getClientes($request){
        $clientes = new Cliente;
        if($request->has('cpfSearch')){
            $clientes = $clientes->where('cpf', 'like', '%'.$request->get('cpfSearch').'%');
        }
        return $clientes;
    }

    public function editarView(Request $request){
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        $cliente = Cliente::where('id', $request->get('id'))->first();

        if($cliente){
            return view('adminV.clientes.editar', ['cliente' => $cliente]);
        }
        
        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Cliente não encontrado',
            'messageIcon' => 'warning'
        ]);
    }

    public function editar(Request $request){
        $request->validate([
            'id_cliente' => ['required', 'integer'],
            'nome' => ['required'],
            'email' => ['required', 'email'],
            'celular' => ['regex:"^\(?[1-9]{2}\)? ?(?:[2-8]|9[1-9])[0-9]{3}\-?[0-9]{4}$"'],
            'dtNasc' => 'required|before:-18 years|date_format:d/m/Y',
            'cpf' => ['required', new Cpf],
            'logradouro' => ['required'],
            'numero' => ['required'],
            'bairro' => ['required'],
            'cidade' => ['required'],
            'pais' => ['required'],
            'cep' => ['required']
        ]);

        $cliente = Cliente::where('id', $request->input('id_cliente'))->first();
        if($cliente){
            try {
                DB::beginTransaction();
                $cliente->usuario->nome = $request->input('nome');
                $cliente->usuario->email = $request->input('email');
                $cliente->celular = $request->input('celular');
                $date = str_replace('/', '-', $request->input('dtNasc'));
                $time_input = strtotime($date);
                $dtNasc = date('Y-m-d',$time_input);
                $cliente->dtNasc = $dtNasc;
                $cliente->cpf = $request->input('cpf');            
                $cliente->endereco->logradouro = $request->input('logradouro');
                $cliente->endereco->numero = $request->input('numero');
                $cliente->endereco->bairro = $request->input('bairro');
                $cliente->endereco->pais = $request->input('pais');
                $cliente->endereco->cep = $request->input('cep');
                $cliente->push(); 
                DB::commit();

                return back()->with([
                    'messageTitle' => 'Sucesso',
                    'message' => 'Cliente atualizado',
                    'messageIcon' => 'success'
                ]);

            } catch (\Throwable $th) {
                DB::rollBack();
                report($th);
                return back()->with([
                    'messageTitle' => 'Ops...',
                    'message' => 'Erro ao atualizar cliente',
                    'messageIcon' => 'error'
                ]);
            }                      
        }
        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Cliente não encontrado',
            'messageIcon' => 'warning'
        ]);
    }

    public function desativar(Request $request){    
        $request->validate([
            'idCliente' => ['required', 'integer']
        ]);

        $cliente = Cliente::where('id', $request->input('idCliente'))->first();
        if($cliente){
            if($cliente->usuario->ativado){
                try {
                    DB::beginTransaction();
                    $cliente->usuario->ativado = false;
                    $cliente->push();
                    DB::commit();
                    return back()->with([
                        'messageTitle' => 'Sucesso',
                        'message' => 'Cliente desativado',
                        'messageIcon' => 'success'
                    ]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    report($th);
                    return back()->with([
                        'messageTitle' => 'Ops...',
                        'message' => 'Erro ao desativar cliente',
                        'messageIcon' => 'error'
                    ]);
                }
            }
            return back()->with([
                'messageTitle' => 'Ops...',
                'message' => 'Cliente encontra-se desativado',
                'messageIcon' => 'warning'
            ]);
        }

        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Cliente não encontrado',
            'messageIcon' => 'warning'
        ]);
    }

    public function ativar(Request $request){
        $request->validate([
            'idCliente' => ['required', 'integer']
        ]);

        $cliente = Cliente::where('id', $request->input('idCliente'))->first();
        if($cliente){
            if(!($cliente->usuario->ativado)){
                try {
                    DB::beginTransaction();
                    $cliente->usuario->ativado = true;
                    $cliente->push();
                    DB::commit();
                    return back()->with([
                        'messageTitle' => 'Sucesso',
                        'message' => 'Cliente ativado',
                        'messageIcon' => 'success'
                    ]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    report($th);
                    return back()->with([
                        'messageTitle' => 'Ops...',
                        'message' => 'Erro ao ativar cliente',
                        'messageIcon' => 'error'
                    ]);
                }
            }
            return back()->with([
                'messageTitle' => 'Ops...',
                'message' => 'Cliente encontra-se ativo',
                'messageIcon' => 'warning'
            ]);
        }

        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Cliente não encontrado',
            'messageIcon' => 'warning'
        ]);
    }

}
