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
                    <div class="border text-sm py-3 px-2"><?= explode(' ', $chamado['nomeAtendente'])[0] ?></div>
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
                        <?php foreach ($anexosMain as $anexo) : ?>
                            <div class="me-2">
                                <a href="<?= $pathUpload . $anexo['arquivo'] ?>" download="<?= $anexo['arquivo'] ?>" target="_blank">
                                    <img src="<?= EXTENSION_IMG[end(explode('.', $anexo['arquivo']))] ?? EXTENSION_IMG['file'] ?>" alt="" height="30" class="my-3">
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
@endsection

@section('js')
<script>
    var item = 'Dashboard';
    var subItem = 'Home'
</script>
@endsection

@section('js2')
@endsection
