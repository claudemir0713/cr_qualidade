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
                    <div class="form-group col-md-4">
                        Maquina
                        <input class="form-control" type="text" name="maquina" id="Maquina">
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
                <th width="5%">Lote</th>
                <th width="10%">Operador</th>
                <th width="10%">Produto</th>
                <th width="5%">Peso</th>
                <th width="5%">Dimensao Externa</th>
                <th width="5%">Dimensao da Parede</th>
                <th width="5%">Umidade</th>
                <th width="5%">Resistência</th>
                <th width="5%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cargavagaos as $cargavagao)
                <tr>
                    <td> {{ $cargavagao->data }} </td>
                    <td> {{ $cargavagao->turno }} </td>
                    <td> {{ $cargavagao->user_id }} </td>
                    <td> {{ $cargavagao->produto }} </td>
                    <td> {{ $cargavagao->peso }} </td>
                    <td> {{ $cargavagao->dim_externa }} </td>
                    <td> {{ $cargavagao->dim_parede }} </td>
                    <td> {{ $cargavagao->umidade }} </td>
                    <td> {{ $cargavagao->resistencia }} </td>
                    <td>
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('cargavagao.formEdit', $cargavagao->id)}}">
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
