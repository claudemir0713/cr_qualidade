<?php

namespace App\Http\Controllers\Maquina;

use App\Http\Controllers\Controller;
use App\Models\maquina;
use Illuminate\Http\Request;

class MaquinaController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $maquina  = ($request->get('maquina'))? $request->get('maquina') : session('maquina');
        session()->put('maquina', $maquina);
        if($maquina){
            $filtros[]=['maquinas.maquina','like','%'.$maquina.'%'];
        }

        $maquinas = maquina::where($filtros)->paginate(5);

        return view('maquina.listAll' , compact('maquinas'));
    }

    public function formAdd()
    {
        return view('maquina.add');
    }
    public function strore(Request $request)
    {
        // dd($request);
        try{
            $maquina = new maquina([
                "Maquina"           => $request->Maquina
                ]);
            $maquina->save();
        }catch(\Exception $e){
            return response()->json($maquina);
        }
        return response()->json('success');
    }

    public function formEdit($CodMaquina)
    {
        $maquina = maquina::where('CodMaquina','=',$CodMaquina)->first();

        return view('maquina.edit' , compact('maquina'));
    }

    public function edit($CodMaquina, Request $request)
    {
        try{
            $maquina = maquina::find($CodMaquina);
            $maquina->Maquina       = $request->Maquina;
            $maquina->save();
        }catch(\Exception $e){
            return response()->json($maquina);
        }
        return response()->json('success');
    }

    //
}
