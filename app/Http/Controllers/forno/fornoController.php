<?php

namespace App\Http\Controllers\forno;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\produto;
use App\Models\forno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class fornoController extends Controller
{

    public function listAll(Request $request ){

        $filtros=[];

        $user = user::where('email','=',Auth::user()->email)->first();
        $filtrouser = $user->id;
        $userSelecionado = $request->user;

        // $nivel = Auth::user()->nivel;
        // if($nivel!='admin'){
        //     $filtros[]=['forno.user_id','=',$user->id];
        // };
        // if($nivel=='admin'){
        //     $user = user::where('ativo','S')->orderBy('name')->get();
        //     $filtrouser = $user;
        //     $filtrouser  = ($request->get('user'))? $request->user : session('filtrouser');

        //     if($userSelecionado=="0"){ $filtrouser = "0";};

        //     session()->put('filtrouser', $filtrouser);

        //     if($filtrouser>0){
        //         $filtros[]=['forno.user_id','=',$filtrouser];
        //     }
        // }else{
        //     $filtros[]=['forno.user_id','>','0'];
        //     $user = user::where('Id','=',$user)->get();
        // }

        $filtroDtInicial  = ($request->get('data'))? $request->get('data') : session('filtroDtInicial');
        session()->put('filtroDtInicial', $filtroDtInicial);
        $filtroDtFinal  = ($request->get('data'))? $request->get('data') : session('filtroDtFinal');
        session()->put('filtroDtFinal', $filtroDtFinal);

        $colaborador  = ($request->get('colaborador'))? $request->get('colaborador') : session('colaborador');
        session()->put('colaborador', $colaborador);

        if($colaborador){
            $filtros[]=['users.name','like','%'.$colaborador.'%'];
        }

        if($filtroDtFinal){
            $filtros[]=['forno.data','>=',$filtroDtInicial];
            $filtros[]=['forno.data','<=',$filtroDtFinal];
        }
        // DB::connection()->enableQueryLog();
        $fornos = forno:: leftJoin('users','users.id','forno.user_id')
                                        ->leftJoin('produto','produto.CodProd','forno.produto')
                                        ->where($filtros)
                                        ->orderBy('data','desc')
                                        ->orderBy('id_forno','desc')
                                        ->get([
                                            'forno.id as id_forno'
                                            , 'forno.user_id'
                                            , 'forno.data'
                                            , 'produto.CodProd'
                                            , 'produto.Produto'
                                            , 'produto.QntGrade'
                                            , 'produto.CodPro'
                                            , 'forno.peso'
                                            , 'forno.dim_externa'
                                            , 'forno.dim_parede'
                                            , 'forno.umidade'
                                            , 'forno.resistencia'
                                            , 'forno.lote'
                                            , 'forno.residuo'
                                            , 'users.name'
                                    ]);
        // $queries = DB::getQueryLog();
        // dd($queries);
        return view('forno.listAll' , compact('fornos','filtroDtInicial','filtroDtFinal'));
    }

    public function formAdd()
    {
        $user_id            = Auth::user()->id;
        $fornos             = forno::orderby('id')->get();
        $produtos           = produto::orderby('produto')->get();
        return view('forno.add',compact('fornos','produtos'));
    }
    public function strore(Request $request)
    {
        try{
            $forno = new forno([
                "user_id"           => Auth::user()->id
                , "id_forno"        => $request->id_forno
                , "data"            => $request->data
                , "produto"         => $request->produto
                , "QntGrade"        => $request->QntGrade
                , "CodPro"          => $request->CodPro
                , "peso"            => $request->peso
                , "dim_externa"     => $request->dim_externa
                , "dim_parede"      => $request->dim_parede
                , "umidade"         => $request->umidade
                , "resistencia"     => $request->resistencia
                , "lote"            => $request->lote
                , "residuo"         => $request->residuo
                , "name"            =>$request->name
            ]);
            $forno->save();
        }catch(\Exception $e){
            return response()->json($e);
        }
        return response()->json('success');
    }

    public function formEdit($id_forno)
    {
        $fornos = forno::where('id','=',$id_forno)->first();
        $produtos   = produto::orderby('produto')->get();

        return view('forno.edit' , compact('fornos','produtos'));
    }

    public function edit($id_forno, Request $request)
    {
        try{
            $forno = forno::find($id_forno);
            $forno->id_forno            = $request->id_forno;
            $forno->data		        = $request->data;
            $forno->produto             = $request->produto;
            $forno->QntGrade            = $request->QntGrade;
            $forno->CodPro              = $request->CodPro;
            $forno->peso                = $request->peso;
            $forno->dim_externa         = $request->dim_externa;
            $forno->dim_parede          = $request->dim_parede;
            $forno->umidade             = $request->umidade;
            $forno->resistencia         = $request->resistencia;
            $forno->lote                = $request->lote;
            $forno->residuo             = $request->residuo;
            $forno->save();
        }catch(\Exception $e){
            return response()->json($forno);
        }
        return response()->json('success');
    }



}
