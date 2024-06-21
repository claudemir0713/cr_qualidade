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

        $laboratorios = laboratorio:: leftJoin('users','users.id','laboratorio.user_id')
                                        ->leftJoin('extrusora','extrusora.id','laboratorio.extrusora_id')
                                        ->leftJoin('produto','produto.CodProd','laboratorio.produto_id')
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
                                            , 'laboratorio.extrusora_id'
                                            , 'laboratorio.produto_id'
                                            , 'users.name'
                                            , 'extrusora.lote'
                                            , 'laboratorio.largura'
                                            , 'laboratorio.altura'
                                            , 'laboratorio.comprimento'
                                            , 'laboratorio.parede_ext'
                                            , 'laboratorio.septos'
                                            , 'laboratorio.planeza'
                                            , 'laboratorio.esquadro'
                                            , 'laboratorio.densidade'
                                            , 'produto.laboratorio_resistenciai'
                                            , 'produto.laboratorio_resistencias'
                                            , 'produto.laboratorio_absorcaoi'
                                            , 'produto.laboratorio_absorcaos'
                                            , 'produto.laboratorio_largurai'
                                            , 'produto.laboratorio_larguras'
                                            , 'produto.laboratorio_alturai'
                                            , 'produto.laboratorio_alturas'
                                            , 'produto.laboratorio_comprimentoi'
                                            , 'produto.laboratorio_comprimentos'
                                            , 'produto.laboratorio_parede_externai'
                                            , 'produto.laboratorio_parede_externas'
                                            , 'produto.laboratorio_septosi'
                                            , 'produto.laboratorio_septoss'
                                            , 'produto.laboratorio_planezai'
                                            , 'produto.laboratorio_planezas'
                                            , 'produto.laboratorio_esquadroi'
                                            , 'produto.laboratorio_esquadros'
                                            , 'produto.laboratorio_densidadei'
                                            , 'produto.laboratorio_densidades'
                                            , DB::raw("(SELECT count(*)  FROM laboratorio_imagem WHERE laboratorio_id = laboratorio.id) qtdAnexo")
                                    ]);

        return view('laboratorio.listAll' , compact('laboratorios','dateForm'));
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
                , "extrusora_id"    => $request->extrusora_id
                , "produto_id"      => $request->produto_id
                , "name"            => $request->name
                , "largura"         => $request->largura
                , "altura"          => $request->altura
                , "comprimento"     => $request->comprimento
                , "parede_ext"      => $request->parede_ext
                , "septos"          => $request->septos
                , "planeza"         => $request->planeza
                , "esquadro"        => $request->esquadro
                , "densidade"       => $request->densidade
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
            $laboratorio->extrusora_id        = $request->extrusora_id;
            $laboratorio->produto_id          = $request->produto_id;
            $laboratorio->name                = $request->name;
            $laboratorio->largura             = $request->largura;
            $laboratorio->altura              = $request->altura;
            $laboratorio->comprimento         = $request->comprimento;
            $laboratorio->parede_ext          = $request->parede_ext;
            $laboratorio->septos              = $request->septos;
            $laboratorio->planeza             = $request->planeza;
            $laboratorio->esquadro            = $request->esquadro;
            $laboratorio->densidade           = $request->densidade;
            $laboratorio->save();
        }catch(\Exception $e){
            return response()->json($laboratorio);
        }
        return response()->json('success');
    }

    public function laboratorioAnexo($laboratorio){
        // dd($laboratorio);
        $laboratorios=laboratorio::find($laboratorio);
        $extrusora_id = $laboratorios->extrusora_id;
        $extrusoras = extrusora::find($extrusora_id);
        $laboratorio_imagem=laboratorio_imagem::where('laboratorio_id',$laboratorio)->get();
        // dd($laboratorio);
        return view('laboratorio.anexo',compact('laboratorios','laboratorio_imagem','extrusoras'));
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
        $extrusora_id = $laboratorio->extrusora_id;
        $extrusora=extrusora::find($extrusora_id);

        $laboratorio_imagem= new laboratorio_imagem([
            "laboratorio_id"=>$id
        ]);
        $laboratorio_imagem->save();
        $imagem_id=$laboratorio_imagem->id;
        $nomearquivo=$laboratorio->lote.'_'.$imagem_id.'.'.$extensao;
        $laboratorio_imagem=laboratorio_imagem::find($imagem_id);
        $laboratorio_imagem->anexo=$nomearquivo;
        $laboratorio_imagem->save();

        $request->file('arquivo')->storeAs('public/laboratorio/'.$extrusora->lote,$nomearquivo);
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
