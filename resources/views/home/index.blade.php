@php
    $activeHome = 'active'
@endphp
@extends('layouts.main_layout')

@section('breadcrumb')
    <?=$breadcrumb?>
@endsection

@section('content')
<?php
    $txtSolicitacao = 'Minhas Solicitações';
    if (session('user.nivel') == 2) $txtSolicitacao = 'Solicitações dos Usuários'
?>
<div class="card shadow-lg mx-4 mt-2">
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

            <div class="row mt-4">
                <div class="col-lg-3 col-12 mt-3">
                    <div class="card border-1 bg-secondary">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col" id="total_nao_iniciado">
                                    <div class="numbers text-center">
                                        <p class="fs-1 mb-0 font-weight-bold text-white">
                                            <span class="mes_30"><?=$naoIniciados['30']?></span>
                                            <span class="mes_todos d-none"><?=$naoIniciados['todos']?></span>
                                        </p>
                                        <div class="font-weight-bolder mb-0 h5 text-white">
                                            Não Iniciada
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('layouts.badges.badge_nao_visto', ['value' => $naoIniciados['nao_visto'], 'id' => 'nao_iniciado'])
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-12 mt-3">
                    <div class="card border-1 bg-primary">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col">
                                    <div class="numbers text-center">
                                        <p class="fs-1 mb-0 font-weight-bold text-white">
                                            <span class="mes_30"><?=$emExecucao['30']?></span>
                                            <span class="mes_todos d-none"><?=$emExecucao['todos']?></span>
                                        </p>
                                        <div class="font-weight-bolder mb-0 h5 text-white">
                                            Em Execução
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('layouts.badges.badge_nao_visto', ['value' => $emExecucao['nao_visto'], 'id' => 'em_execucao'])
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-12 mt-3">
                    <div class="card border-1 bg-warning">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col">
                                    <div class="numbers text-center">
                                        <p class="fs-1 mb-0 font-weight-bold text-white">
                                            <span class="mes_30"><?=$pendentes['30']?></span>
                                            <span class="mes_todos d-none"><?=$pendentes['todos']?></span>
                                        </p>
                                        <div class="font-weight-bolder mb-0 h5 text-white">
                                            Pendente
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('layouts.badges.badge_nao_visto', ['value' => $pendentes['nao_visto'], 'id' => 'pendente'])
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-12 mt-3">
                    <div class="card border-1 bg-success">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col">
                                    <div class="numbers text-center">
                                        <p class="fs-1 mb-0 font-weight-bold text-white">
                                            <span class="mes_30"><?=$finalizados['30']?>
                                            </span><span class="mes_todos d-none"><?=$finalizados['30']?></span>
                                        </p>
                                        <div class="font-weight-bolder mb-0 h5 text-white">
                                            Finalizados
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('layouts.badges.badge_nao_visto', ['value' => $finalizados['nao_visto'], 'id' => 'finalizado'])
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js')
@endsection
