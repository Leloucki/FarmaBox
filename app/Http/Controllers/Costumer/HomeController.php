<?php

namespace App\Http\Controllers\Costumer;

use App\Http\Controllers\Controller;
use App\Models\Assinatura;
use App\Models\Usuario;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    function index(Request $request){
        $assinaturaB = Assinatura::where('nome', 'like','%basico%')->first();
        return view('costumer.index', ['assinaturaB' => $assinaturaB]);
    }

    function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->input('remember') == '1' ? true : false;
        
        if(Auth::attempt($credentials, $remember)){
            if($request->user()->hasVerifiedEmail()){
                $request->session()->regenerate();
                return back();
            }

            if(!(Auth::user()->ativado)){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with([
                    'messageTitle' => 'Usuário desativado',
                    'message' => 'Entre em contato com a administração para ativar',
                    'messageIcon' => 'error'
                ]);
            }

            return back()->with([
                'messageTitle' => 'E-mail não verificado',
                'message' => 'Antes de continuar, verifique o link enviado para o e-mail ' . $request->user()->email,
                'messageIcon' => 'warning',
                'messageHtml' => ""
            ]);
        }
        
        return back()->with([
            'messageIcon' => 'error',
            'messageTitle' => 'Ops...',
            'message' => 'Usuário inválido!'
            ]
        );
    }

    function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    function recuperarSenhaRequest(Request $request){
        $request->replace(['email' => $request->input('emailR')]);

        $request->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );
        //dd(__($status));

        $boolStatus = $status === Password::RESET_LINK_SENT;
        //dd($boolStatus ? ['status' => __($status)] : ['emailStatus' => __($status)]);
        return $boolStatus ? back()->with(['status' => __($status)]) : back()->with(['emailStatus' => __($status)]); 
    }

    function resetSenhaView(Request $request, $token){
        //dd($request->all());
        return view('costumer.resetSenha', ['token' => $token, 'email' => $request->get('email')]);
    }

    function resetSenha(Request $request){
        //dd($request->all());
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
            'emailR' => 'required|email'
        ]);

        $request->merge(['email' => $request->input('emailR')]);
        //dd($request->only('emailR', 'senha', 'token'));
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'senha' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
     
                event(new PasswordReset($user));
            }
        );
        //dd(__($status));
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('home')->with(['message' => __($status), 'messageTitle' => 'Sucesso', 'messageIcon' => 'success'])
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
