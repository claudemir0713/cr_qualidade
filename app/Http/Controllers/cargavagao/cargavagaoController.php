<?php

namespace App\Http\Controllers\cargavagao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\produto;
use App\Models\cargavagao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class cargavagaoController extends Controller
{

    public function listAll(Request $request ){

        $filtros=[];

        $user = user::where('email','=',Auth::user()->email)->first();
        $filtrouser = $user->id;
        $userSelecionado = $request->user;

        $nivel = Auth::user()->nivel;
        if($nivel!='admin'){
            $filtros[]=['cargavagao.user_id','=',$user->id];
        };
        if($nivel=='admin'){
            $user = user::where('ativo','S')->orderBy('name')->get();
            $filtrouser = $user;
            $filtrouser  = ($request->get('user'))? $request->user : session('filtrouser');

            if($userSelecionado=="0"){ $filtrouser = "0";};

            session()->put('filtrouser', $filtrouser);

            if($filtrouser>0){
                $filtros[]=['cargavagao.user_id','=',$filtrouser];
            }
        }else{
            $filtros[]=['cargavagao.user_id','>','0'];
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
            $filtros[]=['cargavagao.data','>=',$filtroDtInicial];
            $filtros[]=['cargavagao.data','<=',$filtroDtFinal];
        }
        // DB::connection()->enableQueryLog();
        $cargavagoes = cargavagao:: leftJoin('users','users.id','cargavagao.user_id')
                                        ->leftJoin('produto','produto.CodProd','cargavagao.produto')
                                        ->where($filtros)
                                        ->orderBy('data','desc')
                                        ->orderBy('id_extrusora','desc')
                                        ->get([
                                            'cargavagao.id as id_cargavagao'
                                            , 'cargavagao.user_id'
                                            , 'cargavagao.data'
                                            , 'produto.CodProd'
                                            , 'produto.Produto'
                                            , 'produto.QntGrade'
                                            , 'produto.CodPro'
                                            , 'cargavagao.peso'
                                            , 'cargavagao.dim_externa'
                                            , 'cargavagao.dim_parede'
                                            , 'cargavagao.umidade'
                                            , 'cargavagao.resistencia'
                                            , 'cargavagao.lote'
                                            , 'users.name'
                                    ]);
        // $queries = DB::getQueryLog();
        // dd($queries);
        return view('cargavagao.listAll' , compact('cargavagoes','filtroDtInicial','filtroDtFinal'));
    }

    public function formAdd()
    {
        $user_id            = Auth::user()->id;
        $cargavagoes        = cargavagao::orderby('id')->get();
        $produtos           = produto::orderby('produto')->get();
        return view('cargavagao.add',compact('cargavagoes','produtos'));
    }
    public function strore(Request $request)
    {
        try{
            $cargavagao = new cargavagao([
                "user_id"           => Auth::user()->id
                , "id_cargavagao"   => $request->id_cargavagao
                , "data"            => $request->data
                , "Produto"         => $request->Produto
                , "QntGrade"        => $request->QntGrade
                , "CodPro"          => $request->CodPro
                , "peso"            => $request->peso
                , "dim_externa"     => $request->dim_externa
                , "dim_parede"      => $request->dim_parede
                , "umidade"         => $request->umidade
                , "resistencia"     => $request->resistencia
                , "lote"            => $request->lote
                , "name"            =>$request->name
            ]);
            $cargavagao->save();
        }catch(\Exception $e){
            return response()->json($e);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $cargavagao = cargavagao::where('id','=',$id)->first();
        $produtos   = produto::orderby('produto')->get();

        return view('cargavagao.edit' , compact('cargavagao','produtos'));
    }

    public function edit($id, Request $request)
    {
        try{
            $cargavagao = cargavagao::find($id);
            $cargavagao->id_cargavagao       = $request->id_cargavagao;
            $cargavagao->data		         = $request->data;
            $cargavagao->Produto             = $request->Produto;
            $cargavagao->QntGrade            = $request->QntGrade;
            $cargavagao->CodPro              = $request->CodPro;
            $cargavagao->peso                = $request->peso;
            $cargavagao->dim_externa         = $request->dim_externa;
            $cargavagao->dim_parede          = $request->dim_parede;
            $cargavagao->umidade             = $request->umidade;
            $cargavagao->resistencia         = $request->resistencia;
            $cargavagao->lote                = $request->lote;
            $cargavagao->save();
        }catch(\Exception $e){
            return response()->json($cargavagao);
        }
        return response()->json('success');
    }



}
