@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-donate"></i> Moeda Ptax
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('moeda.formAddPtax',['moeda_id'=> $codMoeda  ])}}">
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
                <th width="10%">Moeda</th>
                <th width="10%">Data</th>
                <th width="10%">Ptax</th>
                <th width="5%" >Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($moeda_ptax as $item)
                <tr>
                    <td >{{ $item->moeda }} ({{ $item->simbolo }}) </td>
                    <td align="center">{{ date('d/m/Y', strtotime($item->data)) }}</td>
                    <td align="right">{{ number_format($item->valor,3,',','.') }}</td>

                    <td align="center">
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">
                                    <form action=" {{ route('moeda.destroyPtax',['uuid'=> $item->uuid ,'moeda_id' => $item->moeda_id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='moeda' value=" {{ $item->uuid }} ">
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
    {{$moeda_ptax->links()}}
@endsection


