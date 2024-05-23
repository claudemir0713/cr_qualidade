<?php

namespace App\Http\Controllers\forno;

use App\Http\Controllers\Controller;
use App\Models\extrusora;
use App\Models\User;
use App\Models\produto;
use App\Models\forno;
use App\Models\forno_imagem;
use App\Models\historico;
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
                                        ->leftJoin('historico','historico.id','forno.historico')
                                        ->leftJoin('extrusora','extrusora.id','forno.lote')
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
                                            , 'historico.historico'
                                            , 'forno.absorcao'
                                            , 'extrusora.lote as lote_extrusora'
                                            , DB::raw("(SELECT count(*)  FROM forno_imagem WHERE forno_id = forno.id) qtdAnexo")
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
        $historicos         = historico::orderby('historico')->get();
        $extrusoras         = extrusora::orderby('id')->get();
        return view('forno.add',compact('fornos','produtos','historicos','extrusoras'));
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
                , "name"            => $request->name
                , "historico"       => $request->historico
                , "absorcao"        => $request->absorcao
                , "lote_extrusora"  => $request->lote_extrusora
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
        $historicos = historico::orderby('historico')->get();

        return view('forno.edit' , compact('fornos','produtos','historicos'));
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
            $forno->historico           = $request->historico;
            $forno->absorcao            = $request->absorcao;
            $forno->lote_extrusora      = $request->lote_extrusora;
            $forno->save();
        }catch(\Exception $e){
            return response()->json($forno);
        }
        return response()->json('success');
    }

    public function fornoAnexo($forno){
        $fornos=forno::find($forno);
        $forno_imagem=forno_imagem::where('forno_id',$forno)->get();
        // dd($forno);
        return view('forno.anexo',compact('fornos','forno_imagem'));
    }

    public function upload(Request $request){
        // dd($request);
        $nome=$request->nomeArquivo;
        $id=$request->forno_id;
        if (!$request->file('arquivo')){
            return redirect()->route('forno.anexo',["forno"=>$id]);
        }
        $extensao=$request->file('arquivo')->guessExtension();
        $forno=forno::find($id);
        // dd($forno,$id);

        // dd($forno);
        $forno_imagem= new forno_imagem([
            "forno_id"=>$id
        ]);
        $forno_imagem->save();
        $imagem_id=$forno_imagem->id;
        $nomearquivo=$forno->lote_extrusora.'_'.$imagem_id.'.'.$extensao;
        $forno_imagem=forno_imagem::find($imagem_id);
        $forno_imagem->anexo=$nomearquivo;
        $forno_imagem->save();

        $request->file('arquivo')->storeAs('public/'.$forno->lote,$nomearquivo);
        return redirect()->route('forno.fornoAnexo',["forno"=>$id]);

    }

    public function destroyAnexo(Request $request, $id)
    {
        $forno_id=forno_imagem::find($id)->forno_id;
        // dd($forno_id);
        forno_imagem::find($id)->delete();
        return redirect()->route('forno.fornoAnexo',['forno'=>$forno_id]);
    }
}
