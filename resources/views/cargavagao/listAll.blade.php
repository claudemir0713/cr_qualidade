@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-laptop"></i> Apontamento de Carga de Vagão
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('cargavagao.add')}}">
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
            <form method="get" action="{{ route('cargavagao.listAll') }}">
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
                <th width="5%">Lote</th>
                <th width="30%">Produto</th>
                <th width="5%">Peso</th>
                <th width="5%">Dimensao Externa</th>
                <th width="5%">Dimensao da Parede</th>
                <th width="5%">Umidade</th>
                <th width="5%">Resistência</th>
                <th width="5%">Perda</th>
                <th width="10%">Historico</th>
                <th width="5%" data-field="name">Upload</th>
                <th width="5%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cargavagoes as $cargavagao)
                <tr>
                    <td> {{ date('d/m/Y', strtotime($cargavagao->data)) }} </td>
                    <td> {{ $cargavagao->name }} </td>
                    <td> {{ $cargavagao->lote }} </td>
                    <td> {{ $cargavagao->Produto }} </td>
                    <td align="right"> {{ number_format($cargavagao->peso,2,',','.') }} </td>
                    <td align="right"> {{ number_format($cargavagao->dim_externa,2,',','.') }} </td>
                    <td align="right"> {{ number_format($cargavagao->dim_parede,2,',','.') }} </td>
                    <td align="right"> {{ number_format($cargavagao->umidade,2,',','.') }} </td>
                    <td align="right"> {{ number_format($cargavagao->resistencia,2,',','.') }} </td>
                    <td align="right"> {{ number_format($cargavagao->perda,2,',','.') }} </td>
                    <td align="right"> {{ $cargavagao->historico }} </td>
                    <td align="">
                        @php
                            ($cargavagao->qtdAnexo<=0)? $tipoBtn='danger' : $tipoBtn='info'
                        @endphp
                        <a class="btn btn-{{$tipoBtn}}" href="{{route('cargavagao.cargavagaoAnexo',$cargavagao->id_cargavagao)}}" target="_blank">
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
                                <a class="dropdown-item" href="{{route('cargavagao.formEdit', $cargavagao->id_cargavagao)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    {{-- <form action=" {{ route('cargavagao.destroy',['cargavagao'=> $cargavagao->id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='cargavagao' value=" {{ $cargavagao->id }} ">
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
