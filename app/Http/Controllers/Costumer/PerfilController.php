<?php

namespace App\Http\Controllers\Costumer;

use App\Http\Controllers\Controller;
use App\Models\Ccard;
use App\Models\Cliente;
use App\Models\ClienteAssinatura;
use App\Models\Endereco;
use App\Models\Pedido;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    function getCliente(){
        return Cliente::join('usuarios', 'id_usuario', 'usuarios.id')
        ->where('id_usuario', Auth::user()->id)->first();
    }

    function index(Request $request){
        $cliente = $this->getCliente();
        $endereco = $cliente->endereco()->first();
        $cliente = Cliente::where('id_usuario', Auth::user()->id)->first();
        $clienteAssin = ClienteAssinatura::where('id_cliente', $cliente->id)->first();        
        return view('costumer.perfil.minhaConta',
        [
        'cliente' => $cliente,
        'endereco' => $endereco,
        'clienteAssin' => $clienteAssin
        ]
        );
    }

    function pagamento(Request $request){
        $cliente = $this->getCliente();
        $cartao = Ccard::where('id_cliente', $cliente->id)->first();
        $clienteAssin = ClienteAssinatura::where('id_cliente', $cliente->id)->first();  
        return view('costumer.perfil.pagamento',
        [
        'cartao' => $cartao,
        'clienteAssin' => $clienteAssin,
        ]
        );
    }

    function assinatura(Request $request){
        $cliente = $this->getCliente();
        $clienteAssin = ClienteAssinatura::where('id_cliente', $cliente->id)->first();  
        $pedidos = $clienteAssin->pedidos()->get();
        return view('costumer.perfil.produtos',
        [
        'pedidos' => $pedidos,
        'clienteAssin' => $clienteAssin,
        ]
        );
    }

    function salvarProdutos(Request $request){
        $produtos = $request->input('produtos');
        $cliente = $this->getCliente();
        $clienteAssin = ClienteAssinatura::where('id_cliente', $cliente->id)->first();
        try {
            DB::beginTransaction();
            Pedido::where('id_cliente_assinatura', $clienteAssin->id)->delete();
            if($produtos != null){
                foreach($produtos as $produto){
                    //dd($produto);
                    $pedidos = new Pedido;
                    $pedidos->quantidade = $produto['quantidade'];
                    $pedidos->id_produto = $produto['id'];
                    $pedidos->id_cliente_assinatura = $cliente->clienteAssinatura->id;
                    $pedidos->save();
                }
            }
            DB::commit();
            return back()->with(['messageIcon' => 'success', 'messageTitle' => 'Sucesso', 'message' => 'Dados salvos!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return back()->with(['messageIcon' => 'error', 'messageTitle' => 'Ops...', 'message' => 'Erro ao salvar os dados!']);
        }        
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
        $request->validate([
            'nomeP' => 'required',
            'emailP' => 'required|email',
            'celularP' => 'required',
            'cpfP' => 'required',
            'lougradouro' => 'required',
            'cep' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'pais' => 'required',
            'dtNasc' => 'required|before:-18 years|date_format:d/m/Y',
        ]);
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
        $date = str_replace('/', '-', $request->input('dtNasc'));
        $time_input = strtotime($date);
        $dtNasc = date('Y-m-d',$time_input);
        
        $cliente = Cliente::where('id_usuario', Auth::user()->id)->first();
        $cliente->usuario->nome = $nome;
        $cliente->usuario->email = $email;
        $cliente->celular = $celular;
        $cliente->dtNasc = $dtNasc;
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

    public function cencelarAssinatura(Request $request){        
        try {
            $cliente = $this->getCliente();
            $deleted = ClienteAssinatura::where('id_cliente', $cliente->id)->delete();
            if($deleted){
                return redirect('/assinatura')->with(['messageIcon' => 'success', 'messageTitle' => 'Sucesso', 'message' => 'Assinatura cancelada!']);
            }
            return redirect('assinatura')->with(['messageIcon' => 'warning', 'messageTitle' => 'Ops...', 'message' => 'Assinatura não encontrada!']);
        } catch (\Throwable $th) {
            return redirect('assinatura')->with(['messageIcon' => 'error', 'messageTitle' => 'Ops...', 'message' => 'Falha ao cancelar assinatura']);
        }
    }
}
