@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Alteração do Movimento do Laboratorio</h3><hr>
    <form action="" id="cadastro-laboratorio" nome="cadastro-laboratorio" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/laboratorio/edit/{{$laboratorios->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="laboratorio">

        <div class="row">
            <div class="form-group limpar col-md-2">
                Data
                <input class="form-control" type="date" name="data" id="data"  value="{{$laboratorios->data}}" >
            </div>
            <div class="form-group limpar col-md-2">
                Lote
                <select class="form-control limpar" type="text" name="lote" id="lote" >
                    <option value="%">Todas</option>
                    @foreach ($extrusoras as $extrusora )
                        <option value="{{ $extrusora->id }}" {{ $extrusora->id==$laboratorios->lote ? 'selected' : '' }}>{{ $extrusora->lote }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group limpar col-md-4">
                Produto
                <select class="form-control limpar" type="text" name="produto" id="produto">
                    <option value="%">Todas</option>
                    @foreach ($produtos as $produto )
                        <option value="{{ $produto->CodProd }}" {{ $produto->CodProd==$laboratorios->produto ? 'selected' : '' }}>{{ $produto->Produto }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group limpar col-md-2">
                Resistencia
                <input class="form-control limpar" type="text" name="resistencia" id="resistencia" value="{{$laboratorios->resistencia}}">
            </div>
            <div class="form-group limpar col-md-2">
                Absorção de Águas
                <input class="form-control limpar" type="text" name="absorcao" id="absorcao" value="{{$laboratorios->absorcao}}">
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
                $(location).attr('href',url+'/laboratorio');
            })
        })
    </script>

@endsection
