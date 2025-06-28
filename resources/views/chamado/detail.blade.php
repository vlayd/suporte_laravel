@extends('layouts.main_layout')

@section('breadcrumb')
@endsection

@section('content')
<div class="row">
    <div class="card col">
        <div class="card-body">
            <div class="row">
                <h5 class="mb-4 col-12">Visualizar chamado</h5>
                <div class="col-6 px-0 border">
                    <div class="bg-gray-200 text-dark fw-bolder py-3 px-2">Código</div>
                    <div class="text-sm py-3 px-2"><?= $chamado['idChamado'] ?></div>
                </div>
                <div class="col-6 px-0 border">
                    <div class="bg-gray-200 text-dark fw-bolder py-3 px-2">Status</div>
                    <div class="border text-sm py-3 px-2">
                        <span class="badge badge-<?= $chamado['cor'] ?>"><?= $chamado['nomeStatus'] ?></span>
                    </div>
                </div>
                <div class="col-12 col-lg px-0">
                    <div class="bg-gray-200 text-dark fw-bolder border py-3 px-2">Título</div>
                    <div class="border text-sm py-3 px-2"><?= $chamado['titulo'] ?></div>
                </div>
                <div class="col-12 col-lg px-0">
                    <div class="bg-gray-200 text-dark fw-bolder border py-3 px-2">Serviço</div>
                    <div class="border text-sm py-3 px-2"><?= $chamado['nomeServico'] ?></div>
                </div>
                <div class="col-12 px-0">
                    <div class="bg-gray-200 text-dark fw-bolder border py-3 px-2">Descrição</div>
                    <div class="border text-sm px-2 pt-3"><?= $chamado['descricao'] ?></div>
                </div>
                <div class="col-12 col-sm-6 px-0">
                    <div class="bg-gray-200 text-dark fw-bolder border py-3 px-2">Solicitante</div>
                    <div class="border text-sm py-3 px-2"><?= $chamado['nomeSolicitante'] ?></div>
                </div>
                <div class="col-12 col-sm-6 px-0">
                    <div class="bg-gray-200 text-dark fw-bolder border py-3 px-2">Atendente</div>
                    <div class="border text-sm py-3 px-2"></div>
                </div>
                <div class="col-6 px-0 border">
                    <div class="bg-gray-200 text-dark fw-bolder py-3 px-2">Solicitação</div>
                    <div class="text-sm py-3 px-2"><?= $chamado['dt_criacao'] ?></div>
                </div>
                <div class="col-6 px-0 border">
                    <div class="bg-gray-200 text-dark fw-bolder py-3 px-2">Conclusão</div>
                    <div class="text-sm py-3 px-2"><?= $chamado['dt_conclusao'] ?></div>
                </div>
                <div class="col-12 bg-gray-200 text-dark fw-bolder py-3 border">Anexos</div>
                <div class="col-12 py-3 border">
                    <div class="d-flex flex-wrap">
                        <?php foreach ($anexosMain as $anexo) :
                            $tmp = explode('.', $anexo['arquivo']);
                        ?>
                            <div class="me-2">
                                <a href="<?= asset(PATH_UPLOAD . $anexo['id_chamado'] . '/' . $anexo['arquivo']) ?>" download="<?= $anexo['arquivo'] ?>" target="_blank">
                                    <img src="<?= asset(EXTENSION_IMG[end($tmp)] ?? EXTENSION_IMG['file']) ?>" alt="" height="30" class="my-3">
                                    <span><?= $anexo['arquivo'] ?></span>
                                </a>
                                <div class=" ms-3 vr"></div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chat --}}

<div class="row my-5">
    <div class="col-12">
        <div class="card blur shadow-blur max-height-vh-100">
            <div class="card-header shadow-lg bg-gray-200 text-dark">
                <h5 class="mb-1">Continuando atendimento</h5>
            </div>
            <div class="card-body overflow-auto overflow-x-hidden pb-4" id="div1">
                <?php foreach ($chats as $chat) :
                    $tmp = explode('.', $chat['arquivo']);
                    $nome = explode(' ', $chat['nome'])[0];
                    $foto = 'https://setor-rh.com/' . $chat['foto'];
                    $corNome = 'text-primary';
                    if ($chat['id_usuario'] == session('user.id')) {
                        $nome = '';
                    }
                    if ($chat['id_usuario'] == $chamado['atendente']) {
                        $foto = asset(PATH_APOIO . 'suporte2.png');
                        $corNome = 'text-warning';
                        $nome = $nome . ' <span class="badge badge-warning badge-sm">Suporte</span>';
                    }
                        $align = 'justify-content-start text-right';
                        // $color = 'bg-gray-200';
                        $color = '';
                        if ($chat['id_usuario'] == session('user.id')) {
                        $align = 'justify-content-end text-right';
                        $color = 'style="background-color: #D1F4CC;"';
                        }
                ?>
                    <div class="row <?= $align ?> mb-4 mt-3">
                        <div class="col-auto mt-1">
                            <img src="<?= $foto ?>" class="avatar avatar-md" alt="avatar image">
                        </div>
                        <div class="col-auto">
                            <div class="card" <?= $color ?>>
                                <div class="card-body py-2 px-3">
                                    <h6 class="mb-0 <?= $corNome ?>">
                                        <?= $nome ?>
                                    </h6>
                                    <p class="mb-0">
                                    <?= $chat['texto'] ?>
                                    <?php if ($chat['arquivo'] != '') : ?>
                                    <div class="col-auto">
                                        <a href="<?= asset(PATH_UPLOAD.$chat['id_usuario'].'/'. $chat['arquivo']) ?>" class="text-primary" download="<?= $chat['arquivo'] ?>" target="_blank">
                                            <img src="<?= asset(EXTENSION_IMG[end($tmp)] ?? EXTENSION_IMG['file']) ?>" alt="" height="30" class="">
                                            <span><?= $chat['arquivo'] ?></span>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </p>
                                <div class="d-flex align-items-center text-sm opacity-6 mt-n2">
                                    <i class="ni ni-check-bold text-sm me-1"></i>
                                    <small><?= date_format(date_create($chat['data']), 'd/m/Y à\s H:i') ?></small>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <?php if ($chamado['statusChamado'] == 2 || $chamado['statusChamado'] == 3) : ?>
                <div class="card-footer shadow-lg bg-gray-200 text-dark rounded rounded-3 pb-0 px-3" id="div2">
                    <h6 class="mb-3">Digitar uma mensagem</h6>
                    <form action="" id="form-save-chat" method="post">
                        <div class="row bg-white pb-4">
                            <div id="descricao_hid-1" class="d-none"></div>
                            <div class="col-12 col-lg-7 mt-3">
                                <label class="form-label">Mensagem</label>
                                <div id="descricao-1" style="height: 80px;"></div>
                                <input type="hidden" name="descricao-1" id="hid_descricao-1" value="">
                            </div>
                            <div class="col-12 col-lg-5 mt-4">
                                <div class="row">
                                    <label for="anexo_chat" class="form-label">Anexo</label>
                                    <input class="form-control" name="anexo_chat[]" type="file" id="anexo_chat" multiple >
                                    <div class="d-flex justify-content-start mt-4">
                                        <button type="button" name="button" class="btn btn-light m-0 px-sm-3">Cancelar</button>
                                        <button type="submit" form="form-save-chat" id="btnSave" class="btn bg-gradient-primary m-0 ms-2 px-sm-3">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endif ?>

        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    var item = 'Dashboard';
    var subItem = 'Home'
</script>
<script src="{{asset('assets/js/plugins/quill.min.js')}}"></script>
<script src="{{asset('assets/js/init/quill.js')}}"></script>
@endsection

@section('js2')
@endsection
