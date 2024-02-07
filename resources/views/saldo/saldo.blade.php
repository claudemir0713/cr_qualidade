@extends('layouts.model')
@section('content')
    <form action="">
        @csrf
        <div class="row">
            <div class="form-group col-md-8">
                <h3>
                    <i class="fa fa-braille"></i> Saldo
                </h3>
            </div>
            <div class="form-group col-md-3">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="5%">Banco</th>
                            <th width="5%">Agência</th>
                            <th width="5%">Contas</th>
                            <th width="5%">Nome</th>
                            <th width="5%">Data</th>
                            <th width="5%">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($saldo as $key=>$item )
                            <tr>
                                <td>{{$item->banco}}</td>
                                <td>{{$item->agencia}}</td>
                                <td>{{$item->conta}}</td>
                                <td>{{$item->nomeBanco}}</td>
                                <td>
                                    <input type="date" class="semBorda alinhaDireita"  id="data{{$key}}" name="data[]" value="{{$item->data}}">
                                </td>
                                <td align="right">
                                    <input type="text" class="semBorda alinhaDireita formataValor saldo" banco_id="{{$item->id}}" id="saldo{{$key}}" name="saldo[]" value="{{number_format($item->valor,2,',','.')}}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <td>saldo</td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
