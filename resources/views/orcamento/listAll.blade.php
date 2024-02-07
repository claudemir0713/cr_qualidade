@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-hand-holding-usd"></i> Orçamentos
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('orcamento.formAdd')}}">
                        <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;
                        <span>Novo</span>
                    </a>
                </h3>
            </td>
        </tr>
    </table><hr>
    <div class="row">
        <div class="form-group col-md-2">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <span class="fas fa-filter"></span> Filtros
            </button>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form method="get" action="{{ route('orcamento.listAll') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-2">
                        Código:
                        <input type="text" class="form-control" name="codigo" id="codigo" value="{{ array_key_exists('codigo',$dateForm) ? $dateForm['codigo'] : '' }}">
                    </div>
                    <div class="form-group col-md-2">
                        Artigo:
                        <input type="text" class="form-control" name="artigo" id="artigo" value="{{ array_key_exists('artigo',$dateForm) ? $dateForm['artigo'] : '' }}">
                    </div>
                    <div class="form-group col-md-4">
                        Cliente:
                        <input type="text" class="form-control" name="cliente" id="cliente" value="{{ array_key_exists('cliente',$dateForm) ? $dateForm['cliente'] : '' }}">
                    </div>
                    <div class="form-group col-md-2">
                        Status:
                        <select class="form-control" name="status" id="status">
                            <option value="S" {{ ((array_key_exists('status',$dateForm) ? $dateForm['status'] : '') =='S')? 'selected' :'' }}>Sim</option>
                            <option value="N" {{ ((array_key_exists('status',$dateForm) ? $dateForm['status'] : '') =='N')? 'selected' :'' }}>Não</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-primary" type="submit" >
                        <span class="fas fa-play"></span> Filtrar
                    </button>
                </div>
            </form >
        </div>
    </div>

    <p>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="20%">Cliente</th>
                <th width="20%">Artigo</th>
                <th width="5%">Qtd Peças</th>
                <th width="5%">Data</th>
                <th width="5%">Data Entrega</th>
                <th width="5%" >Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orcamentos as $item)
                <tr>
                    <td align="center">{{ $item->id }}  </td>
                    <td align="center">
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                                <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-cogs"></i>
                                    <span>Ação</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('produto.formEdit', $item->id)}}">
                                        <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                        <span>Editar</span>
                                    </a>
                                    {{-- <a class="dropdown-item" href="#">
                                        <form action=" {{ route('produto.destroy',['id'=> $produto->id ]) }} " method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name='produto' value=" {{ $produto->id }} ">
                                            <i class="far fa-trash-alt"></i>
                                            <input type="submit" class="btn btn-default delete"  value="Eliminar">
                                        </form>
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {{$orcamentos->links()}} --}}
@endsection


