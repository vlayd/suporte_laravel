@php
$activeStatus = 'active';
$activeInformacoes = 'active';
$showInformacoes = 'show';
@endphp
@extends('layouts.main_layout')

@section('css')
@endsection

@section('breadcrumb')
<?= $breadcrumb ?>
@endsection

@section('content')
<div class="row my-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">Status</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
                <div class="table-responsive p-4">
                    <table class="table align-items-center mb-0" id="data-list-1">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nº</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($status as $stat)
                            <tr class="status" data-bs-toggle="modal" data-bs-target="#statusModal" id="tr{{$stat->id}}">
                                <td>
                                    <h6 class="mb-0 text-sm" id="id{{$stat->id}}">{{$stat->id}}</h6>
                                </td>
                                <td>
                                    <p class="text-sm text-{{$stat->cor}} mb-0 fw-bold" id="nome{{$stat->id}}">{{$stat->nome}}</p>
                                    <div class="d-none" id="cor{{$stat->id}}">{{'text-'.$stat->cor}}</div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @include('layouts.modals.modal_save_status')
</div>

@endsection

@section('js')
<script src="<?= asset('assets/js/plugins/datatables.js') ?>" type="text/javascript"></script>
<script src="<?= asset('assets/js/init/datatable.js') ?>" type="text/javascript"></script>
<script src="<?= asset('assets/js/view/status.js') ?>" type="text/javascript"></script>
@endsection
