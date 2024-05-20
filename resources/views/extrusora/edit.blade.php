@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Alteração de Apontamento na Extrusora</h3><hr>
    <form action="" id="cadastro-extrusora" nome="cadastro-extrusora" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/extrusora/edit/{{$extrusoras->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="extrusora">
        <div class="row">
            <div class="form-group limpar col-md-3">
                Data
                <input class="form-control" type="date" name="data" id="data"  value="{{$extrusoras->data}}" >
            </div>
            <div class="form-group limpar col-md-1">
                Turno
                <select class="form-control limpar" type="text" name="turno" id="turno">
                    <option value="">Selecione</option>
                    <option value="A"{{($extrusoras->turno=='A')? 'selected' :''}}>A</option>
                    <option value="B"{{($extrusoras->turno=='B')? 'selected' :''}}>B</option>
                    <option value="C"{{($extrusoras->turno=='C')? 'selected' :''}}>C</option>
                    <option value="D"{{($extrusoras->turno=='D')? 'selected' :''}}>D</option>
                    <option value="E"{{($extrusoras->turno=='E')? 'selected' :''}}>E</option>
                </select>
            </div>
            <div class="form-group limpar col-md-6">
                Produto
                <select class="form-control limpar" type="text" name="produto" id="produto">
                    <option value="%">Todas</option>
                    @foreach ($produtos as $produto )
                        <option value="{{ $produto->CodProd }}" {{ $produto->CodProd==$extrusoras->produto ? 'selected' : '' }}>{{ $produto->Produto }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group limpar col-md-2">
                Peso
                <input class="form-control limpar" type="text" name="peso" id="peso" value="{{$extrusoras->peso}}">
            </div>
            <div class="form-group limpar col-md-2">
                Altura
                <input class="form-control limpar" type="text" name="altura" id="altura" value="{{$extrusoras->altura}}">
            </div>
            <div class="form-group limpar col-md-2">
                Largura
                <input class="form-control limpar" type="text" name="largura" id="largura" value="{{$extrusoras->largura}}">
            </div>
            <div class="form-group limpar col-md-2">
                Comprimento
                <input class="form-control limpar" type="text" name="comprimento" id="comprimento" value="{{$extrusoras->comprimento}}">
            </div>
            <div class="form-group limpar col-md-2">
                Dim. Parede Externa
                <input class="form-control limpar" type="text" name="dim_parede" id="dim_parede" value="{{$extrusoras->dim_parede}}">
            </div>
        </div>
            <div class="row">
            <div class="form-group limpar col-md-2">
                Vacuo
                <input class="form-control limpar" type="text" name="vacuo" id="vacuo" value="{{$extrusoras->vacuo}}">
            </div>
            <div class="form-group limpar col-md-2">
                Durometro
                <input class="form-control limpar" type="text" name="durometro" id="durometro" value="{{$extrusoras->durometro}}">
            </div>
            <div class="form-group limpar col-md-2">
                Umidade
                <input class="form-control limpar" type="text" name="umidade" id="umidade" value="{{$extrusoras->umidade}}">
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
