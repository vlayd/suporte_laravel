@php
$activeListaUser = 'active';
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
                    <table class="table align-items-center mb-0" id="data-list-usuarios">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nº</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr class="status" data-bs-toggle="modal" data-bs-target="#statusModal" id="tr{{$usuario->idUser}}">
                                <td class="text-sm">{{$usuario->idUser}}</td>
                                <td class="text-sm">{{$usuario->nome}}</td>
                                <td class="text-sm">{{$usuario->qtChamado}}</td>
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
