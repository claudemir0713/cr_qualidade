@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-donate"></i> Moeda
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('moeda.formAdd')}}">
                        <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;
                        <span>Novo</span>
                    </a>
                </h3>
            </td>
        </tr>
    </table><hr>
    <p>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th width="20%">Moeda</th>
                <th width="5%" >Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($moedas as $moeda)
                <tr>
                    <td >{{ $moeda->moeda }} ( {{ $moeda->simbolo }} ) </td>
                    <td align="center">
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('moeda.formEdit', $moeda->uuid)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                <a class="dropdown-item" href="{{route('moeda.listAllPtax', $moeda->id)}}">
                                    <i class="fas fa-donate"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Ptax</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <form action=" {{ route('moeda.destroy',['uuid'=> $moeda->uuid ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='moeda' value=" {{ $moeda->uuid }} ">
                                        <i class="far fa-trash-alt"></i>
                                        <input type="submit" class="btn btn-default delete"  value="Eliminar">
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
    {{$moedas->links()}}
@endsection


