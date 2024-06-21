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

        $produtos = produto::where($filtros)->paginate(100);

        return view('produto.listAll' , compact('produtos'));
    }

    public function formAdd()
    {
        return view('produto.add');
    }
    public function strore(Request $request)
    {
        // dd($request);
        try{
            $produto = new produto([
                "Produto"                       => $request->Produto
                ,"QntGrade"                     => $request->QntGrade
                ,"CodPro"                       => $request->CodPro
                , "extrusora_pesoi"             => $request->extrusora_pesoi
                , "extrusora_pesos"             => $request->extrusora_pesos
                , "extrusora_alturai"           => $request->extrusora_alturai
                , "extrusora_alturas"           => $request->extrusora_alturas
                , "extrusora_largurai"          => $request->extrusora_largurai
                , "extrusora_larguras"          => $request->extrusora_larguras
                , "extrusora_comprimentoi"      => $request->extrusora_comprimentoi
                , "extrusora_comprimentos"      => $request->extrusora_comprimentos
                , "extrusora_dim_paredei"       => $request->extrusora_dim_paredei
                , "extrusora_dim_paredes"       => $request->extrusora_dim_paredes
                , "extrusora_umidadei"          => $request->extrusora_umidadei
                , "extrusora_umidades"          => $request->extrusora_umidades
                , "extrusora_vacuoi"            => $request->extrusora_vacuoi
                , "extrusora_vacuos"            => $request->extrusora_vacuos
                , "extrusora_durometroi"        => $request->extrusora_durometroi
                , "extrusora_durometros"        => $request->extrusora_durometros
                , "cargavagao_pesoi"            => $request->cargavagao_pesoi
                , "cargavagao_pesos"            => $request->cargavagao_pesos
                , "cargavagao_dim_externai"     => $request->cargavagao_dim_externai
                , "cargavagao_dim_externas"     => $request->cargavagao_dim_externas
                , "cargavagao_dim_paredei"      => $request->cargavagao_dim_paredei
                , "cargavagao_dim_paredes"      => $request->cargavagao_dim_paredes
                , "cargavagao_umidadei"         => $request->cargavagao_umidadei
                , "cargavagao_umidades"         => $request->cargavagao_umidades
                , "cargavagao_resistenciai"     => $request->cargavagao_resistenciai
                , "cargavagao_resistencias"     => $request->cargavagao_resistencias
                , "forno_pesoi"                 => $request->forno_pesoi
                , "forno_pesos"                 => $request->forno_pesos
                , "forno_dim_paredei"           => $request->forno_dim_paredei
                , "forno_dim_paredes"           => $request->forno_dim_paredes
                , "forno_resistenciai"          => $request->forno_resistenciai
                , "forno_resistencias"          => $request->forno_resistencias
                , "forno_absorcaoi"             => $request->forno_absorcaoi
                , "forno_absorcaos"             => $request->forno_absorcaos
                , "laboratorio_resistenciai"    => $request->laboratorio_resistenciai
                , "laboratorio_resistencias"    => $request->laboratorio_resistencias
                , "laboratorio_absorcaoi"       => $request->laboratorio_absorcaoi
                , "laboratorio_absorcaos"       => $request->laboratorio_absorcaos
                , "laboratorio_largurai"        => $request->laboratorio_largurai
                , "laboratorio_larguras"        => $request->laboratorio_larguras
                , "laboratorio_alturai"         => $request->laboratorio_alturai
                , "laboratorio_alturas"         => $request->laboratorio_alturas
                , "laboratorio_comprimentoi"    => $request->laboratorio_comprimentoi
                , "laboratorio_comprimentos"    => $request->laboratorio_comprimentos
                , "laboratorio_parede_externai" => $request->laboratorio_parede_externai
                , "laboratorio_parede_externas" => $request->laboratorio_parede_externas
                , "laboratorio_septosi"         => $request->laboratorio_septosi
                , "laboratorio_septoss"         => $request->laboratorio_septoss
                , "laboratorio_planezai"        => $request->laboratorio_planezai
                , "laboratorio_planezas"        => $request->laboratorio_planezas
                , "laboratorio_esquadroi"       => $request->laboratorio_esquadroi
                , "laboratorio_esquadros"       => $request->laboratorio_esquadros
                , "laboratorio_densidadei"      => $request->laboratorio_densidadei
                , "laboratorio_densidades"      => $request->laboratorio_densidades
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
            $produto->Produto                       = $request->Produto;
            $produto->QntGRade                      = $request->QntGRade;
            $produto->CodPro                        = $request->CodPro;
            $produto->extrusora_pesoi               = $request->extrusora_pesoi;
            $produto->extrusora_pesos               = $request->extrusora_pesos;
            $produto->extrusora_alturai             = $request->extrusora_alturai;
            $produto->extrusora_alturas             = $request->extrusora_alturas;
            $produto->extrusora_largurai            = $request->extrusora_largurai;
            $produto->extrusora_larguras            = $request->extrusora_larguras;
            $produto->extrusora_comprimentoi        = $request->extrusora_comprimentoi;
            $produto->extrusora_comprimentos        = $request->extrusora_comprimentos;
            $produto->extrusora_dim_paredei         = $request->extrusora_dim_paredei;
            $produto->extrusora_dim_paredes         = $request->extrusora_dim_paredes;
            $produto->extrusora_umidadei            = $request->extrusora_umidadei;
            $produto->extrusora_umidades            = $request->extrusora_umidades;
            $produto->extrusora_vacuoi              = $request->extrusora_vacuoi;
            $produto->extrusora_vacuos              = $request->extrusora_vacuos;
            $produto->extrusora_durometroi          = $request->extrusora_durometroi;
            $produto->extrusora_durometros          = $request->extrusora_durometros;
            $produto->cargavagao_pesoi              = $request->cargavagao_pesoi;
            $produto->cargavagao_pesos              = $request->cargavagao_pesos;
            $produto->cargavagao_dim_externai       = $request->cargavagao_dim_externai;
            $produto->cargavagao_dim_externas       = $request->cargavagao_dim_externas;
            $produto->cargavagao_dim_paredei        = $request->cargavagao_dim_paredei;
            $produto->cargavagao_dim_paredes        = $request->cargavagao_dim_paredes;
            $produto->cargavagao_umidadei           = $request->cargavagao_umidadei;
            $produto->cargavagao_umidades           = $request->cargavagao_umidades;
            $produto->cargavagao_resistenciai       = $request->cargavagao_resistenciai;
            $produto->cargavagao_resistencias       = $request->cargavagao_resistencias;
            $produto->forno_pesoi                   = $request->forno_pesoi;
            $produto->forno_pesos                   = $request->forno_pesos;
            $produto->forno_dim_paredei             = $request->forno_dim_paredei;
            $produto->forno_dim_paredes             = $request->forno_dim_paredes;
            $produto->forno_resistenciai            = $request->forno_resistenciai;
            $produto->forno_resistencias            = $request->forno_resistencias;
            $produto->forno_absorcaoi               = $request->forno_absorcaoi;
            $produto->forno_absorcaos               = $request->forno_absorcaos;
            $produto->laboratorio_resistenciai      = $request->laboratorio_resistenciai;
            $produto->laboratorio_resistencias      = $request->laboratorio_resistencias;
            $produto->laboratorio_absorcaoi         = $request->laboratorio_absorcaoi;
            $produto->laboratorio_absorcaos         = $request->laboratorio_absorcaos;
            $produto->laboratorio_largurai          = $request->laboratorio_largurai;
            $produto->laboratorio_larguras          = $request->laboratorio_larguras;
            $produto->laboratorio_alturai           = $request->laboratorio_alturai;
            $produto->laboratorio_alturas           = $request->laboratorio_alturas;
            $produto->laboratorio_comprimentoi      = $request->laboratorio_comprimentoi;
            $produto->laboratorio_comprimentos      = $request->laboratorio_comprimentos;
            $produto->laboratorio_parede_externai   = $request->laboratorio_parede_externai;
            $produto->laboratorio_parede_externas   = $request->laboratorio_parede_externas;
            $produto->laboratorio_septosi           = $request->laboratorio_septosi;
            $produto->laboratorio_septoss           = $request->laboratorio_septoss;
            $produto->laboratorio_planezai          = $request->laboratorio_planezai;
            $produto->laboratorio_planezas          = $request->laboratorio_planezas;
            $produto->laboratorio_esquadroi         = $request->laboratorio_esquadroi;
            $produto->laboratorio_esquadros         = $request->laboratorio_esquadros;
            $produto->laboratorio_densidadei        = $request->laboratorio_densidadei;
            $produto->laboratorio_densidades        = $request->laboratorio_densidades;

            $produto->save();
        }catch(\Exception $e){
            return response()->json($produto);
        }
        return response()->json('success');
    }

    //
}
