@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-laptop"></i> Apontamento dos Fornos
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('forno.add')}}">
                        <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;
                        <span>Novo</span>
                    </a>
                </h3>
            </td>
        </tr>
    </table><hr>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <span class="fas fa-filter"></span> Filtros
    </button><p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form method="get" action="{{ route('forno.listAll') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        Data Incial
                        <input class="form-control" type="date" name="dtI" id="dtI" value="{{array_key_exists('dtI',$dateForm) ? $dateForm['dtI'] : ''}}">
                    </div>
                    <div class="form-group col-md-3">
                        Data Final
                        <input class="form-control" type="date" name="dtF" id="dtF" value="{{array_key_exists('dtF',$dateForm) ? $dateForm['dtF'] : ''}}">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" >
                    <span class="fas fa-play"></span> Filtrar
                </button>
            </form >
        </div>
    </div>
    <p>

    <table class="table table-bordered table-condensed table-striped fonte-20">
        <thead>
            <tr>
                <th width="5%">Data</th>
                <th width="10%">Operador</th>
                <th width="10%">Lote</th>
                <th width="20%">Produto</th>
                <th width="3%">Peso</th>
                <th width="3%">Dimensão da Parede</th>
                <th width="3%">Resistencia</th>
                <th width="3%">Absorcao</th>
                <th width="3%">Residuo</th>
                <th width="10%">Historico</th>
                <th width="5%" data-field="name">Upload</th>
                <th width="1%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fornos as $forno)
                <tr>
                    <td> {{ date('d/m/Y', strtotime($forno->data)) }} </td>
                    <td> {{ $forno->name }} </td>
                    <td> {{ $forno->lote }} </td>
                    <td> {{ $forno->Produto }} </td>
                    <td align="right"> {{ number_format( $forno->peso,2,',','.')  }} </td>
                    <td align="right"> {{ number_format( $forno->dim_parede,2,',','.')  }} </td>
                    <td align="right"> {{ number_format( $forno->resistencia,2,',','.')  }} </td>
                    <td align="right"> {{ number_format( $forno->absorcao,2,',','.') }} </td>
                    <td align="right"> {{ number_format( $forno->residuo,2,',','.') }} </td>
                    <td align="right"> {{ $forno->historico }} </td>
                    <td align="">
                        @php
                            ($forno->qtdAnexo<=0)? $tipoBtn='danger' : $tipoBtn='info'
                        @endphp
                        <a class="btn btn-{{$tipoBtn}}" href="{{route('forno.fornoAnexo',$forno->id_forno)}}" target="_blank">
                            <i class="fa fa-upload"></i>
                        </a>
                    </td>
                    <td>
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('forno.formEdit', $forno->id_forno)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    {{-- <form action=" {{ route('forno.destroy',['forno'=> $forno->id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='forno' value=" {{ $forno->id }} ">
                                        <i class="far fa-trash-alt"></i>
                                        <input type="submit" class="btn btn-default delete"  value="Eliminar"> --}}
                                    </form>
                                </a>
                            </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    {{-- {{$Operadores->links()}} --}}
@endsection
