<?php

namespace App\Http\Controllers\produto;

use App\Http\Controllers\Controller;
use App\Models\produto;
use Illuminate\Http\Request;

class produtoController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $produto  = ($request->get('produto'))? $request->get('produto') : session('produto');
        session()->put('produto', $produto);
        if($produto){
            $filtros[]=['produtos.produto','like','%'.$produto.'%'];
        }

        $produtos = produto::where($filtros)->paginate(5);

        return view('produto.listAll' , compact('produtos'));
    }

    public function formAdd()
    {
        return view('produto.add');
    }
    public function strore(Request $request)
    {
        //  dd($request);
        try{
            $produto = new produto([
                "Produto"           => $request->Produto
                ,"QntGrade"         => $request->QntGrade
                ,"CodPro"           => $request->CodPro
                ]);
            $produto->save();
        }catch(\Exception $e){
            return response()->json($produto);
        }
        return response()->json('success');
    }

    public function formEdit($CodProd)
    {
        $produto = produto::where('CodProd','=',$CodProd)->first();

        return view('produto.edit' , compact('produto'));
    }

    public function edit($CodProd, Request $request)
    {
        try{
            $produto = produto::find($CodProd);
            $produto->Produto       = $request->Produto;
            $produto->QntGRade      = $request->QntGRade;
            $produto->CodPro        = $request->CodPro;
            $produto->save();
        }catch(\Exception $e){
            return response()->json($produto);
        }
        return response()->json('success');
    }

    //
}
