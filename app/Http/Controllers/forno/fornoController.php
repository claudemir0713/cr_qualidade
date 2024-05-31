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
        $dateForm = $request->except('_token');
        // dd($dateForm);
        $filtros=[];

        $user = user::where('email','=',Auth::user()->email)->first();
        $filtrouser = $user->id;
        $userSelecionado = $request->user;

        if(array_key_exists('dtI',$dateForm)){
            if($dateForm['dtI']){
                $filtros[]=['cargavagao.data','>=',$dateForm['dtI']];
                session()->put('dtI', $dateForm['dtI']);
            }
        }
        if(array_key_exists('dtF',$dateForm)){
            if($dateForm['dtF']){
                $filtros[]=['cargavagao.data','<=',$dateForm['dtF']];
                session()->put('dtF', $dateForm['dtF']);
            }
        }
        session()->put('dateForm',$dateForm);

        $fornos = forno:: leftJoin('users','users.id','forno.user_id')
                                        ->leftJoin('produto','produto.CodProd','forno.produto_id')
                                        ->leftJoin('historico','historico.id','forno.historico_id')
                                        ->leftJoin('extrusora','extrusora.id','forno.extrusora_id')
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
                                            , 'forno.resistencia'
                                            , 'forno.extrusora_id'
                                            , 'forno.residuo'
                                            , 'users.name'
                                            , 'historico.historico'
                                            , 'forno.absorcao'
                                            , 'extrusora.lote'
                                            , 'forno.produto_id'
                                            , 'forno.historico_id'
                                            , DB::raw("(SELECT count(*)  FROM forno_imagem WHERE forno_id = forno.id) qtdAnexo")
                                    ]);
        // $queries = DB::getQueryLog();
        // dd($queries);
        return view('forno.listAll' , compact('fornos','dateForm'));
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
                , "resistencia"     => $request->resistencia
                , "extrusora_id"    => $request->extrusora_id
                , "residuo"         => $request->residuo
                , "name"            => $request->name
                , "historico"       => $request->historico
                , "absorcao"        => $request->absorcao
                , "lote"            => $request->lote
                , "produto_id"      => $request->produto_id
                , "historico_id"    => $request->historico_id
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
        $extrusoras = extrusora::orderby('id')->get();

        return view('forno.edit' , compact('fornos','produtos','historicos'));
    }

    public function edit($id_forno, Request $request)
    {
        try{
            $forno = forno::find($id_forno);
            $forno->id_forno            = $request->id_forno;
            $forno->data		        = $request->data;
            $forno->produto_id          = $request->produto_id;
            $forno->QntGrade            = $request->QntGrade;
            $forno->CodPro              = $request->CodPro;
            $forno->peso                = $request->peso;
            $forno->dim_externa         = $request->dim_externa;
            $forno->dim_parede          = $request->dim_parede;
            $forno->resistencia         = $request->resistencia;
            $forno->extrusora_id        = $request->extrusora_id;
            $forno->residuo             = $request->residuo;
            $forno->historico           = $request->historico;
            $forno->absorcao            = $request->absorcao;
            $forno->lote                = $request->lote;
            $forno->produto_id          = $request->produto_id;
            $forno->historico_id        = $request->historico_id;
            $forno->save();
        }catch(\Exception $e){
            return response()->json($forno);
        }
        return response()->json('success');
    }

    public function fornoAnexo($forno){
        $fornos=forno::find($forno);
        $extrusora_id = $fornos->extrusora_id;
        $extrusoras = extrusora::find($extrusora_id);
        $forno_imagem=forno_imagem::where('forno_id',$forno)->get();
        return view('forno.anexo',compact('fornos','forno_imagem','extrusoras'));
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
        $extrusora_id = $forno->extrusora_id;
        $extrusora=extrusora::find($extrusora_id);

        $forno_imagem= new forno_imagem([
            "forno_id"=>$id
        ]);
        $forno_imagem->save();
        $imagem_id=$forno_imagem->id;
        $nomearquivo=$forno->lote.'_'.$imagem_id.'.'.$extensao;
        $forno_imagem=forno_imagem::find($imagem_id);
        $forno_imagem->anexo=$nomearquivo;
        $forno_imagem->save();

        $request->file('arquivo')->storeAs('public/forno/'.$forno->lote,$nomearquivo);
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
