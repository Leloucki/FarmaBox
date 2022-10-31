<?php

use App\Http\Controllers\Admin\HomeController;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('admin/', [HomeController::class, 'index'])->name('adminHome');
Route::namespace('App\Http\Controllers\Admin')->group(function(){
    Route::post('admin/login', 'HomeController@login');
    Route::post('admin/login', 'HomeController@login');
    
    Route::get('admin/recuperar-senha', function () {
        return view('adminV.recuperarSenhaRequest');
    })->name('admin.password.request');
    Route::get('admin/resetar-senha/{token}', 'HomeController@resetSenhaView')->name('admin.password.reset');
    
    Route::group(['middleware' => ['admin']], function(){
        Route::post('admin/recuperar-senha', 'HomeController@recuperarSenhaRequest')->name('admin.password.email');        
        Route::post('admin/resetar-senha', 'HomeController@resetSenha')->name('admin.password.update');
    });

    Route::group(['middleware' => ['auth', 'admin']], function(){
        Route::get('admin/produtos', 'ProdutoController@index')->name('adminProdutos');
        Route::get('admin/cadastrar/produtos', 'ProdutoController@cadastrarView');
        Route::get('admin/produtos/editar', 'ProdutoController@editarView');
        Route::post('admin/produtos/editar', 'ProdutoController@editar');
        Route::post('admin/cadastrar/produtos', 'ProdutoController@cadastrar');
        Route::post('admin/produtos/deletar', 'ProdutoController@deletar');

        Route::get('admin/categorias', 'CategoriaController@index');
        Route::get('admin/cadastrar/categorias', 'CategoriaController@cadastrarView');
        Route::post('admin/cadastrar/categorias', 'CategoriaController@cadastrar');
        Route::post('admin/deletar/categorias', 'CategoriaController@deletar');
        Route::get('admin/editar/categorias', 'CategoriaController@editarView');
        Route::post('admin/editar/categorias', 'CategoriaController@editar');

        Route::get('admin/logout', 'HomeController@logout');
    });
});

Route::namespace('App\Http\Controllers\Costumer')->group(function(){
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/assinatura', 'AssinaturaController@index');    

    Route::get('/produtos', 'ProdutosController@index');

    Route::get('/cadastro', 'CadastroController@index');

    Route::post('/cadastro/cliente', 'CadastroController@cadastrar');

    Route::post('/login/cliente', 'HomeController@login');

    
    Route::middleware(['verified'])->group(function () {
        Route::middleware(['auth'])->group(function () {
            Route::post('/produtos/inserirClienteProduto', 'ProdutosController@inserirClienteProduto');
            
            Route::get('/perfil', 'PerfilController@index');
            Route::post('/perfil/salvarConta', 'PerfilController@salvarConta');
            Route::get('/perfil/pagamento', 'PerfilController@pagamento');
            Route::post('/perfil/salvarPagamento', 'PerfilController@salvarPagamento');
            Route::get('/perfil/produtos', 'PerfilController@produtos');
            Route::post('/perfil/salvarProdutos', 'PerfilController@salvarProdutos');
            
            Route::get('/assinatura/cadastro/{assinatura}', 'AssinaturaController@cadastroView');
            Route::post('/assinatura/cadastro/{assinatura}', 'AssinaturaController@cadastrarAssin');
        });        
    });

    Route::get('/logout', 'HomeController@logout')->middleware('auth');
    
    Route::middleware(['guest'])->group(function () {
        Route::get('/recuperar-senha', function () {
            return view('costumer.recuperarSenhaRequest');
        })->name('password.request');

        Route::post('/recuperar-senha', 'HomeController@recuperarSenhaRequest')->name('password.email');

        Route::get('/resetar-senha/{token}', 'HomeController@resetSenhaView')->name('password.reset');

        Route::post('/resetar-senha', 'HomeController@resetSenha')->name('password.update');
    });
});
