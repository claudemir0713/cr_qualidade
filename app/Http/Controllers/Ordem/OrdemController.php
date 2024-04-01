<?php

namespace App\Http\Controllers\Ordem;

use App\Http\Controllers\Controller;
use App\Models\ordem;
use Illuminate\Http\Request;

class OrdemController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $ordem  = ($request->get('ordem'))? $request->get('ordem') : session('ordem');
        session()->put('ordem', $ordem);
        if($ordem){
            $filtros[]=['ordens.ordem','like','%'.$ordem.'%'];
        }

        $ordens = ordem:: leftJoin('maquina','maquina.CodMaquina','ordem.Maquina')
                            ->where($filtros)
                            ->get([
                                'CodOrdem'
                                ,'DataInicio'
                                ,'DataConclusao'
                                ,'Produto'
                                ,'Maquina'
                                ,'Quantidade'
                            ])
                            ->paginate(5);

        return view('ordem.listAll' , compact('ordens'));
    }

    public function formAdd()
    {
        return view('ordem.add');
    }
    public function strore(Request $request)
    {
        try{
            $ordem = new ordem([
                "CodOrdem"              => $request->CodOrdem
                ,"DataInicio"           => $request->DataInicio
                ,"DataConclusao"        => $request->DataConclusao
                ,"Produto"              => $request->Produto
                ,"Maquina"              => $request->Maquina
                ,"Quantidade"           => $request->Quantidade
                ]);
            $ordem->save();
        }catch(\Exception $e){
            return response()->json($ordem);
        }
        return response()->json('success');
    }

    public function formEdit($CodProd)
    {
        $ordem = ordem::where('CodProd','=',$CodProd)->first();

        return view('ordem.edit' , compact('ordem'));
    }

    public function edit($CodProd, Request $request)
    {
        try{
            $ordem = ordem::find($CodProd);
            $ordem->CodOrdem                = $request->CodOrdem;
            $ordem->DataInicio              = $request->DataInicio;
            $ordem->DataConclusao           = $request->DataConclusao;
            $ordem->Produto                 = $request->Produto;
            $ordem->Maquina                 = $request->Maquina;
            $ordem->Quantidade              = $request->Quantidade;
            $ordem->save();
        }catch(\Exception $e){
            return response()->json($ordem);
        }
        return response()->json('success');
    }

}
