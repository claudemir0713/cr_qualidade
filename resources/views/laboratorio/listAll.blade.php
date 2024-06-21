@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-laptop"></i> Apontamento de Laboratorio
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('laboratorio.add')}}">
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
            <form method="get" action="{{ route('laboratorio.listAll') }}">
                @csrf
                    <div class="form-group col-md-4">
                        Lote
                        <input class="form-control" type="text" name="lote" id="lote">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" >
                    <span class="fas fa-play"></span> Filtrar
                </button>
            </form >
        </div>
    </div>
    <p>

    <table class="table table-bordered table-condensed table-striped fonte-10">
        <thead>
            <tr>
                <th width="5%">Data</th>
                <th width="20%">Operador</th>
                <th width="5%">Lote</th>
                <th width="20%">Produto</th>
                <th width="3%">Resist</th>
                <th width="3%">Absorção</th>
                <th width="3%">Largura</th>
                <th width="3%">Altura</th>
                <th width="3%">Comp</th>
                <th width="3%">Parede Externa</th>
                <th width="3%">Septos</th>
                <th width="3%">Planeza</th>
                <th width="3%">Esquadro</th>
                <th width="3%">Densidade</th>
                <th width="5%" data-field="name">Upload</th>
                <th width="1%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laboratorios as $laboratorio)
                <tr>
                    <td> {{ date('d/m/Y', strtotime($laboratorio->data)) }} </td>
                    <td> {{ $laboratorio->name }} </td>
                    <td> {{ $laboratorio->lote }} </td>
                    <td> {{ $laboratorio->Produto }} </td>
                    <td align="right"> {{ number_format($laboratorio->resistencia,2,',','.') }} </td>
                    <td align="right"> {{ number_format($laboratorio->absorcao,2,',','.') }} </td>
                    <td align="right"> {{ number_format($laboratorio->largura,2,',','.') }} </td>
                    <td align="right"> {{ number_format($laboratorio->altura,2,',','.') }} </td>
                    <td align="right"> {{ number_format($laboratorio->comprimento,2,',','.') }} </td>
                    <td align="right"> {{ number_format($laboratorio->parede_ext,2,',','.') }} </td>
                    <td align="right"> {{ number_format($laboratorio->septos,2,',','.') }} </td>
                    <td align="right"> {{ number_format($laboratorio->planeza,2,',','.') }} </td>
                    <td align="right"> {{ number_format($laboratorio->esquadro,2,',','.') }} </td>
                    <td align="right"> {{ number_format($laboratorio->densidade,2,',','.') }} </td>
                    <td align="">
                        @php
                            ($laboratorio->qtdAnexo<=0)? $tipoBtn='danger' : $tipoBtn='info'
                        @endphp
                        <a class="btn btn-{{$tipoBtn}} btn-sm" href="{{route('laboratorio.laboratorioAnexo',$laboratorio->id_laboratorio)}}" target="_blank">
                            <i class="fa fa-upload"></i>
                        </a>
                    </td>
                    <td>
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle btn-sm" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('laboratorio.formEdit', $laboratorio->id_laboratorio)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    {{-- <form action=" {{ route('laboratorio.destroy',['laboratorio'=> $laboratorio->id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='laboratorio' value=" {{ $laboratorio->id }} ">
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
