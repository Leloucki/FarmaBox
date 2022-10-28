<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    function index(Request $request){    
        if(Auth::check()){
            return redirect()->route('adminProdutos');
        }
        return view('adminV.login');
    }

    function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $data = $request->all();
        $usuario = Usuario::where('email', $data['email'])->first();
        if($usuario){
            $isAdmin = Admin::where('id_usuario', $usuario->id)->first();
            if($isAdmin){
                $remember = $request->input('remember') == '1' ? true : false;
                if(Auth::attempt($credentials, $remember)){
                    return redirect('admin/produtos');
                }
            }
        }
        return redirect()->back()->withErrors(['message' => 'E-mail ou senha inválida!']);
    }

    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('admin');
    }

    function recuperarSenhaRequest(Request $request){        
        $request->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );
        //dd(__($status));

        $boolStatus = $status === Password::RESET_LINK_SENT;
        //dd($boolStatus ? ['status' => __($status)] : ['emailStatus' => __($status)]);
        return $boolStatus ? back()->with(['message' => __($status), 'messageTitle' => 'Sucesso', 'messageIcon' => 'success']) : back()->with(['message' => __($status), 'messageTitle' => 'Ops...', 'messageIcon' => 'warning']); 
    }

    function resetSenhaView(Request $request, $token){
        //dd($request->all());
        return view('adminV.resetSenha', ['token' => $token, 'email' => $request->get('email')]);
    }

    function resetSenha(Request $request){
        //dd($request->all());
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:3|confirmed',
            'email' => 'required|email'
        ]);
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
                    ? redirect()->route('adminHome')->with(['success' => __($status), 'messageTitle' => 'Sucesso', 'messageIcon' => 'success'])
                    : back()->withErrors(['message' => __($status)]);
    }
}
