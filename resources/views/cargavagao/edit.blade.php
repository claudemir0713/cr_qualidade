@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Alteração de Carga de Vagão</h3><hr>
    <form action="" id="cadastro-cargavagao" nome="cadastro-cargavagao" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/cargavagao/edit/{{$cargavagao->id_cargavagao}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="cargavagao">
        <div class="row">
            <div class="form-group limpar col-md-2">
                Data
                <input class="form-control" type="date" name="data" id="data"  value="{{ date('Y-m-d') }}" >
            </div>
            <div class="form-group limpar col-md-2">
                Lote
                <input class="form-control limpar" type="text" name="lote" id="lote">
            </div>
            <div class="form-group limpar col-md-6">
                Produto
                <select class="form-control limpar" type="text" name="produto" id="produto">
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
                <input class="form-control limpar" type="text" name="peso" id="peso">
            </div>
            <div class="form-group limpar col-md-2">
                Dimensões Externas
                <input class="form-control limpar" type="text" name="dim_externa" id="dim_externa">
            </div>
            <div class="form-group limpar col-md-2">
                Dimensão da Parede
                <input class="form-control limpar" type="text" name="dim_parede" id="dim_parede">
            </div>
            <div class="form-group limpar col-md-2">
                Umidade
                <input class="form-control limpar" type="text" name="umidade" id="umidade">
            </div>
            <div class="form-group limpar col-md-2">
                Resistencia
                <input class="form-control limpar" type="text" name="resistencia" id="resistencia">
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
                $(location).attr('href',url+'/cargavagao');
            })
        })
    </script>

@endsection
