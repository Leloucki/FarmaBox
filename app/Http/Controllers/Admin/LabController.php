<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laboratorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabController extends Controller
{
    public function index(Request $request){
        $laboratorios = $this->getlaboratorios($request);
        return view('adminV.laboratorio.index', ['laboratorios' => $laboratorios->paginate(5)]);
    }

    public function getlaboratorios($request){
        $laboratorios = new Laboratorio;
        if($request->has('nomeSearch')){
            $laboratorios = $laboratorios->where('nome', 'like', '%'.$request->get('nomeSearch').'%');
        }
        return $laboratorios;
    }

    public function cadastrarView(Request $request){
        return view('adminV.laboratorio.cadastrar');
    }

    public function cadastrar(Request $request){
        $request->validate([
            'nome' => ['required']
        ]);
        //dd($request->all());
        try {
            DB::beginTransaction();
            $isCategExist = Laboratorio::where('nome', $request->input('nome'))->first();
            if($isCategExist){
                return back()->with([
                    'messageTitle' => 'Ops...',
                    'message' => 'O laboratorio '.$request->input('nome').' já existe',
                    'messageIcon' => 'warning'
                ]);
            }
            $laboratorio = new Laboratorio;
            $laboratorio->nome = $request->input('nome');
            $laboratorio->save();
            DB::commit();
            return back()->with([
                'messageTitle' => 'Sucesso',
                'message' => 'Laboratorio cadastrado',
                'messageIcon' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return back()->with([
                'messageTitle' => 'Ops...',
                'message' => 'Falha ao cadastrar laboratorio',
                'messageIcon' => 'error'
            ]);
        }        
    }

    public function deletar(Request $request){
        $request->validate([
            'idlaboratorio' => ['required', 'integer']
        ]);

        try {
            DB::beginTransaction();
            $deleted = Laboratorio::where('id', $request->input('idlaboratorio'))->delete();
            if($deleted){
                DB::commit();
                return back()->with([
                    'messageTitle' => 'Sucesso',
                    'message' => 'Laboratorio deletado',
                    'messageIcon' => 'success'
                ]);
            }
            DB::rollBack();
            return back()->with([
                'messageTitle' => 'Ops...',
                'message' => 'Laboratorio não encontrado',
                'messageIcon' => 'warning'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            back()->with([
                'messageTitle' => 'Ops...',
                'message' => 'Erro ao deletar laboratorio',
                'messageIcon' => 'error'
            ]);
        }
    }

    public function editarView(Request $request){  
        $request->validate([
            'id' => ['required', 'integer']
        ]);
        $id = $request->get('id');
        if(is_numeric($id)){
            $laboratorio = Laboratorio::where('id', $id)->first();  
            //dd(Storage::url($produto->nomeP));
            if($laboratorio){  
                return view('adminV.laboratorio.editar', ['laboratorio' => $laboratorio]);
            }
        }
        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Laboratorio não encontrado',
            'messageIcon' => 'warning'
        ]);
    }

    public function editar(Request $request){
        $request->validate([
            'nome' => ['required'],
            'id_laboratorio' => ['required', 'numeric']
        ]);

        $laboratorio = Laboratorio::where('id', $request->input('id_laboratorio'))->first();
        if($laboratorio){
            try {
                DB::beginTransaction();                   
                $laboratorio->nome = $request->input('nome');                         
                $laboratorio->save();
                DB::commit();
                return back()->with([
                    'messageTitle' => 'Sucesso',
                    'message' => 'Laboratorio atualizado',
                    'messageIcon' => 'success'
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                report($th);
                return back()->with([
                    'messageTitle' => 'Ops...',
                    'message' => 'Falha ao alterar laboratorio',
                    'messageIcon' => 'error'
                ]);
            }
        }
        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Laboratorio não encontrado',
            'messageIcon' => 'warning'
        ]);
    }
}
