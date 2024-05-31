@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Apontamento de Laboratorio</h3><hr>
    <form action="" id="cadastro-laboratorio" nome="cadastro-laboratorio" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/laboratorio/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="laboratorio">

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
                Resistencia
                <input class="form-control limpar" type="number" step="any" name="resistencia" id="resistencia">
            </div>
            <div class="form-group limpar col-md-2">
                Absorção de Água
                <input class="form-control limpar" type="number" step="any" name="absorcao" id="absorcao">
            </div>
            <div class="form-group limpar col-md-2">
                Largura
                <input class="form-control limpar" type="number" step="any" name="largura" id="largura">
            </div>
            <div class="form-group limpar col-md-2">
                Altura
                <input class="form-control limpar" type="number" step="any" name="altura" id="altura">
            </div>
        </div>
        <div class="row">

            <div class="form-group limpar col-md-2">
                Comprimento
                <input class="form-control limpar" type="number" step="any" name="comprimento" id="comprimento">
            </div>
            <div class="form-group limpar col-md-2">
                Parede Externa
                <input class="form-control limpar" type="number" step="any" name="parede_ext" id="parede_ext">
            </div>
            <div class="form-group limpar col-md-2">
                Septos
                <input class="form-control limpar" type="number" step="any" name="septos" id="septos">
            </div>
            <div class="form-group limpar col-md-2">
                Planeza
                <input class="form-control limpar" type="number" step="any" name="planeza" id="planeza">
            </div>
            </div>
        <div class="row">
            <div class="form-group limpar col-md-2">
                Esquadro
                <input class="form-control limpar" type="number" step="any" name="esquadro" id="esquadro">
            </div>
            <div class="form-group limpar col-md-2">
                Densidade
                <input class="form-control limpar" type="number" step="any" name="densidade" id="densidade">
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
