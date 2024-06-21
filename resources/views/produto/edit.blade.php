@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Alteração de Produto</h3><hr>
    <form action="" id="cadastro-produto" nome="cadastro-produto" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/produto/edit/{{$produto->CodProd}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="produto">

        <div class="row">
            <div class="form-group limpar col-md-4">
                Produto
                <input class="form-control limpar" type="text" name="Produto" id="Produto" value="{{ $produto->Produto }}">
            </div>
            <div class="form-group col-md-2">
                Quantidade por Grade
                <input class="form-control limpar" type="number" name="QntGrade" id="QntGrade" value="{{ $produto->QntGrade }}">
            </div>
            <div class="form-group col-md-2">
                Codigo Produto Senior
                <input class="form-control limpar" type="text" name="CodPro" id="CodPro" value="{{ $produto->CodPro }}">
            </div>
        </div>
        <h6 class=""><i class="far fa-edit"></i> Parametros da Extrusora</h6><hr>
        <div class="row">
            <div class="form-group col-md-2">
                Peos Mínimo
                <input class="form-control limpar" type="number" step="any" name="extrusora_pesoi" id="extrusora_pesoi" value="{{ $produto->extrusora_pesoi }}">
            </div>
            <div class="form-group col-md-2">
                Peso Máximo
                <input class="form-control limpar" type="number" step="any" name="extrusora_pesos" id="extrusora_pesos" value="{{ $produto->extrusora_pesos }}">
            </div>
            <div class="form-group col-md-2">
                Altura Mínima
                <input class="form-control limpar" type="number" step="any" name="extrusora_alturai" id="extrusora_alturai" value="{{ $produto->extrusora_alturai }}">
            </div>
            <div class="form-group col-md-2">
                Altura Máxima
                <input class="form-control limpar" type="number" step="any" name="extrusora_alturas" id="extrusora_alturas" value="{{ $produto->extrusora_alturas }}">
            </div>
            <div class="form-group col-md-2">
                Largura Mínima
                <input class="form-control limpar" type="number" step="any" name="extrusora_largurai" id="extrusora_largurai" value="{{ $produto->extrusora_largurai }}">
            </div>
            <div class="form-group col-md-2">
                Largura Máxima
                <input class="form-control limpar" type="number" step="any" name="extrusora_larguras" id="extrusora_larguras" value="{{ $produto->extrusora_larguras }}">
            </div>
            <div class="form-group col-md-2">
                Comprimento Mínimo
                <input class="form-control limpar" type="number" step="any" name="extrusora_comprimentoi" id="extrusora_comprimentoi" value="{{ $produto->extrusora_comprimentoi }}">
            </div>
            <div class="form-group col-md-2">
                Comprimento Mámimo
                <input class="form-control limpar" type="number" step="any" name="extrusora_comprimentos" id="extrusora_comprimentos" value="{{ $produto->extrusora_comprimentos }}">
            </div>
            <div class="form-group col-md-2">
                Dim. Parede Mínima
                <input class="form-control limpar" type="number" step="any" name="extrusora_dim_paredei" id="extrusora_dim_paredei" value="{{ $produto->extrusora_dim_paredei }}">
            </div>
            <div class="form-group col-md-2">
                Dim. Parede Máxima
                <input class="form-control limpar" type="number" step="any" name="extrusora_dim_paredes" id="extrusora_dim_paredes" value="{{ $produto->extrusora_dim_paredes }}">
            </div>
            <div class="form-group col-md-2">
                Umidade Mínima
                <input class="form-control limpar" type="number" step="any" name="extrusora_umidadei" id="extrusora_umidadei" value="{{ $produto->extrusora_umidadei }}">
            </div>
            <div class="form-group col-md-2">
                Umidade Máxima
                <input class="form-control limpar" type="number" step="any" name="extrusora_umidades" id="extrusora_umidades" value="{{ $produto->extrusora_umidades }}">
            </div>
            <div class="form-group col-md-2">
                Vácuo Mímino
                <input class="form-control limpar" type="number" step="any" name="extrusora_vacuoi" id="extrusora_vacuoi" value="{{ $produto->extrusora_vacuoi }}">
            </div>
            <div class="form-group col-md-2">
                Vácuo Máximo
                <input class="form-control limpar" type="number" step="any" name="extrusora_vacuos" id="extrusora_vacuos" value="{{ $produto->extrusora_vacuos }}">
            </div>
            <div class="form-group col-md-2">
                Durmometro Mínimo
                <input class="form-control limpar" type="number" step="any" name="extrusora_durometroi" id="extrusora_durometroi" value="{{ $produto->extrusora_durometroi }}">
            </div>
            <div class="form-group col-md-2">
                Durometro Máximo
                <input class="form-control limpar" type="number" step="any" name="extrusora_durometros" id="extrusora_durometros" value="{{ $produto->extrusora_durometros }}">
            </div>
        </div>
        <h6 class=""><i class="fas fa-chevron-down"></i> Parametros da Carga de Vagão</h6><hr>
        <div class="row">
            <div class="form-group col-md-2">
                Peso Mínimo
                <input class="form-control limpar" type="number" step="any" name="cargavagao_pesoi" id="cargavagao_pesoi" value="{{ $produto->cargavagao_pesoi }}">
            </div>
            <div class="form-group col-md-2">
                Peso Máximo
                <input class="form-control limpar" type="number" step="any" name="cargavagao_pesos" id="cargavagao_pesos" value="{{ $produto->cargavagao_pesos }}">
            </div>
            <div class="form-group col-md-2">
                Dim. Extrtena Mínima
                <input class="form-control limpar" type="number" step="any" name="cargavagao_dim_externai" id="cargavagao_dim_externai" value="{{ $produto->cargavagao_dim_externai }}">
            </div>
            <div class="form-group col-md-2">
                Dim. Externa Máxima
                <input class="form-control limpar" type="number" step="any" name="cargavagao_dim_externas" id="cargavagao_dim_externas" value="{{ $produto->cargavagao_dim_externas }}">
            </div>
            <div class="form-group col-md-2">
                Dim. Parede Mínima
                <input class="form-control limpar" type="number" step="any" name="cargavagao_dim_paredei" id="cargavagao_dim_paredei" value="{{ $produto->cargavagao_dim_paredei }}">
            </div>
            <div class="form-group col-md-2">
                Dim. Parede Máxima
                <input class="form-control limpar" type="number" step="any" name="cargavagao_dim_paredes" id="cargavagao_dim_paredes" value="{{ $produto->cargavagao_dim_paredes }}">
            </div>
            <div class="form-group col-md-2">
                Umidade Mínima
                <input class="form-control limpar" type="number" step="any" name="cargavagao_umidadei" id="cargavagao_umidadei" value="{{ $produto->cargavagao_umidadei }}">
            </div>
            <div class="form-group col-md-2">
                Umidade Máxima
                <input class="form-control limpar" type="number" step="any" name="cargavagao_umidades" id="cargavagao_umidades" value="{{ $produto->cargavagao_umidades }}">
            </div>
            <div class="form-group col-md-2">
                Resistencia Mínima
                <input class="form-control limpar" type="number" step="any" name="cargavagao_resistenciai" id="cargavagao_resistenciai" value="{{ $produto->cargavagao_resistenciai }}">
            </div>
            <div class="form-group col-md-2">
                Resistencia Máxima
                <input class="form-control limpar" type="number" step="any" name="cargavagao_resistencias" id="cargavagao_resistencias" value="{{ $produto->cargavagao_resistencias }}">
            </div>
        </div>
        <h6 class=""><i class="fas fa-igloo"></i> Parametros do Forno</h6><hr>
        <div class="row">
            <div class="form-group col-md-2">
                Peso Mínimo
                <input class="form-control limpar" type="number" step="any" name="forno_pesoi" id="forno_pesoi" value="{{ $produto->forno_pesoi }}">
            </div>
            <div class="form-group col-md-2">
                Peso Máximo
                <input class="form-control limpar" type="number" step="any" name="forno_pesos" id="forno_pesos" value="{{ $produto->forno_pesos }}">
            </div>
            <div class="form-group col-md-2">
                Dim. Parede Mínima
                <input class="form-control limpar" type="number" step="any" name="forno_dim_paredei" id="forno_dim_paredei" value="{{ $produto->forno_dim_paredei }}">
            </div>
            <div class="form-group col-md-2">
                Dim. Parede Máxima
                <input class="form-control limpar" type="number" step="any" name="forno_dim_paredes" id="forno_dim_paredes" value="{{ $produto->forno_dim_paredes }}">
            </div>
            <div class="form-group col-md-2">
                Resistencia Mínima
                <input class="form-control limpar" type="number" step="any" name="forno_resistenciai" id="forno_resistenciai" value="{{ $produto->forno_resistenciai }}">
            </div>
            <div class="form-group col-md-2">
                Resistencia Máxima
                <input class="form-control limpar" type="number" step="any" name="forno_resistencias" id="forno_resistencias" value="{{ $produto->forno_resistencias }}">
            </div>
            <div class="form-group col-md-2">
                Absorção Mínima
                <input class="form-control limpar" type="number" step="any" name="forno_absorcaoi" id="forno_absorcaoi" value="{{ $produto->forno_absorcaoi }}">
            </div>
            <div class="form-group col-md-2">
                Absorção Máxima
                <input class="form-control limpar" type="number" step="any" name="forno_absorcaos" id="forno_absorcaos" value="{{ $produto->forno_absorcaos }}">
            </div>
        </div>
        <h6 class=""><i class="fas fa-flask"></i> Parametros do Laboratório</h6><hr>
        <div class="row">
            <div class="form-group col-md-2">
                Resistência Mínima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_resistenciai" id="laboratorio_resistenciai" value="{{ $produto->laboratorio_resistenciai }}">
            </div>
            <div class="form-group col-md-2">
                Resistência Máxima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_resistencias" id="laboratorio_resistencias" value="{{ $produto->laboratorio_resistencias }}">
            </div>
            <div class="form-group col-md-2">
                Absorção Mínima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_absorcaoi" id="laboratorio_absorcaoi" value="{{ $produto->laboratorio_absorcaoi }}">
            </div>
            <div class="form-group col-md-2">
                Absorção Máxima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_absorcaos" id="laboratorio_absorcaos" value="{{ $produto->laboratorio_absorcaos }}">
            </div>
            <div class="form-group col-md-2">
                Largura Mínima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_largurai" id="laboratorio_largurai" value="{{ $produto->laboratorio_largurai }}">
            </div>
            <div class="form-group col-md-2">
                Largura Máxima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_larguras" id="laboratorio_larguras" value="{{ $produto->laboratorio_larguras }}">
            </div>
            <div class="form-group col-md-2">
                Altura Mínima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_alturai" id="laboratorio_alturai" value="{{ $produto->laboratorio_alturai }}">
            </div>
            <div class="form-group col-md-2">
                Altura Máxima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_alturas" id="laboratorio_alturas" value="{{ $produto->laboratorio_alturas }}">
            </div>
            <div class="form-group col-md-2">
                Comprimento Mínimo
                <input class="form-control limpar" type="number" step="any" name="laboratorio_comprimentoi" id="laboratorio_comprimentoi" value="{{ $produto->laboratorio_comprimentoi }}">
            </div>
            <div class="form-group col-md-2">
                Comprimento Máximo
                <input class="form-control limpar" type="number" step="any" name="laboratorio_comprimentos" id="laboratorio_comprimentos" value="{{ $produto->laboratorio_comprimentos }}">
            </div>
            <div class="form-group col-md-2">
                Parede Ext. Mínima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_parede_externai" id="laboratorio_parede_externai" value="{{ $produto->laboratorio_parede_externai }}">
            </div>
            <div class="form-group col-md-2">
                Parede Ext. Máxima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_parede_externas" id="laboratorio_parede_externas" value="{{ $produto->laboratorio_parede_externas }}">
            </div>
            <div class="form-group col-md-2">
                Septos Mínimo
                <input class="form-control limpar" type="number" step="any" name="laboratorio_septosi" id="laboratorio_septosi" value="{{ $produto->laboratorio_septosi }}">
            </div>
            <div class="form-group col-md-2">
                Septos Máximo
                <input class="form-control limpar" type="number" step="any" name="laboratorio_septoss" id="laboratorio_septoss" value="{{ $produto->laboratorio_septoss }}">
            </div>
            <div class="form-group col-md-2">
                Planeza Mínima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_planezai" id="laboratorio_planezai" value="{{ $produto->laboratorio_planezai }}">
            </div>
            <div class="form-group col-md-2">
                Planeza Máxima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_planezas" id="laboratorio_planezas" value="{{ $produto->laboratorio_planezas }}">
            </div>
            <div class="form-group col-md-2">
                Esquadro Mínimo
                <input class="form-control limpar" type="number" step="any" name="laboratorio_esquadroi" id="laboratorio_esquadroi" value="{{ $produto->laboratorio_esquadroi }}">
            </div>
            <div class="form-group col-md-2">
                Esquadro Máximo
                <input class="form-control limpar" type="number" step="any" name="laboratorio_esquadros" id="laboratorio_esquadros" value="{{ $produto->laboratorio_esquadros }}">
            </div>
            <div class="form-group col-md-2">
                Densidade Mínima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_densidadei" id="laboratorio_densidadei" value="{{ $produto->laboratorio_densidadei }}">
            </div>
            <div class="form-group col-md-2">
                Densidade Máxima
                <input class="form-control limpar" type="number" step="any" name="laboratorio_densidades" id="laboratorio_densidades" value="{{ $produto->laboratorio_densidades }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="" id="salvar" class="btn btn-success btn-block">
                    <span class="fas fa-save"></span> Salvar
                </button>
            </div>
                <div class="form-group col-md-3">
                    <button type="button" name="sair" id="sair" value="" class="btn btn-danger btn-block">
                        <span class="fa fa-door-open"></span> Sair
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function(){

            $('button#sair').click(function(){
                $(location).attr('href',url+'/Produto');
            })
        })
    </script>

@endsection
