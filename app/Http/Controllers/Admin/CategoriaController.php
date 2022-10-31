<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index(Request $request){
        $categorias = $this->getCategorias($request);
        return view('adminV.categorias.index', ['categorias' => $categorias->paginate(5)]);
    }

    public function getCategorias($request){
        $categorias = new Categoria;
        if($request->has('nomeSearch')){
            $categorias = $categorias->where('nome', 'like', '%'.$request->get('nomeSearch').'%');
        }
        return $categorias;
    }

    public function cadastrarView(Request $request){
        return view('adminV.categorias.cadastrar');
    }

    public function cadastrar(Request $request){
        $request->validate([
            'nome' => ['required']
        ]);
        //dd($request->all());
        try {
            DB::beginTransaction();
            $isCategExist = Categoria::where('nome', $request->input('nome'))->first();
            if($isCategExist){
                return back()->with([
                    'messageTitle' => 'Ops...',
                    'message' => 'A categoria '.$request->input('nome').' já existe',
                    'messageIcon' => 'warning'
                ]);
            }
            $categoria = new Categoria;
            $categoria->nome = $request->input('nome');
            $categoria->save();
            DB::commit();
            return back()->with([
                'messageTitle' => 'Sucesso',
                'message' => 'Categoria cadastrada',
                'messageIcon' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return back()->with([
                'messageTitle' => 'Ops...',
                'message' => 'Falha ao cadastrar categoria',
                'messageIcon' => 'error'
            ]);
        }        
    }

    public function deletar(Request $request){
        $request->validate([
            'idCategoria' => ['required', 'numeric']
        ]);

        try {
            DB::beginTransaction();
            $deleted = Categoria::where('id', $request->input('idCategoria'))->delete();
            if($deleted){
                DB::commit();
                return back()->with([
                    'messageTitle' => 'Sucesso',
                    'message' => 'Categoria deletada',
                    'messageIcon' => 'success'
                ]);
            }
            DB::rollBack();
            return back()->with([
                'messageTitle' => 'Ops...',
                'message' => 'Categoria não encontrada',
                'messageIcon' => 'warning'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            back()->with([
                'messageTitle' => 'Ops...',
                'message' => 'Erro ao deletar categoria',
                'messageIcon' => 'error'
            ]);
        }
    }

    public function editarView(Request $request){  
        $request->validate([
            'id' => ['required', 'numeric']
        ]);
        $id = $request->get('id');
        if(is_numeric($id)){
            $categoria = Categoria::where('id', $id)->first();  
            //dd(Storage::url($produto->nomeP));
            if($categoria){  
                return view('adminV.categorias.editar', ['categoria' => $categoria]);
            }
        }
        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Categoria não encontrada',
            'messageIcon' => 'warning'
        ]);
    }

    public function editar(Request $request){
        $request->validate([
            'nome' => ['required'],
            'id_categoria' => ['required', 'numeric']
        ]);

        $categoria = Categoria::where('id', $request->input('id_categoria'))->first();
        if($categoria){
            try {
                DB::beginTransaction();                   
                $categoria->nome = $request->input('nome');                         
                $categoria->save();
                DB::commit();
                return back()->with([
                    'messageTitle' => 'Sucesso',
                    'message' => 'Categoria atualizada',
                    'messageIcon' => 'success'
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                report($th);
                return back()->with([
                    'messageTitle' => 'Ops...',
                    'message' => 'Falha ao alterar categoria',
                    'messageIcon' => 'error'
                ]);
            }
        }
        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Categoria não encontrada',
            'messageIcon' => 'warning'
        ]);
    }
}
