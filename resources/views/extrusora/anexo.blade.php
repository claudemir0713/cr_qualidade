@extends('layouts.model')
@section('content')
    <h3 class=""><i class="fa fa-upload"></i> Lote -> {{$extrusoras->lote}}</h4>
    <hr>
    <form action="{{ route('extrusora.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-md-4">
                Arquivo:<br>
                <div class="input-group mb-3">
                    <div class="">
                        <input type="file" class="" name="arquivo" id="arquivo" aria-describedby="" required>
                        {{-- <label class="custom-file-label" for="validatedCustomFile">Selecione....</label> --}}
                        <input type="hidden" name="nomeArquivo" id="nomeArquivo" value="Anexo">
                        <input type="hidden" name="extrusora_id" id="extrusora_id" value="{{$extrusoras->id}}">
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <br>
                <button type="submit" class="btn btn-primary">Enviar arquivo</button>
            </div>
        </div>
    </form><hr>
        <div class="row">
            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Anexo</th>
                        <th>#</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($extrusora_imagem as $item)
                        <tr>
                            <td>
                                <embed src="{{ asset('storage/extrusora/'.$extrusoras->lote.'/'.$item->anexo)  }}" type=""  style="width: 100%">
                            </td>
                            <td>
                                <form action=" {{ route('extrusora.destroyAnexo',['id'=> $item->id]) }} " method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name='extrusora_anexo' value=" {{$item->Id}} ">
                                    <button type="submit" class="btn btn-danger delete">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection
