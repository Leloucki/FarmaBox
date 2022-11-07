<?php

namespace App\Http\Middleware;

use App\Models\Cliente;
use App\Models\ClienteAssinatura as ModelsClienteAssinatura;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteAssinatura
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
        $cliente = Cliente::where('id_usuario', Auth::user()->id)->first();
        $clienteAssin = ModelsClienteAssinatura::where('id_cliente', $cliente->id)->first();
        if(is_null($clienteAssin)){
            return back()->with([
                'message' => 'É necessário possuir uma assinatura para acessar tal recurso.',
                'messageTitle' => 'Aviso',
                'messageIcon' => 'warning',
            ]);
        }
        return $next($request);
    }
}
