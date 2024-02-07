@extends('layouts.model')

@section('content')
<div class="container">

    <div class="card-deck">
        <div class="card-columns">
            {{-- <a href="{{ route('projetos.formListAlteracao')}}?cliente=&centroCusto=&nr=&Status=Orçamento"> --}}
                <a href="">
                    <div class="card min-height-100">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fas fa-hand-holding-usd fa-5x"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3 id="span-nrOrcamento"></h3>
                                    <span>Orçamento</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card min-height-100">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="far fa-thumbs-up fa-5x"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3 id="span-nrAprovado">0</h3>
                                    <span>Em Aprovação</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card min-height-100">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="far fa-calendar-alt fa-5x"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3 id="span-nrAgendamento">0</h3>
                                    <span>Agendamento</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
        <div class="card-columns">

            <a href="">
                <div class="card min-height-100">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fas fa-hard-hat fa-5x"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3 id="span-nrExecucao">0</h3>
                                    <span>Execução</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="card min-height-100">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="far fa-money-bill-alt fa-5x"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3 id="span-nrFinanceiro">0</h3>
                                    <span>Financeiro</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>


</div>
@endsection
