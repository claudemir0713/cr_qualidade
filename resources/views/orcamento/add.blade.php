@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-hand-holding-usd"></i> Orcamento</h3>
    <form action="" id="cadastro-orcamento" nome="cadastro-orcamento" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/orcamento/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="orcamento">
        <hr>
        <div class="row">
            <div class="form-group col-md-4">
                Cliente:
                <input class="form-control limpar focus" type="text" name="cliente" id="cliente" value="" autofocus>
            </div>
            <div class="form-group col-md-2">
                Artigo:
                <input class="form-control limpar" type="text" name="artigo" id="artigo" value="">
            </div>
            <div class="form-group col-md-2">
                Data:
                <input class="form-control limpa" type="date" name="data" id="data" value="{{date('Y-m-d')}}">
            </div>
            <div class="form-group col-md-2">
                Data entrega:
                <input class="form-control limpa" type="date" name="data" id="data" value="{{date('Y-m-d',strtotime('+30 days',strtotime(date('y-m-d'))))}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                Qtd Pacotes:
                <input class="form-control limpa qtd_pc_pronta" type="number" step="any" name="qtd_pacotes" id="qtd_pacotes" value="300">
            </div>
            <div class="form-group col-md-2">
                Peças Pacotes:
                <input class="form-control limpa qtd_pc_pronta" type="number" step="any" name="pecas_pacotes" id="pecas_pacotes" value="1">
            </div>
            <div class="form-group col-md-2">
                Total de Peças:
                <input class="form-control limpa" type="number" step="any" name="pecas_total" id="pecas_total" value="" readonly>
            </div>
            <div class="form-group col-md-2">
                Moeda:
                <select class="form-control limpa" name="moeda" id="moeda">
                    <option value="">Selecione</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                Cotação:
                <input class="form-control limpa" type="number" step="any" name="moeda_petax" id="moeda_petax" value="">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                Descrição
                <textarea class="form-control limpa" name="descricao" id="descricao" rows="3"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <div class="card">
                    <div class="card-header" align="center">
                        <h4><b><i>Insumos</i></b></h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-condensed fonte-12">
                            <thead>
                                <tr>
                                    <th width="5%">COD.</th>
                                    <th width="20%">INSUMO</th>
                                    <th width="5%">UND</th>
                                    <th width="5%">QTD 1/PÇ</th>
                                    <th width="5%">QUEBRA(%)</th>
                                    <th width="5%">QTD TOTAL</th>
                                    <th width="5%">PREÇO</th>
                                    <th width="5%">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $insumos as $key=>$item )
                                    <tr>
                                        <td class="alinhamentoCentro">{{$item->codigo}}</td>
                                        <td class="alinhamentoCentro">{{$item->produto}}</td>
                                        <td class="alinhamentoCentro">{{$item->un}}</td>
                                        <td> <input type="text" step="any" class="form-control semBorda direita calcula_qtd_total" id="qtd_pc{{$key}}" name="qtd_pc"> </td>
                                        <td> <input type="text" step="any" class="form-control semBorda direita calcula_qtd_total" id="quebra{{$key}}" name="quebra" value="{{number_format($item->quebra,3,',','.')}}"> </td>
                                        <td> <input type="text" step="any" class="form-control semBorda direita qtd_total" id="qtd_total{{$key}}" name="qtd_total" readonly> </td>
                                        <td> <input type="text" step="any" class="form-control semBorda direita calcula_qtd_total" id="preco{{$key}}" name="preco" value="{{number_format($item->custo,3,',','.')}}" > </td>
                                        <td> <input type="text" step="any" class="form-control semBorda direita total" id="total{{$key}}" name="total" readonly> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>
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
                $(location).attr('href',url+'/orcamento');
            })
        })
    </script>

@endsection
