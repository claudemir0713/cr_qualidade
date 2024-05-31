<?php

namespace App\Http\Controllers\cargavagao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\produto;
use App\Models\cargavagao;
use App\Models\cargavagao_imagem;
use App\Models\extrusora;
use App\Models\historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class cargavagaoController extends Controller
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

        $cargavagoes = cargavagao:: leftJoin('users','users.id','cargavagao.user_id')
                                        ->leftJoin('historico','historico.id','cargavagao.historico_id')
                                        ->leftJoin('extrusora','extrusora.id','cargavagao.extrusora_id')
                                        ->leftJoin('produto','produto.CodProd','cargavagao.produto_id')
                                        ->where($filtros)
                                        ->orderBy('data','desc')
                                        ->orderBy('id_cargavagao','desc')
                                        ->get([
                                            'cargavagao.id as id_cargavagao'
                                            , 'cargavagao.user_id'
                                            , 'cargavagao.data'
                                            , 'produto.CodProd'
                                            , 'produto.Produto'
                                            , 'cargavagao.peso'
                                            , 'cargavagao.dim_externa'
                                            , 'cargavagao.dim_parede'
                                            , 'cargavagao.umidade'
                                            , 'cargavagao.resistencia'
                                            , 'cargavagao.extrusora_id'
                                            , 'users.name'
                                            , 'cargavagao.perda'
                                            , 'historico.historico'
                                            , 'extrusora.lote'
                                            , DB::raw("(SELECT count(*)  FROM cargavagao_imagem WHERE cargavagao_id = cargavagao.id) qtdAnexo")
                                    ]);
        // $queries = DB::getQueryLog();
        // dd($queries);
        return view('cargavagao.listAll' , compact('cargavagoes','dateForm'));
    }

    public function formAdd()
    {
        $user_id            = Auth::user()->id;
        $cargavagoes        = cargavagao::orderby('id')->get();
        $produtos           = produto::orderby('produto')->get();
        $historicos         = historico::orderby('historico')->get();
        $extrusoras         = extrusora::orderby('id')->get();
        return view('cargavagao.add',compact('cargavagoes','produtos','historicos','extrusoras'));
    }
    public function strore(Request $request)
    {
        try{
            $cargavagao = new cargavagao([
                "user_id"           => Auth::user()->id
                , "id_cargavagao"   => $request->id_cargavagao
                , "data"            => $request->data
                , "produto_id"      => $request->produto_id
                , "peso"            => $request->peso
                , "dim_externa"     => $request->dim_externa
                , "dim_parede"      => $request->dim_parede
                , "umidade"         => $request->umidade
                , "resistencia"     => $request->resistencia
                , "extrusora_id"    => $request->extrusora_id
                , "name"            => $request->name
                , "perda"           => $request->perda
                , "historico_id"    => $request->historico_id
                , "lote"            => $request->lote
            ]);
            $cargavagao->save();
        }catch(\Exception $e){
            return response()->json($e);
        }
        return response()->json('success');
    }

    public function formEdit($id_cargavagao)
    {
        $cargavagoes = cargavagao::where('id','=',$id_cargavagao)->first();
        $produtos    = produto::orderby('produto')->get();
        $historicos  = historico::orderby('historico')->get();
        $extrusoras  = extrusora::orderby('id')->get();

        return view('cargavagao.edit' , compact('cargavagoes','produtos','historicos','extrusoras'));
    }

    public function edit($id_cargavagao, Request $request)
    {
        try{
            $cargavagao = cargavagao::find($id_cargavagao);
            $cargavagao->id_cargavagao       = $request->id_cargavagao;
            $cargavagao->data		         = $request->data;
            $cargavagao->produto_id          = $request->produto_id;
            $cargavagao->peso                = $request->peso;
            $cargavagao->dim_externa         = $request->dim_externa;
            $cargavagao->dim_parede          = $request->dim_parede;
            $cargavagao->umidade             = $request->umidade;
            $cargavagao->resistencia         = $request->resistencia;
            $cargavagao->extrusora_id        = $request->extrusora_id;
            $cargavagao->perda               = $request->perda;
            $cargavagao->historico_id        = $request->historico_id;
            $cargavagao->lote                = $request->lote;
            $cargavagao->save();
        }catch(\Exception $e){
            return response()->json($cargavagao);
        }
        return response()->json('success');
    }
    public function cargavagaoAnexo($cargavagao){

        $cargavagoes=cargavagao::find($cargavagao);
        $extrusora_id = $cargavagoes->extrusora_id;
        $extrusoras = extrusora::find($extrusora_id);
        $cargavagao_imagem=cargavagao_imagem::where('cargavagao_id',$cargavagao)->get();
        // dd($cargavagao);
        return view('cargavagao.anexo',compact('cargavagoes','cargavagao_imagem','extrusoras'));
    }

    public function upload(Request $request){
        // dd($request);
        $nome=$request->nomeArquivo;
        $id=$request->cargavagao_id;
        if (!$request->file('arquivo')){
            return redirect()->route('cargavagao.anexo',["cargavagao"=>$id]);
        }
        $extensao=$request->file('arquivo')->guessExtension();
        $cargavagao=cargavagao::find($id);
        $extrusora_id = $cargavagao->extrusora_id;
        $extrusora=extrusora::find($extrusora_id);

        $cargavagao_imagem= new cargavagao_imagem([
            "cargavagao_id"=>$id
        ]);
        $cargavagao_imagem->save();
        $imagem_id=$cargavagao_imagem->id;
        $nomearquivo=$cargavagao->lote.'_'.$imagem_id.'.'.$extensao;
        $cargavagao_imagem=cargavagao_imagem::find($imagem_id);
        $cargavagao_imagem->anexo=$nomearquivo;
        $cargavagao_imagem->save();

        $request->file('arquivo')->storeAs('public/cargaVagao/'.$extrusora->lote,$nomearquivo);
        return redirect()->route('cargavagao.cargavagaoAnexo',["cargavagao"=>$id]);

    }

    public function destroyAnexo(Request $request, $id)
    {
        $cargavagao_id=cargavagao_imagem::find($id)->cargavagao_id;
        // dd($cargavagao_id);
        cargavagao_imagem::find($id)->delete();
        return redirect()->route('cargavagao.cargavagaoAnexo',['cargavagao'=>$cargavagao_id]);
    }
}
