<?php

namespace App\Http\Controllers\Produto;

use App\Http\Controllers\Controller;
use App\Models\produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
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
        try{
            $produto = new produto([
                "CodProd"           => $request->CodProd
                ,"Produto"          => $request->Produto
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
            $produto->QntGrade      = $request->QntGrade;
            $produto->CodPro        = $request->CodPro;
            $produto->save();
        }catch(\Exception $e){
            return response()->json($produto);
        }
        return response()->json('success');
    }

    //
}
