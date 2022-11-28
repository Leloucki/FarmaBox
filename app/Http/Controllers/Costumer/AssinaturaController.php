<?php

namespace App\Http\Controllers\Costumer;

use App\Http\Controllers\Controller;
use App\Models\Assinatura;
use App\Models\Categoria;
use App\Models\Ccard;
use App\Models\Cliente;
use App\Models\ClienteAssinatura;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationDate;

class AssinaturaController extends Controller
{
    function index(Request $request){
        $assinaturas = Assinatura::get();
        return view('costumer.assinatura.index', ['assinaturas' => $assinaturas]);
    }

    function cadastroView(Request $request, $assin){        
        if($request->user() == null){return redirect('/cadastro');}
        $assinatura = Assinatura::where('nome', $assin)->first();
        if(!($assinatura)){return redirect('/');}

        if($assinatura){
            return view('costumer.assinatura.cadastro', ['assinatura' => $assinatura]);
        }

        return redirect('/');
    }

    function cadastrarAssin(Request $request, $id){
        $request->validate([
            'sexo' => ['required'],
            'nome' => ['required', "regex:/^((\b[A-zÀ-ú']{2,40}\b)\s*){2,}$/"],
            'numeroCard' => ['required', new CardNumber],
            'dataExp' => ['required', new CardExpirationDate('m/y')],
            'cvv' => ['required', new CardCvc($request->input('numeroCard'))]
        ]);

        try {
            DB::beginTransaction();
            $cliente = Cliente::where('id_usuario', $request->user()->id)->first();
            $cAssinExist = ClienteAssinatura::where('id_cliente', $cliente->id)->first();
            if($cAssinExist != null){
                return back()->with([            
                    'messageIcon' => 'warning',
                    'messageTitle' => 'Aviso',
                    'message' => 'Você já possui assinatura.'
                    ]
                );
            }

            $cAssin = new ClienteAssinatura;
            $cartao = new Ccard;
            $cAssin->sexo = $request->input('sexo');
            $cAssin->alergia = $request->input('alergia');
            $cAssin->observacao = $request->input('observacao');
            $cAssin->id_cliente = $cliente->id;
            $cAssin->id_assin = $id;

            $cartao->nome = $request->input('nome');
            $cartao->numero = $request->input('numeroCard');
            $cartao->dataExp = $request->input('dataExp');
            $cartao->cvv = $request->input('cvv');
            $cartao->id_cliente = $cliente->id;
            
            $cAssin->save();
            $cartao->save();
            DB::commit();
            if($cAssin->assinatura->nome == "Basico"){
                DB::beginTransaction();
                $this->setProdutosBasico($cAssin);   
                DB::commit(); 
            }      
            return back()->with([            
                'messageIcon' => 'success',
                'messageTitle' => 'Sucesso',
                'message' => 'Assinatura ativada!'
            ]);        
        } catch (\Throwable $th){
            DB::rollBack();
            report($th);
            return back()->with([            
                'messageIcon' => 'error',
                'messageTitle' => 'Ops...',
                'message' => 'Erro ao cadastrar-se na assinatura'.$th->getMessage()
                ]
            )->withInput();
        }            
    }

    public function setProdutosBasico($cAssin){
        $valorAssin = $cAssin->assinatura->valor;
        $categorias = Categoria::get();
        $totalProdutos = 0;
        $produtos = [];
        $qtdProdutos = [];
        while($valorAssin > $totalProdutos){
            foreach ($categorias as $categoria) {
                $produto = Produto::select('produtos.*')
                ->join('categoria_produtos', 'categoria_produtos.id_produto', '=', 'produtos.id')
                ->whereRaw('(ABS(CAST(
                    (BINARY_CHECKSUM(*) *
                    RAND()) as int)) % 100) < 10')
                ->orWhere('id_categoria', $categoria->id)
                ->first();
                if($produto){
                    if(($produto->valor + $totalProdutos) > $valorAssin){
                        break 2;
                    }               
                    $produtos[$produto->id] = $produto;
                    $totalProdutos += $produto->valor;
                    if (key_exists($produto->id, $qtdProdutos)) {
                        $qtdProdutos[$produto->id]++;
                    } else {
                        $qtdProdutos[$produto->id] = 1;
                    }
                    
                }    
            }     
        }
        //dd([$produtos, $totalProdutos, $qtdProdutos]);

        foreach ($produtos as $produto) {
            $pedido = new Pedido;
            $pedido->id_produto = $produto->id;
            $pedido->id_cliente_assinatura = $cAssin->id;
            $pedido->quantidade = $qtdProdutos[$produto->id];
            $pedido->save();
        }

    }
}
