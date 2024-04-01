@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Cadastro de Produtos</h3><hr>
    <form action="" id="cadastro-produto" nome="cadastro-produto" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/Produto/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="Produto">

        <div class="row">
            <div class="form-group limpar col-md-4">
                Produto
                <input class="form-control limpar" type="text" name="Produto" id="Produto">
            </div>
            <div class="form-group col-md-2">
                Quantidade por Grade
                <input class="form-control limpar" type="number" name="QntGrade" id="QntGrade">
            </div>
            <div class="form-group col-md-2">
                Codigo Produto Senior
                <input class="form-control limpar" type="text" name="CodPro" id="CodPro">
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
