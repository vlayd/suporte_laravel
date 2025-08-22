<?php

use App\Http\Controllers\Controller;

?>
@extends('layouts.main_layout')

@section('breadcrumb')
<?= $breadcrumb ?>
@endsection

@section('content')
<?php
$txtSolicitacao = 'Minhas Solicitações';
if (session('user.nivel') == 2) {
    $txtSolicitacao = 'Solicitações dos Usuários';
}
?>
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <i class="fas fa-laptop text-black-50 fa-3x"></i>
                        </div>
                    </div>

                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1"><?= $txtSolicitacao ?></h5>
                        </div>
                    </div>

                    <div class="nav-wrapper position-relative ms-auto w-50">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item" onclick="showPeriodo('mes_30')">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#cam1" role="tab" aria-controls="cam1" aria-selected="true">
                                    30 dias
                                </a>
                            </li>
                            <li class="nav-item" onclick="showPeriodo('mes_todos')">
                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#cam2" role="tab" aria-controls="cam2" aria-selected="false">
                                    Todos
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-4 d-flex justify-content-between px-3 row">
                        @include('layouts.rectangles.rectangle_home', [
                        'color' => 'secondary',
                        'status' => 'nao_iniciado',
                        'value30' => NAO_INICIADO['todos']['todos'],
                        'value' => NAO_INICIADO['todos']['todos'],
                        'valueNaoVisto' => NAO_INICIADO['nao_visto']['todos'],
                        'title' => 'Não Iniciados'
                        ])
                        @include('layouts.rectangles.rectangle_home', [
                        'color' => 'primary',
                        'status' => 'em_execucao',
                        'value30' => EM_EXECUCAO['todos']['todos'],
                        'value' => EM_EXECUCAO['todos']['todos'],
                        'valueNaoVisto' => EM_EXECUCAO['nao_visto']['todos'],
                        'title' => 'Em Execução'
                        ])
                        @include('layouts.rectangles.rectangle_home', [
                        'color' => 'warning',
                        'status' => 'pendente',
                        'value30' => PENDENTE['todos']['30'],
                        'value' => PENDENTE['todos']['todos'],
                        'valueNaoVisto' => PENDENTE['nao_visto']['todos'],
                        'title' => 'Pendentes'
                        ])
                        @include('layouts.rectangles.rectangle_home', [
                        'color' => 'success',
                        'status' => 'finalizado',
                        'value30' => FINALIZADO['todos']['30'],
                        'value' => FINALIZADO['todos']['todos'],
                        'valueNaoVisto' => FINALIZADO['nao_visto']['todos'],
                        'title' => 'Finalizados'
                        ])
                    </div>

                </div>

                @if (session('user.nivel') == 2)
                <!-- Históricos dos chamaods -->
                <div class="mb-3 text-center mt-6">
                    <h5 class="mb-0">Interações dos Chamados</h5>
                </div>

                <div class="row p-2" id="tabela_controle">
                    <div class="col-12 pb-3 mt-3" id="tabela_controle2">
                        <div class="table-responsive border rounded">
                            <div class="text-center bg-gray-200 py-2">Demandas do Serviços</div>
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Não Iniciados</div>
                                            <div>
                                                <i class="fas fa-eye text-success"></i>
                                                <i class="fas fa-eye-slash text-danger"></i>
                                            </div>
                                        </th>
                                        <th class="text-center">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Em Execução</div>
                                            <div>
                                                <i class="fas fa-eye text-success"></i>
                                                <i class="fas fa-eye-slash text-danger"></i>
                                            </div>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pendentes</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Finalizados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias30 as $categoria)
                                    <tr class="mes_30">
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-2">{{$categoria->nome}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0"><?= Controller::quatidadeVisto(1, 1, $categoria->id) . ' | ' . Controller::quatidadeVisto(1, 0, $categoria->id) ?></p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0"><?= Controller::quatidadeVisto(2, 1, $categoria->id) . ' | ' . Controller::quatidadeVisto(2, 0, $categoria->id) ?></p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{Controller::quatidadeVisto(3, 1, $categoria->id)}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{Controller::quatidadeVisto(4, 1, $categoria->id)}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @foreach ($categorias as $categoria)
                                    <tr class="mes_todos d-none">
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-2">{{$categoria->nome}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{Controller::quatidadeVisto(1, 1, $categoria->id).' | '.Controller::quatidadeVisto(1, 0, $categoria->id)}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{Controller::quatidadeVisto(2, 1, $categoria->id).' | '.Controller::quatidadeVisto(2, 0, $categoria->id)}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{Controller::quatidadeVisto(3, 1, $categoria->id)}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{Controller::quatidadeVisto(4, 1, $categoria->id)}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 pb-3">
                        <div class="table-responsive border rounded">
                            <div class="text-center bg-gray-200 py-2">Categorias</div>
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias30 as $categoria)
                                    <tr class="mes_30">
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-2">{{$categoria->nome}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{$categoria->quantidade}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @foreach ($categorias as $categoria)
                                    <tr class="mes_todos d-none">
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-2">{{$categoria->nome}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{$categoria->quantidade}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-12 pb-3">
                        <div class="table-responsive border rounded">
                            <div class="text-center bg-gray-200 py-2">Categorias</div>
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias30 as $categoria)
                                    <tr class="mes_30">
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-2">{{$categoria->nome}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{$categoria->quantidade}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @foreach ($categorias as $categoria)
                                    <tr class="mes_todos d-none">
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-2">{{$categoria->nome}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{$categoria->quantidade}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 pb-3 mt-3">
                        <div class="table-responsive border rounded">
                            <div class="text-center bg-gray-200 py-2">Serviços</div>
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicos30 as $servico)
                                    <tr class="mes_30">
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-2">{{$servico->nome}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{$servico->quantidade}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @foreach ($servicos as $servico)
                                    <tr class="mes_todos d-none">
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-2">{{$servico->nome}}</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-xs mb-0">{{$servico->quantidade}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
@endsection