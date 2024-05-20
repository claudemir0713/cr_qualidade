<?php

namespace App\Http\Controllers\historico;

use App\Http\Controllers\Controller;
use App\Models\historico;
use Illuminate\Http\Request;

class historicoController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $historico  = ($request->get('historico'))? $request->get('historico') : session('historico');
        session()->put('historico', $historico);
        if($historico){
            $filtros[]=['historicos.historico','like','%'.$historico.'%'];
        }

        $historicos = historico::where($filtros)->paginate(5);

        return view('historico.listAll' , compact('historicos'));
    }

    public function formAdd()
    {
        return view('historico.add');
    }
    public function strore(Request $request)
    {
        // dd($request);
        try{
            $historico = new historico([
                "historico"           => $request->historico
                ]);
            $historico->save();
        }catch(\Exception $e){
            return response()->json($historico);
        }
        return response()->json('success');
    }

    public function formEdit($historico)
    {
        $historico = historico::where('historico','=',$historico)->first();

        return view('historico.edit' , compact('historico'));
    }

    public function edit($historico, Request $request)
    {
        try{
            $historico = historico::find($historico);
            $historico->historico       = $request->historico;
            $historico->save();
        }catch(\Exception $e){
            return response()->json($historico);
        }
        return response()->json('success');
    }

    //
}
