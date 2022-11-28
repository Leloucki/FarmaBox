<?php

namespace App\Providers;

use App\Models\Assinatura;
use App\Models\Categoria;
use App\Models\Pedido;
use Illuminate\Contracts\Session\Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Paginator::defaultView('costumer.layout.paginacao');
        // Paginator::defaultSimpleView('costumer.layout.paginacao');
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        View::share('categorias', Categoria::get());    
    }
}
