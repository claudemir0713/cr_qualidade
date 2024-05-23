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

    <table class="table table-bordered table-condensed table-striped fonte-20">
        <thead>
            <tr>
                <th width="5%">Data</th>
                <th width="10%">Operador</th>
                <th width="10%">Lote</th>
                <th width="3%">Produto</th>
                <th width="3%">Resistencia</th>
                <th width="3%">Absorção</th>
                <th width="5%" data-field="name">Upload</th>
                <th width="1%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laboratorios as $laboratorio)
                <tr>
                    <td> {{ date('d/m/Y', strtotime($laboratorio->data)) }} </td>
                    <td> {{ $laboratorio->name }} </td>
                    <td> {{ $laboratorio->lote_extrusora }} </td>
                    <td> {{ $laboratorio->Produto }} </td>
                    <td> {{ $laboratorio->resistencia }} </td>
                    <td> {{ $laboratorio->absorcao }} </td>
                    <td align="">
                        @php
                            ($laboratorio->qtdAnexo<=0)? $tipoBtn='danger' : $tipoBtn='info'
                        @endphp
                        <a class="btn btn-{{$tipoBtn}}" href="{{route('laboratorio.laboratorioAnexo',$laboratorio->id_laboratorio)}}" target="_blank">
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