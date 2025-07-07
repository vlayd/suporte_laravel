@extends('layouts.main_layout')

@section('css')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div class="row my-4">
    <div class="col-12">
        <div class="card">
        <div class="card-header pb-0">
          <div class="d-lg-flex">
            <div>
              <h5 class="mb-0">Categorias</h5>
            </div>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
              <div class="ms-auto my-auto">
                <a data-bs-toggle="modal" data-bs-target="#categoriaModal" class="btn bg-gradient-primary btn-sm mb-0 categoria">+&nbsp; Nova Categoria</a>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                            @php
                            $status = $categoria->status == 1
                                            ? '<span class="badge badge-success">Ativado</span>'
                                            : '<span class="badge badge-danger">Desativado</span>'
                            @endphp
                            <tr class="categoria" data-bs-toggle="modal" data-bs-target="#categoriaModal" id="tr{{$categoria->id}}">
                                <td>
                                    <h6 class="mb-0 text-sm" id="id{{$categoria->id}}">{{$categoria->id}}</h6>
                                </td>
                                <td>
                                    <p class="text-sm text-secondary mb-0"  id="nome{{$categoria->id}}">{{$categoria->nome}}</p>
                                </td>
                                <td>
                                    <p class="text-sm text-secondary mb-0"><?=$status?></p>
                                    <div class="d-none" id="status{{$categoria->id}}">{{$categoria->status}}</div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @include('layouts.modals.modal_save_categoria')
</div>

@endsection

@section('js')
<script src="<?= asset('assets/js/plugins/datatables.js') ?>" type="text/javascript"></script>
<script src="<?= asset('assets/js/init/datatable.js') ?>" type="text/javascript"></script>
<script src="<?= asset('assets/js/view/categoria.js') ?>" type="text/javascript"></script>
@endsection
