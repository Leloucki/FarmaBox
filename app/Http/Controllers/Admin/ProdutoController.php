<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\CategoriaProduto;
use App\Models\Laboratorio;
use App\Models\Produto;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProdutoController extends Controller
{
    public function index(Request $request){
        $produtos = $this->getProdutos($request);

        return view('adminV.produtos.index', ['produtos' => $produtos->paginate(3)]);
    }

    public function getProdutos($request){
        $produtos = new Produto;
        if($request->has('nomeSearch')){
            $produtos = $produtos->where('nome', 'like', '%'.$request->get('nomeSearch').'%');
        }
        return $produtos;
    }

    public function cadastrar(Request $request){    
        $valor = str_replace('.', '', $request->input('valor'));         
        $valor = str_replace(',', '.', $valor);
        $request->merge(['valor' => $valor]);
        //dd($request->all());
        $request->validate([
            'nome' => ['required'],
            'valor' => ['required', 'numeric'],
            'descricao' => ['required'],
            'imagem' => [
                'required', 
                'mimes:png,jpg,jpeg,webp', 
                Rule::dimensions()->maxWidth(1000)->maxHeight(1000)->ratio(1 / 1)->minWidth(200)->minHeight(200)
            ],
        ]);
        
        //dd($request->all());
        $nome = $request->input('nome');        
        $categorias = $request->input('categorias');
        $laboratorio = $request->input('laboratorio');
        $desc = $request->input('descricao');
        $imagem = $request->file('imagem');

        try {
            DB::beginTransaction();
            $produto = new Produto();            
            $produto->nome = $nome;
            $produto->nomeP = $nome.'.'.$imagem->extension();
            $produto->valor = $valor;
            $produto->desc = $desc;
            $produto->id_lab = $laboratorio;
            $produto->save();
            if($categorias != null){
                foreach($categorias as $catID){
                    $CProduto = new CategoriaProduto();
                    $CProduto->id_produto = $produto->id;
                    $CProduto->id_categoria = $catID;
                    $CProduto->save();
                }
            }
            $imagem->storeAs(
            'img/produtos', $produto->nomeP, 'public'
            );
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with([
                'messageTitle' => 'Ops...',
                'message' => 'Falha ao cadastrar produto',
                'messageIcon' => 'error'
            ]);
        }
        return back()->with([
            'messageTitle' => 'Sucesso',
            'message' => 'Produto cadastrado',
            'messageIcon' => 'success'
        ]);
    }

    public function cadastrarView(Request $request){
        $laboratorios = Laboratorio::get();
        $categorias = Categoria::get();
        return view('adminV.produtos.cadastrar', ['laboratorios' => $laboratorios, 'categorias' => $categorias]);
    }

    public function deletar(Request $request){
        $request->validate([
            'idProduto' => ['required','numeric']
        ]);
        
        try {
            DB::beginTransaction();
            $produto = Produto::where('id', $request->input('idProduto'))->first();
            $nomeP = $produto->nomeP;
            $deleted = $produto->delete();            
            if(!($deleted == 1)){
                throw new Exception('Not equal 1');                
            }            
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with([
                'messageTitle' => 'Ops...',
                'message' => 'Falha ao excluir produto',
                'messageIcon' => 'error'
            ]);
        }
        Storage::delete('img/produtos/'.$nomeP);
        DB::commit();

        return back()->with([
            'messageTitle' => 'Sucesso',
            'message' => 'Produto excluído',
            'messageIcon' => 'success'
        ]);
    }

    public function editarView(Request $request, $id){        
        if(is_numeric($id)){
            $produto = Produto::where('id', $id)->first();  
            //dd(Storage::url($produto->nomeP));

            if($produto){
                $laboratorios = Laboratorio::get();
                $categorias = Categoria::get();
                $categoriaProduto = CategoriaProduto::where('id_produto', $produto->id)->pluck('id_categoria')->toArray();         
                return view('adminV.produtos.editar', [
                    'produto' => $produto,
                    'laboratorios' => $laboratorios,
                    'categorias' => $categorias,
                    'categoriaProduto' => $categoriaProduto
                ]);
            }
        }
        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Produto não encontrado',
            'messageIcon' => 'warning'
        ]);
    }

    public function editar(Request $request){
        $valor = str_replace('.', '', $request->input('valor'));         
        $valor = str_replace(',', '.', $valor);
        $request->merge(['valor' => $valor]);
        dd($request->all());
        $request->validate([
            'nome' => ['required'],
            'valor' => ['required', 'numeric'],
            'descricao' => ['required'],
            'imagem' => [
                'required', 
                'mimes:png,jpg,jpeg,webp', 
                Rule::dimensions()->maxWidth(1000)->maxHeight(1000)->ratio(1 / 1)->minWidth(200)->minHeight(200)
            ],
        ]);


    }
}
