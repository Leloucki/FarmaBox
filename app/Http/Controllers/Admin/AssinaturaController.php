<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assinatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssinaturaController extends Controller
{
    public function index(Request $request){
        $assinatura = $this->getAssinaturas($request);
        return view('adminV.assinatura.index', ['assinaturas' => $assinatura->paginate(5)]);
    }

    public function getAssinaturas($request){
        $assinatura = new Assinatura;
        if($request->has('nomeSearch')){
            $assinatura = $assinatura->where('nome', 'like', '%'.$request->get('nomeSearch').'%');
        }
        return $assinatura;
    }

    public function editarView(Request $request){
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        $assinatura = Assinatura::where('id', $request->get('id'))->first();

        if($assinatura){
            return view('adminV.assinatura.editar', ['assinatura' => $assinatura]);
        }
        
        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Assinatura não encontrada',
            'messageIcon' => 'warning'
        ]);
    }

    public function editar(Request $request){
        $valor = str_replace('.', '', $request->input('valor'));         
        $valor = str_replace(',', '.', $valor);
        $request->merge(['valor' => $valor]);
        $request->validate([
            'id_assinatura' => ['required', 'integer'],
            'valor' => ['required', 'numeric']
        ]);

        $assinatura = Assinatura::where('id', $request->input('id_assinatura'))->first();
        if($assinatura){
            try {
                DB::beginTransaction();
                $assinatura->valor = $request->input('valor');
                $assinatura->save();
                DB::commit();

                return back()->with([
                    'messageTitle' => 'Sucesso',
                    'message' => 'Assinatura atualizada',
                    'messageIcon' => 'success'
                ]);

            } catch (\Throwable $th) {
                DB::rollBack();
                report($th);
                return back()->with([
                    'messageTitle' => 'Ops...',
                    'message' => 'Erro ao atualizar assinatura',
                    'messageIcon' => 'error'
                ]);
            }                      
        }
        return back()->with([
            'messageTitle' => 'Ops...',
            'message' => 'Assinatura não encontrada',
            'messageIcon' => 'warning'
        ]);
    }
}
