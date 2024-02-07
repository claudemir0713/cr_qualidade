@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-funnel-dollar"></i> Produto</h3>
    <form action="" id="cadastro-produto" nome="cadastro-produto" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/produto/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="produto">
        <hr>
        <div class="row">
            <div class="form-group col-md-2">
                Codigo:
                <input class="form-control limpar focus" type="text" name="codigo" id="codigo" value="" autofocus>
            </div>
            <div class="form-group col-md-4">
                Produto:
                <input class="form-control limpar" type="text" name="produto" id="produto" value="">
            </div>
            <div class="form-group col-md-2">
                Und:
                <select id="un" name="un" class="form-control">
                    @foreach ($und as $item )
                        <option value="{{$item->und}}">{{$item->und}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Quebra(%):
                <input class="form-control limpar direita" type="text" name="quebra" id="quebra" value="">
            </div>
            <div class="form-group col-md-2">
                R$ Custo:
                <input class="form-control limpar direita" type="text" name="custo" id="custo" value="">
            </div>
            <div class="form-group col-md-2">
                Ativo:
                <select id="status" name="status" class="form-control">
                    <option value="S">Sim</option>
                    <option value="N">Não</option>
                </select>
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
                $(location).attr('href',url+'/produto');
            })
        })
    </script>

@endsection
