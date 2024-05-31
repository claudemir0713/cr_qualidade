@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Apontamento da Extrusora</h3><hr>
    <form action="" id="cadastro-extrusora" nome="cadastro-extrusora" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/extrusora/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="extrusora">

        <div class="row">
            <div class="form-group limpar col-md-3">
                Data
                <input class="form-control" type="date" name="data" id="data"  value="{{ date('Y-m-d') }}" >
            </div>
            <div class="form-group limpar col-md-1">
                Turno
                <select class="form-control limpar" type="text" name="turno" id="turno">
                    <option value="">Selecione</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </div>
            <div class="form-group limpar col-md-6">
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
                <input class="form-control limpar" type="text" name="peso" id="peso">
            </div>
            <div class="form-group limpar col-md-2">
                Altura
                <input class="form-control limpar" type="text" name="altura" id="altura">
            </div>
            <div class="form-group limpar col-md-2">
                Largura
                <input class="form-control limpar" type="text" name="largura" id="largura">
            </div>
            <div class="form-group limpar col-md-2">
                Comprimento
                <input class="form-control limpar" type="text" name="comprimento" id="comprimento">
            </div>
            <div class="form-group limpar col-md-2">
                Dim. Parede Externa
                <input class="form-control limpar" type="text" name="dim_parede" id="dim_parede">
            </div>
        </div>
            <div class="row">
            <div class="form-group limpar col-md-2">
                Vacuo
                <input class="form-control limpar" type="text" name="vacuo" id="vacuo">
            </div>
            <div class="form-group limpar col-md-2">
                Durometro
                <input class="form-control limpar" type="text" name="durometro" id="durometro">
            </div>
            <div class="form-group limpar col-md-2">
                Umidade
                <input class="form-control limpar" type="text" name="umidade" id="umidade">
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
                $(location).attr('href',url+'/extrusora');
            })
        })
    </script>

@endsection
