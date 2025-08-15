@php
    $activeServico = 'active';
    $activeInformacoes = 'active';
    $showInformacoes = 'show';
@endphp
@extends('layouts.main_layout')

@section('css')
@endsection

@section('breadcrumb')
    <?=$breadcrumb?>
@endsection

@section('content')
<div class="row my-4">
    <div class="col-12">
        <div class="card">
        <div class="card-header pb-0">
          <div class="d-lg-flex">
            <div>
              <h5 class="mb-0">Serviços</h5>
            </div>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
              <div class="ms-auto my-auto">
                <a data-bs-toggle="modal" data-bs-target="#servicoModal" class="btn bg-gradient-primary btn-sm mb-0 servico">+&nbsp; Nova Serviço</a>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Categoria</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp @php $i++; @endphp
                            @foreach ($servicos as $servico)
                            @php
                            $status = $servico->status == 1
                                            ? '<span class="badge badge-success">Ativado</span>'
                                            : '<span class="badge badge-danger">Desativado</span>'
                            @endphp
                            <tr class="servico" data-bs-toggle="modal" role="button" data-bs-target="#servicoModal" id="tr{{$servico->idServico}}">
                                <td>
                                    <h6 class="mb-0 text-sm" id="id{{$servico->idServico}}">{{$i}}</h6>
                                </td>
                                <td>
                                    <p class="text-sm text-secondary mb-0"  id="nome{{$servico->idServico}}">{{$servico->nomeServico}}</p>
                                </td>
                                <td>
                                    <p class="text-sm text-secondary mb-0"  id="nome{{$servico->idServico}}">{{$servico->nomeCategoria}}</p>
                                </td>
                                <td>
                                    <p class="text-sm text-secondary mb-0"><?=$status?></p>
                                    <div class="d-none" id="status{{$servico->idServico}}">{{$servico->status}}</div>
                                    <div class="d-none" id="categoria{{$servico->idServico}}">{{$servico->idCategoria}}</div>
                                </td>
                            </tr>
                            @php $i++; @endphp
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@include('layouts.modals.modal_save_servico')

@endsection

@section('js')
<script src="<?= asset('assets/js/plugins/datatables.js') ?>" type="text/javascript"></script>
<script src="<?= asset('assets/js/init/datatable.js') ?>" type="text/javascript"></script>
<script src="<?= asset('assets/js/view/servico.js') ?>" type="text/javascript"></script>
@endsection
