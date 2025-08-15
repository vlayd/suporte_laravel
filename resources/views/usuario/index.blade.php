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
                <div class="row px-0">
                    <div class="mb-0 fs-4 fw-bold col-12 col-lg-auto text-center text-lg-start">Usuários</div>
                    <div class="mb-0 fs-4 fw-bold col-12 col-lg-auto text-center text-lg-start">
                        <div class="btn btn-primary botao_quantidade" id="btn_solicitante">Solicitantes</div>
                    </div>
                    <div class="mb-0 fs-4 fw-bold col-12 col-lg-auto text-center text-lg-start">
                        <div class="btn botao_quantidade" id="btn_tudo">Todos</div>
                    </div>
                    <div class="mb-0 fs-4 fw-bold col-12 col-lg-auto text-center text-lg-start">
                        <a href="javascript:;" class="btn btn-danger ms-3" id="btn_atualiza">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0" id="tabela">
                @include('usuario.tabela')
            </div>

        </div>
    </div>
    @include('layouts.modals.modal_save_status')
</div>

@endsection

@section('js2')


<script src="<?= asset('assets/js/plugins/datatables.js') ?>" type="text/javascript"></script>
<script src="<?= asset('assets/js/init/datatable.js') ?>" type="text/javascript"></script>
<script src="<?= asset('assets/js/view/usuario.js') ?>" type="text/javascript"></script>
@endsection
