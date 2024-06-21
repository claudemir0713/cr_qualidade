@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-laptop"></i> Apontamento da Extrusora
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('extrusora.add')}}">
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
            <form method="get" action="{{ route('extrusora.listAll') }}">
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
                    <div class="form-group col-md-3">
                        Lote
                        <input class="form-control" type="text" name="lote" id="lote" value="{{array_key_exists('lote',$dateForm) ? $dateForm['lote'] : ''}}">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" >
                    <span class="fas fa-play"></span> Filtrar
                </button>
            </div>
            </form >
        </div>
    </div>
    <p>

    <table class="table table-bordered table-condensed table-striped fonte-20">
        <thead>
            <tr>
                <th width="5%">Data</th>
                <th width="5%">Turno</th>
                <th width="10%">Operador</th>
                <th width="30%">Produto</th>
                <th width="5%">Peso</th>
                <th width="5%">Altura</th>
                <th width="5%">Largura</th>
                <th width="5%">Comprimento</th>
                <th width="5%">Dimensao da Parede</th>
                <th width="5%">Umidade</th>
                <th width="5%">Vacuo</th>
                <th width="5%">Durometro</th>
                <th width="5%" data-field="name">Upload</th>
                <th width="5%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($extrusoras as $extrusora)
                <tr>
                    <td> {{ date('d/m/Y', strtotime($extrusora->data)) }} </td>
                    <td> {{ $extrusora->turno }} </td>
                    <td> {{ $extrusora->name }} </td>
                    <td> {{ $extrusora->Produto }} </td>
                    <td align="right" class="{{$extrusora->CondicaoPeso}}"> {{number_format($extrusora->peso,2,',','.')}} </td>
                    <td align="right" class="{{$extrusora->CondicaoAltura}}"> {{number_format($extrusora->altura,2,',','.')}} </td>
                    <td align="right" class="{{$extrusora->CondicaoLargura}}"> {{number_format($extrusora->largura,2,',','.')}} </td>
                    <td align="right" class="{{$extrusora->CondicaoComprimento}}"> {{number_format($extrusora->comprimento,2,',','.')}} </td>
                    <td align="right" class="{{$extrusora->CondicaoDim_parede}}"> {{number_format($extrusora->dim_parede,2,',','.')}} </td>
                    <td align="right" class="{{$extrusora->CondicaoUmidade}}"> {{number_format($extrusora->umidade,2,',','.')}} </td>
                    <td align="right" class="{{$extrusora->CondicaoVacuo}}"> {{number_format($extrusora->vacuo,2,',','.')}} </td>
                    <td align="right" class="{{$extrusora->CondicaoDurometro}}"> {{number_format($extrusora->durometro,2,',','.')}} </td>
                    <td align="">
                        @php
                            ($extrusora->qtdAnexo<=0)? $tipoBtn='danger' : $tipoBtn='info'
                        @endphp
                        <a class="btn btn-{{$tipoBtn}}" href="{{route('extrusora.extrusoraAnexo',$extrusora->id_extrusora)}}" target="_blank">
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
                                <a class="dropdown-item" href="{{route('extrusora.formEdit', $extrusora->id_extrusora)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    {{-- <form action=" {{ route('extrusora.destroy',['extrusora'=> $extrusora->id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='extrusora' value=" {{ $extrusora->id }} ">
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
