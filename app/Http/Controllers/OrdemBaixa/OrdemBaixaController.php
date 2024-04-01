<?php

namespace App\Http\Controllers\OrdemBaixaBaixa;

use App\Http\Controllers\Controller;
use App\Models\ordembaixa;
use Illuminate\Http\Request;

class OrdemBaixaBaixaController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $OrdemBaixa  = ($request->get('OrdemBaixa'))? $request->get('OrdemBaixa') : session('OrdemBaixa');
        session()->put('OrdemBaixa', $OrdemBaixa);
        if($OrdemBaixa){
            $filtros[]=['ordens.OrdemBaixa','like','%'.$OrdemBaixa.'%'];
        }

        $ordembaixas = ordembaixa:: leftJoin('ordem','ordem.CodOrdem','OrdemBaixa.CodOrdem')
                                    ->leftJoin('users','users.id','OrdemBaixa.CodOperador')
                                    ->where($filtros)
                                    ->get([
                                        'CodOrdem'
                                        ,'DataApontamento'
                                        ,'QntGrade'
                                        ,'QntPeca'
                                        ,'CodOperador'
                                    ])
                            ->paginate(5);

        return view('OrdemBaixa.listAll' , compact('ordens'));
    }

    public function formAdd()
    {
        return view('OrdemBaixa.add');
    }
    public function strore(Request $request)
    {
        try{
            $OrdemBaixa = new OrdemBaixa([
                "CodOrdem"              => $request->CodOrdem
                ,"DataApontamento"      => $request->DataApontamento
                ,"QntGrade"             => $request->QntGrade
                ,"QntPeca"              => $request->QntPeca
                ,"CodOperador"          => $request->CodOperador
                ]);
            $OrdemBaixa->save();
        }catch(\Exception $e){
            return response()->json($OrdemBaixa);
        }
        return response()->json('success');
    }

    public function formEdit($CodProd)
    {
        $OrdemBaixa = OrdemBaixa::where('CodProd','=',$CodProd)->first();

        return view('OrdemBaixa.edit' , compact('OrdemBaixa'));
    }

    public function edit($CodProd, Request $request)
    {
        try{
            $OrdemBaixa = OrdemBaixa::find($CodProd);
            $OrdemBaixa->CodOrdem               = $request->CodOrdem;
            $OrdemBaixa->DataApontamento        = $request->DataApontamento;
            $OrdemBaixa->QntGrade               = $request->QntGrade;
            $OrdemBaixa->QntPeca                = $request->QntPeca;
            $OrdemBaixa->CodOperador            = $request->CodOperador;
            $OrdemBaixa->save();
        }catch(\Exception $e){
            return response()->json($OrdemBaixa);
        }
        return response()->json('success');
    }

}
