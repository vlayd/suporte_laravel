<?php
$thObs = '';
if ($tipo == 'recebidos') $thObs = '<th class="d-none"></th>';
?>
<div class="table-responsive">
    <table class="table table-flush" id="data-list-chamados">
        <thead class="thead-light">
            <tr>
                <th>Ticket</th>
                <th>Título</th>
                <th>Serviço</th>
                <th>Intervalo</th>
                <th>Participantes</th>
                <th>Status</th>
                <th>Ações</th>
                <?=$thObs?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($chamados as $chamado) :
                $tdObs = '';
                if ($tipo == 'recebidos') $tdObs = '<td class="d-none" id="observacao'.$chamado['idChamado'].'">'.$chamado['observacao'].'</td>';

                $nomeCompleto = explode(' ', $chamado['nomeSolicitante']);
                $nomeCompletoAtendente = explode(' ', $chamado['nomeAtendente']);
                $atendente = current($nomeCompletoAtendente);
                $solicitante = current($nomeCompleto); ?>
                <tr class="status<?= $chamado['status']?> statusr">
                    <td class="d-none"><?=date_format(date_create($chamado['dt_alteracao']), 'd/m/Y H:i')?></td>
                    <td class="text-sm"><?= $chamado['idChamado'] ?></td>
                    <td class="text-sm text-truncate" style="max-width: 300px;" data-toggle="tooltip" title="<?= $chamado['titulo'] ?>"><?= $chamado['titulo'] ?></td>
                    <td class="text-sm"><?= $chamado['nomeServico'] ?></td>
                    <td class="text-sm">
                        <div><?= '<i class="fas fa-play-circle text-success"></i> ' . date_format(date_create($chamado['dt_criacao']), 'd/m/Y H:i') ?></div>
                        <?php if ($chamado['dt_conclusao'] != null) : ?>
                            <div><?= '<i class="fas fa-stop-circle text-danger"></i> ' . date_format(date_create($chamado['dt_conclusao']), 'd/m/Y H:i') ?></div>
                        <?php endif ?>
                    </td>
                    <td class="text-sm">
                        <div>
                            <i class="fa-solid fa-person-walking-arrow-right text-success"></i> <?= $solicitante ?>
                        </div>
                        <?php if ($chamado['atendente'] != 0) : ?>
                        <div>
                            <i class="fa-solid fa-person-walking-arrow-loop-left text-danger"></i></i> <?= $atendente ?>
                        </div>
                        <?php endif ?>
                    </td>
                    <td class="text-sm">
                        @include('layouts.select.select_status')
                    </td>
                    <td class="text-sm">
                        @include('layouts.btn.btn_acoes')
                    </td>
                    <?=$tdObs?>
                    
                </tr>
            <?php $i++;
            endforeach; ?>
        </tbody>
    </table>
</div>
<?=CDN_JS_DATATABLES?>