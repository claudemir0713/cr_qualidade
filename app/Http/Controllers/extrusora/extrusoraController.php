<?php

namespace App\Http\Controllers\extrusora;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\produto;
use App\Models\extrusora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class extrusoraController extends Controller
{

    public function listAll(Request $request ){

        $filtros=[];

        $user = user::where('email','=',Auth::user()->email)->first();
        $filtrouser = $user->id;
        $userSelecionado = $request->user;

        $nivel = Auth::user()->nivel;
        if($nivel!='admin'){
            $filtros[]=['extrusora.user_id','=',$user->id];
        };
        if($nivel=='admin'){
            $user = user::where('ativo','S')->orderBy('name')->get();
            $filtrouser = $user;
            $filtrouser  = ($request->get('user'))? $request->user : session('filtrouser');

            if($userSelecionado=="0"){ $filtrouser = "0";};

            session()->put('filtrouser', $filtrouser);

            if($filtrouser>0){
                $filtros[]=['extrusora.user_id','=',$filtrouser];
            }
        }else{
            $filtros[]=['extrusora.user_id','>','0'];
            $user = user::where('Id','=',$user)->get();
        }

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
            $filtros[]=['extrusora.data','>=',$filtroDtInicial];
            $filtros[]=['extrusora.data','<=',$filtroDtFinal];
        }
        // DB::connection()->enableQueryLog();
        $extrusoras = extrusora:: leftJoin('users','users.id','extrusora.user_id')
                                        ->leftJoin('produto','produto.CodProd','extrusora.produto')
                                        ->where($filtros)
                                        ->orderBy('data','desc')
                                        ->orderBy('id_extrusora','desc')
                                        ->get([
                                            'extrusora.id as id_extrusora'
                                            , 'extrusora.user_id'
                                            , 'extrusora.data'
                                            , 'produto.CodProd'
                                            , 'produto.Produto'
                                            , 'produto.QntGrade'
                                            , 'produto.CodPro'
                                            , 'extrusora.peso'
                                            , 'extrusora.dim_externa'
                                            , 'extrusora.dim_parede'
                                            , 'extrusora.vacuo'
                                            , 'extrusora.durometro'
                                            , 'extrusora.residuo'
                                            , 'extrusora.turno'
                                            , 'users.name'
                                    ]);
        // $queries = DB::getQueryLog();
        // dd($queries);
        return view('extrusora.listAll' , compact('extrusoras','filtroDtInicial','filtroDtFinal'));
    }

    public function formAdd()
    {
        $user_id            = Auth::user()->id;
        $extrusoras         = extrusora::orderby('id')->get();
        $produtos           = produto::orderby('produto')->get();
        return view('extrusora.add',compact('extrusoras','produtos'));
    }
    public function strore(Request $request)
    {
        try{
            $extrusora = new extrusora([
                "user_id"           => Auth::user()->id
                , "id_extrusora"    => $request->id_extrusora
                , "data"            => $request->data
                , "Produto"         => $request->Produto
                , "QntGrade"        => $request->QntGrade
                , "CodPro"          => $request->CodPro
                , "peso"            => $request->peso
                , "dim_externa"     => $request->dim_externa
                , "dim_parede"      => $request->dim_parede
                , "vacuo"           => $request->vacuo
                , "residuo"         => $request->residuo
                , "turno"           => $request->turno
                , "name"            =>$request->name
            ]);
            $extrusora->save();
        }catch(\Exception $e){
            return response()->json($e);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $extrusora = extrusora::where('id','=',$id)->first();
        $produtos           = produto::orderby('produto')->get();

        return view('extrusora.edit' , compact('extrusora','produtos'));
    }

    public function edit($id, Request $request)
    {
        try{
            $extrusora = extrusora::find($id);
            $extrusora->id_extrusora        = $request->id_extrusora;
            $extrusora->data		        = $request->data;
            $extrusora->Produto             = $request->Produto;
            $extrusora->QntGrade            = $request->QntGrade;
            $extrusora->CodPro              = $request->CodPro;
            $extrusora->peso                = $request->peso;
            $extrusora->dim_externa         = $request->dim_externa;
            $extrusora->dim_parede          = $request->dim_parede;
            $extrusora->vacuo               = $request->vacuo;
            $extrusora->residuo             = $request->residuo;
            $extrusora->turno               = $request->turno;
            $extrusora->save();
        }catch(\Exception $e){
            return response()->json($extrusora);
        }
        return response()->json('success');
    }



}
