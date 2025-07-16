@php
    $activeLista = 'active'
@endphp
@extends('layouts.main_layout')

@section('breadcrumb')
    <?=$breadcrumb?>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <!-- Card header -->
        <div class="card-header pb-0">
          <div class="d-lg-flex">
            <div id="botoes">
              <div class="row px-0">
                  <div class="mb-0 fs-4 fw-bold col-12 col-lg-auto text-center text-lg-start">Todos os Chamados</div>
                  <div class="col-12 col-lg text-center text-lg-end">
                    <div class="btn btn-primary botao_periodo" id="btn30_dias" onclick="listar('30')">30 dias</div>
                    <div class="btn botao_periodo" id="btn_tudo" onclick="listar()">Todos</div>
                  </div>
              </div>
              <div class="row mt-3">
                    <a class="btn btn-success col-6 col-md-4 col-lg-auto botao_status" id="status1">Não Iniciados</a>
                    <a class="btn col-6 col-md-4 col-lg-auto botao_status" id="status2">Em Execução</a>
                    <a class="btn col-6 col-md-4 col-lg-auto botao_status" id="status3">Pendentes</a>
                    <a class="btn col-6 col-md-6 col-lg-auto botao_status" id="status4">Finalizados</a>
                    <a class="btn col-12 col-md-6 col-lg-auto botao_status" id="status5">Cancelados</a>
              </div>
            </div>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
              <div class="ms-auto my-auto">
                <a href="{{route('chamado.novo')}}" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Novo chamado</a>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body px-0 pb-0" id="tabela_chamado">

        </div>

      </div>
    </div>
  </div>

  @include('layouts.modals.modal_cancela_chamado')
@endsection

@section('js')

@if (session()->has('message'))
<script>
    addEventListener('DOMContentLoaded', () =>{
        Swal.fire({
        title: "Sucesso",
        text: "<?=session('message')?>",
        icon: "success",
  showConfirmButton: false,
  timer: 1500
      });
    });

</script>
@endif
<script>
    var item = 'Dashboard';
    var subItem = 'Home'
</script>
@endsection

@section('js2')
<script src="{{asset('assets/js/plugins/datatables.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/init/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/view/chamado.js')}}" type="text/javascript"></script>
@endsection
