<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if($request->is('admin/*')){
                return route('adminHome');
            }
            $request->session()->flash('message', 'É necessário realizar login para acessar tal recurso.');
            $request->session()->flash('messageTitle', 'Aviso');
            $request->session()->flash('messageIcon', 'warning');
            return route('home');
        }
    }
}
