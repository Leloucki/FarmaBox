<?php

namespace App\Http\Middleware;

use App\Models\Cliente;
use App\Models\ClienteAssinatura;
use App\Models\Pedido;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ClienteShareData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $cliente = Cliente::where('id_usuario', $request->user()->id)->first();
            if($cliente){
                $clienteAssinatura = ClienteAssinatura::where('id_cliente', $cliente->id)->first();
                if($clienteAssinatura){
                    $qtdPC = Pedido::where('id_cliente_assinatura', $clienteAssinatura->id)->count();
                    View::share('qtdPC', $qtdPC);
                }                
            }            
        }
        return $next($request);
    }
}
