<?php

namespace App\Http\Middleware;

use App\Models\Admin as ModelsAdmin;
use App\Models\Usuario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Admin
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
        if(($request->is('admin/recuperar-senha') || $request->is('admin/resetar-senha/{token}')) && $request->isMethod('post')){
            $email = $request->input('email');
            $idUser = Usuario::where('email', $email ?? '0')->first()->id ?? 0;
            $isAdmin = ModelsAdmin::where('id_usuario', $idUser)->first();            
            if(!$isAdmin){
                return back()->withErrors(['message' => 'E-mail não encontrado']);
            }
        }
        if(Auth::check()){
            $isAdmin = ModelsAdmin::where('id_usuario', $request->user()->id)->first();
            if(!($isAdmin)){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('admin');
            }
        }
        return $next($request);
    }
}
