<?php

namespace App\Http\Controllers\extrusora;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\produto;
use App\Models\extrusora;
use App\Models\extrusora_imagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class extrusoraController extends Controller
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
                $filtros[]=['extrusora.data','>=',$dateForm['dtI']];
                session()->put('dtI', $dateForm['dtI']);
            }
        }
        if(array_key_exists('dtF',$dateForm)){
            if($dateForm['dtF']){
                $filtros[]=['extrusora.data','<=',$dateForm['dtF']];
                session()->put('dtF', $dateForm['dtF']);
            }
        }
        if(array_key_exists('lote',$dateForm)){
            if($dateForm['lote']){
                $filtros=[];
                $filtros[]=['extrusora.lote','=',$dateForm['lote']];
                session()->put('lote', $dateForm['lote']);
            }
        }
        session()->put('dateForm',$dateForm);

        $extrusoras = extrusora:: leftJoin('users','users.id','extrusora.user_id')
                                        ->leftJoin('produto','produto.CodProd','extrusora.produto_id')
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
                                            , 'extrusora.turno'
                                            , 'users.name'
                                            , 'extrusora.altura'
                                            , 'extrusora.largura'
                                            , 'extrusora.comprimento'
                                            , 'extrusora.umidade'
                                            , 'extrusora.lote'
                                            , DB::raw("(SELECT count(*)  FROM extrusora_imagem WHERE extrusora_id = extrusora.id) qtdAnexo")
                                    ]);
        return view('extrusora.listAll' , compact('extrusoras','dateForm'));
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
        $arr_data=explode('-',$request->data);
        $lote = $arr_data[2].$arr_data[1].substr($arr_data[0],2,2).$request->turno;
        try{
            $extrusora = new extrusora([
                "data"              => $request->data
                , "user_id"         => Auth::user()->id
                , "produto_id"      => $request->produto_id
                , "peso"            => $request->peso
                , "dim_externa"     => $request->dim_externa
                , "dim_parede"      => $request->dim_parede
                , "vacuo"           => $request->vacuo
                , "durometro"       => $request->durometro
                , "turno"           => $request->turno
                , "altura"          => $request->altura
                , "largura"         => $request->largura
                , "comprimento"     => $request->comprimento
                , "umidade"         => $request->umidade
                , "lote"            => $lote
            ]);
            $extrusora->save();
        }catch(\Exception $e){
            return response()->json($e);
        }
        return response()->json('success');
    }

    public function formEdit($id_extrusora)
    {
        $extrusoras = extrusora::where('id','=',$id_extrusora)->first();
        $produtos           = produto::orderby('produto')->get();

        return view('extrusora.edit' , compact('extrusoras','produtos'));
    }

    public function edit($id_extrusora, Request $request)
    {
        $arr_data=explode('-',$request->data);
        $lote = $arr_data[2].$arr_data[1].substr($arr_data[0],2,2).$request->turno;
        try{
            $extrusora = extrusora::find($id_extrusora);
            $extrusora->data		        = $request->data;
            $extrusora->produto_id          = $request->produto_id;
            $extrusora->peso                = $request->peso;
            $extrusora->dim_externa         = $request->dim_externa;
            $extrusora->dim_parede          = $request->dim_parede;
            $extrusora->vacuo               = $request->vacuo;
            $extrusora->durometro           = $request->durometro;
            $extrusora->turno               = $request->turno;
            $extrusora->altura              = $request->altura;
            $extrusora->largura             = $request->largura;
            $extrusora->comprimento         = $request->comprimento;
            $extrusora->umidade             = $request->umidade;
            $extrusora->lote                = $lote;
            $extrusora->save();
        }catch(\Exception $e){
            return response()->json($extrusora);
        }
        return response()->json('success');
    }

    public function extrusoraAnexo($extrusora){
        $extrusoras=extrusora::find($extrusora);
        $extrusora_imagem=extrusora_imagem::where('extrusora_id',$extrusora)->get();
        // dd($extrusora);
        return view('extrusora.anexo',compact('extrusoras','extrusora_imagem'));
    }

    public function upload(Request $request){
        // dd($request);
        $nome=$request->nomeArquivo;
        $id=$request->extrusora_id;
        if (!$request->file('arquivo')){
            return redirect()->route('extrusora.anexo',["extrusora"=>$id]);
        }
        $extensao=$request->file('arquivo')->guessExtension();
        $extrusora=extrusora::find($id);
        // dd($extrusora,$id);

        // dd($extrusora);
        $extrusora_imagem= new extrusora_imagem([
            "extrusora_id"=>$id
        ]);
        $extrusora_imagem->save();
        $imagem_id=$extrusora_imagem->id;
        $nomearquivo=$extrusora->lote.'_'.$imagem_id.'.'.$extensao;
        $extrusora_imagem=extrusora_imagem::find($imagem_id);
        $extrusora_imagem->anexo=$nomearquivo;
        $extrusora_imagem->save();

        $request->file('arquivo')->storeAs('public/extrusora/'.$extrusora->lote,$nomearquivo);
        return redirect()->route('extrusora.extrusoraAnexo',["extrusora"=>$id]);

    }

    public function destroyAnexo(Request $request, $id)
    {
        $extrusora_id=extrusora_imagem::find($id)->extrusora_id;
        // dd($extrusora_id);
        extrusora_imagem::find($id)->delete();
        return redirect()->route('extrusora.extrusoraAnexo',['extrusora'=>$extrusora_id]);
    }
}
