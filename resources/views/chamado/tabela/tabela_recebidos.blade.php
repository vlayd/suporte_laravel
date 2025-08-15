<div class="table-responsive">
    <table class="table table-flush" id="data-list-1">
        <thead class="thead-light">
            <tr>
                <th>Ticket</th>
                <th>Título</th>
                <th>Serviço</th>
                <th>Intervalo</th>
                <th>Solicitante</th>
                <th>Status</th>
                <th>Ações</th>
                <th class="d-none">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($chamados as $chamado) :
                $nomeCompleto = explode(' ', $chamado['nomeSolicitante']);
                $solicitante = current($nomeCompleto); ?>
                <tr class="status<?= $chamado['status']?> statusr">
                    <td class="text-sm"><?= $chamado['idChamado'] ?></td>
                    <td class="text-sm text-truncate" style="max-width: 300px;" data-toggle="tooltip" title="<?= $chamado['titulo'] ?>"><?= $chamado['titulo'] ?></td>
                    <td class="text-sm"><?= $chamado['nomeServico'] ?></td>
                    <td class="text-sm">
                        <div><?= '<i class="fas fa-play-circle text-success"></i> ' . date_format(date_create($chamado['dt_criacao']), 'd/m/Y H:i') ?></div>
                        <?php if ($chamado['dt_conclusao'] != null) : ?>
                            <div><?= '<i class="fas fa-stop-circle text-danger"></i> ' . date_format(date_create($chamado['dt_conclusao']), 'd/m/Y H:i') ?></div>
                        <?php endif ?>
                    </td>
                    <td class="text-sm"><?= $solicitante ?></td>
                    <td class="text-sm">
                        @include('layouts.select.select_status', ['confirma' => true])
                    </td>
                    <td class="text-sm">
                        <a href="{{route('chamado.detail', Crypt::encrypt($chamado['idChamado']))}}" class="bg-primary p-2 rounded position-relative" target="_blank">
                            <i class="fas fa-eye text-white fa-fw"></i>
                            <?php if ($chamado['visto_adm'] == 0) : ?>
                                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger rounded-circle">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            <?php endif ?>
                        </a>
                       
                        @include('layouts.btn.btn_acoes', ['tipo' => 'enviados'])
                    </td>
                    <td class="d-none"><?=date_format(date_create($chamado['dt_alteracao']), 'd/m/Y H:i')?></td>
                </tr>
            <?php $i++;
            endforeach; ?>
        </tbody>
    </table>
</div>
<?=CDN_JS_DATATABLES?>