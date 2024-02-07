@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-donate"></i> Ptax ( {{ $moeda_ptax[0]->simbolo }} )</h3>
    <form action="" id="cadastro-moedaPtax" nome="cadastro-moedaPtax" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/moeda/storePtax">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="moedaPetax/{{ $moeda_ptax[0]->id }}">
        <input type="hidden" name="moeda_id" id="moeda_id" value="{{ $moeda_ptax[0]->id }}">
        <input type="hidden" name="moeda_cod" id="moeda_cod" value="{{ $moeda_ptax[0]->simbolo }}">

        <div class="row">
            <div class="form-group col-md-2">
                Data:
                <input class="form-control focus" type="date" name="dataPatx" id="dataPatx" value="{{date('Y-m-d')}}" autofocus>
            </div>
            <div class="form-group col-md-2">
                Ptax:
                <input class="form-control limpar" type="number" step="any" name="ptax" id="ptax" value="">
            </div>
            <div class="form-group col-md-2">
                <br>
                <button type="submit" name="salvar" value="" id="salvar" class="btn btn-success btn-block">
                    <span class="fas fa-save"></span> Salvar
                </button>
            </div>
                <div class="form-group col-md-2">
                    <br>
                    <button type="button" name="sair" id="sair" value="" class="btn btn-danger btn-block">
                        <span class="fa fa-door-open"></span> Sair
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function(){
            var moeda_id = $(document).find('#moeda_id').val()
            console.log(moeda_id);
            $('button#sair').click(function(){
                $(location).attr('href',url+'/moeda/moedaPetax/'+moeda_id);
            })
        })
    </script>

@endsection
