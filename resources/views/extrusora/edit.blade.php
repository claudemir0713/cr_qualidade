@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Alteração de Matéria Prima</h3><hr>
    <form action="" id="cadastro-materiaprima" nome="cadastro-materiaprima" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/materiaprima/edit/{{$materiaprima->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="materiaprima">
        <div class="row">
            <div class="form-group col-md-4">
                Matéria Prima
                <input class="form-control" type="text" name="materiaprima" id="materiaprima" value="{{ $materiaprima->materiaprima }}">
            </div>
            <div class="form-group col-md-4">
                Unidade
                <input class="form-control" type="text" name="unidade" id="unidade" value="{{ $materiaprima->unidade }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="{{$materiaprima->id}}" id="salvar" class="btn btn-success btn-block">
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
                $(location).attr('href',url+'/materiaprima');
            })
        })

    </script>

@endsection
