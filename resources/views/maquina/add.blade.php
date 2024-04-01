@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Cadastro de Maquinas</h3><hr>
    <form action="" id="cadastro-maquina" nome="cadastro-maquina" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/Maquina/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="maquina">

        <div class="row">
            <div class="form-group limpar col-md-4">
                Maquina
                <input class="form-control limpar" type="text" name="Maquina" id="Maquina">
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
                $(location).attr('href',url+'/Maquina');
            })
        })
    </script>

@endsection
