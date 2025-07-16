@php
$activeRelatorio = 'active';
@endphp
@extends('layouts.main_layout')

@section('breadcrumb')
@endsection

@section('content')
<div class="row my-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col">
                        <h5>Relatório Analítico</h5>
                    </div>
                </div>
            </div>

            <div class="card-body px-3 pb-0">
                <form action="{{route('chamado.relatorio.pdf.analitico')}}" method="post" target="_blank">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col">
                            <div class="form-group">
                                <label for="data_inicio" class="form-control-label">Início</label>
                                <input class="form-control" type="date" name="data_inicio" id="data_inicio">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="data_fim" class="form-control-label">Fim</label>
                                <input class="form-control" type="date" name="data_fim" id="data_fim">
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Emitir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
