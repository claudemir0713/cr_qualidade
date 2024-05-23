<?php

namespace App\Http\Controllers\laboratorio;

use App\Http\Controllers\Controller;
use App\Models\laboratorio;
use App\Models\User;
use App\Models\produto;
use App\Models\extrusora;
use App\Models\laboratorio_imagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class laboratorioController extends Controller
{

    public function listAll(Request $request ){

        $filtros=[];

        $user = user::where('email','=',Auth::user()->email)->first();
        $filtrouser = $user->id;
        $userSelecionado = $request->user;

        // $nivel = Auth::user()->nivel;
        // if($nivel!='admin'){
        //     $filtros[]=['laboratorio.user_id','=',$user->id];
        // };
        // if($nivel=='admin'){
        //     $user = user::where('ativo','S')->orderBy('name')->get();
        //     $filtrouser = $user;
        //     $filtrouser  = ($request->get('user'))? $request->user : session('filtrouser');

        //     if($userSelecionado=="0"){ $filtrouser = "0";};

        //     session()->put('filtrouser', $filtrouser);

        //     if($filtrouser>0){
        //         $filtros[]=['laboratorio.user_id','=',$filtrouser];
        //     }
        // }else{
        //     $filtros[]=['laboratorio.user_id','>','0'];
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
            $filtros[]=['laboratorio.data','>=',$filtroDtInicial];
            $filtros[]=['laboratorio.data','<=',$filtroDtFinal];
        }
        // DB::connection()->enableQueryLog();
        $laboratorios = laboratorio:: leftJoin('users','users.id','laboratorio.user_id')
                                        ->leftJoin('produto','produto.CodProd','laboratorio.produto')
                                        ->leftJoin('extrusora','extrusora.id','laboratorio.lote')
                                        ->where($filtros)
                                        ->orderBy('data','desc')
                                        ->orderBy('id_laboratorio','desc')
                                        ->get([
                                            'laboratorio.id as id_laboratorio'
                                            , 'laboratorio.user_id'
                                            , 'laboratorio.data'
                                            , 'produto.CodProd'
                                            , 'produto.Produto'
                                            , 'laboratorio.absorcao'
                                            , 'laboratorio.resistencia'
                                            , 'laboratorio.lote'
                                            , 'extrusora.lote as lote_extrusora'
                                            , 'users.name'
                                            , DB::raw("(SELECT count(*)  FROM laboratorio_imagem WHERE laboratorio_id = laboratorio.id) qtdAnexo")
                                    ]);
        // $queries = DB::getQueryLog();
        // dd($queries);
        return view('laboratorio.listAll' , compact('laboratorios','filtroDtInicial','filtroDtFinal'));
    }

    public function formAdd()
    {
        $user_id            = Auth::user()->id;
        $laboratorios       = laboratorio::orderby('id')->get();
        $produtos           = produto::orderby('produto')->get();
        $extrusoras         = extrusora::orderby('id')->get();
        return view('laboratorio.add',compact('laboratorios','produtos','extrusoras'));
    }
    public function strore(Request $request)
    {
        try{
            $laboratorio = new laboratorio([
                "user_id"           => Auth::user()->id
                , "id_laboratorio"  => $request->id_laboratorio
                , "data"            => $request->data
                , "produto"         => $request->produto
                , "CodPro"          => $request->CodPro
                , "absorcao"        => $request->absorcao
                , "resistencia"     => $request->resistencia
                , "lote"            => $request->lote
                , "lote_extrusora"  => $request->lote_extrusora
                , "name"            => $request->name
            ]);
            $laboratorio->save();
        }catch(\Exception $e){
            return response()->json($e);
        }
        return response()->json('success');
    }

    public function formEdit($id_laboratorio)
    {
        $laboratorios = laboratorio::where('id','=',$id_laboratorio)->first();
        $produtos   = produto::orderby('produto')->get();
        $extrusoras = extrusora::orderby('id')->get();

        return view('laboratorio.edit' , compact('laboratorios','produtos','extrusoras'));
    }

    public function edit($id_laboratorio, Request $request)
    {
        try{
            $laboratorio = laboratorio::find($id_laboratorio);
            $laboratorio->id_laboratorio      = $request->id_laboratorio;
            $laboratorio->data		          = $request->data;
            $laboratorio->produto             = $request->produto;
            $laboratorio->CodPro              = $request->CodPro;
            $laboratorio->absorcao            = $request->absorcao;
            $laboratorio->resistencia         = $request->resistencia;
            $laboratorio->lote                = $request->lote;
            $laboratorio->lote_extrusora      = $request->lote_extrusora;
            $laboratorio->name                = $request->name;
            $laboratorio->save();
        }catch(\Exception $e){
            return response()->json($laboratorio);
        }
        return response()->json('success');
    }

    public function laboratorioAnexo($laboratorio){
        $laboratorios=laboratorio::find($laboratorio);
        $laboratorio_imagem=laboratorio_imagem::where('laboratorio_id',$laboratorio)->get();
        // dd($laboratorio);
        return view('laboratorio.anexo',compact('laboratorios','laboratorio_imagem'));
    }

    public function upload(Request $request){
        // dd($request);
        $nome=$request->nomeArquivo;
        $id=$request->laboratorio_id;
        if (!$request->file('arquivo')){
            return redirect()->route('laboratorio.anexo',["laboratorio"=>$id]);
        }
        $extensao=$request->file('arquivo')->guessExtension();
        $laboratorio=laboratorio::find($id);
        // dd($laboratorio,$id);

        // dd($laboratorio);
        $laboratorio_imagem= new laboratorio_imagem([
            "laboratorio_id"=>$id
        ]);
        $laboratorio_imagem->save();
        $imagem_id=$laboratorio_imagem->id;
        $nomearquivo=$laboratorio->lote_extrusora.'_'.$imagem_id.'.'.$extensao;
        $laboratorio_imagem=laboratorio_imagem::find($imagem_id);
        $laboratorio_imagem->anexo=$nomearquivo;
        $laboratorio_imagem->save();

        $request->file('arquivo')->storeAs('public/'.$laboratorio->lote,$nomearquivo);
        return redirect()->route('laboratorio.laboratorioAnexo',["laboratorio"=>$id]);

    }

    public function destroyAnexo(Request $request, $id)
    {
        $laboratorio_id=laboratorio_imagem::find($id)->laboratorio_id;
        // dd($laboratorio_id);
        laboratorio_imagem::find($id)->delete();
        return redirect()->route('laboratorio.laboratorioAnexo',['laboratorio'=>$laboratorio_id]);
    }
}
