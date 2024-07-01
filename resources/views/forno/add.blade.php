@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Apontamento de Forno</h3><hr>
    <form action="" id="cadastro-forno" nome="cadastro-forno" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/forno/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="forno">

        <div class="row">
            <div class="form-group limpar col-md-2">
                Data
                <input class="form-control" type="date" name="data" id="data"  value="{{ date('Y-m-d') }}" >
            </div>
            <div class="form-group limpar col-md-2">
                Lote
                <select class="form-control limpar" type="text" name="extrusora_id" id="extrusora_id">
                <option value="%">Todas</option>
                @foreach ($extrusoras as $item )
                    <option value="{{ $item->id }}">{{ $item->lote }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group limpar col-md-4">
                Produto
                <select class="form-control limpar" type="text" name="produto_id" id="produto_id">
                    <option value="%">Todas</option>
                    @foreach ($produtos as $produto )
                        <option value="{{ $produto->CodProd }}">{{ $produto->Produto }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group limpar col-md-2">
                Peso
                <input class="form-control limpar" type="number" step="any" name="peso" id="peso">
            </div>
            <div class="form-group limpar col-md-2">
                Largura da Parede
                <input class="form-control limpar" type="number" step="any" name="dim_parede" id="dim_parede">
            </div>
            <div class="form-group limpar col-md-2">
                Resistencia
                <input class="form-control limpar" type="number" step="any" name="resistencia" id="resistencia">
            </div>
            <div class="form-group limpar col-md-2">
                Absorção de Águas
                <input class="form-control limpar" type="number" step="any" name="absorcao" id="absorcao">
            </div>
        </div>
        <div class="row">
            <div class="form-group limpar col-md-2">
                Residuo
                <input class="form-control limpar" type="number" step="any" name="residuo" id="residuo">
            </div>
            <div class="form-group limpar col-md-6">
                Historico de Residuo
                <select class="form-control limpar" type="text" name="historico_id" id="historico_id">
                    <option value=0>Todas</option>
                    @foreach ($historicos as $historico )
                        <option value="{{ $historico->id }}">{{ $historico->historico }}</option>
                    @endforeach
                </select>
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
                $(location).attr('href',url+'/forno');
            })
        })
    </script>

@endsection
