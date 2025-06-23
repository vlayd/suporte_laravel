<div class="table-responsive">
    <table class="table table-flush" id="data-list-1">
        <thead class="thead-light">
            <tr>
                <th>Ticket</th>
                <th>Título</th>
                <th>Serviço</th>
                <th>Duração</th>
                <th>Solicitante</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($chamados as $chamado) :
                $nomeCompleto = explode(' ', $chamado['nomeSolicitante']);
                $classStatus = 'd-none';
                if ($chamado['status'] == 1) $classStatus = '';
                $solicitante = current($nomeCompleto); ?>
                <tr class="status<?= $chamado['status'] . ' ' . $classStatus ?>">
                    <td class="text-sm"><?= $chamado['idChamado'] ?></td>
                    <td class="text-sm text-truncate" style="max-width: 300px;" data-toggle="tooltip" title="<?= $chamado['titulo'] ?>"><?= $chamado['titulo'] ?></td>
                    <td class="text-sm">Sistema SEI</td>
                    <td class="text-sm">
                        <div><?= '<i class="fas fa-play-circle text-success"></i> ' . date_format(date_create($chamado['dt_criacao']), 'd/m/Y H:m') ?></div>
                        <?php if ($chamado['dt_conclusao'] != null) : ?>
                            <div><?= '<i class="fas fa-stop-circle text-danger"></i> ' . date_format(date_create($chamado['dt_conclusao']), 'd/m/Y H:m') ?></div>
                        <?php endif ?>
                    </td>
                    <td class="text-sm"><?= $solicitante ?></td>
                    <td class="text-sm">
                        <div class="">
                            <a class="" href="#" id="dropdownMenuLink<?= $i ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="badge badge-<?= $chamado['cor'] ?> dropdown-toggle"><?= $chamado['nomeStatus'] ?></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink<?= $i ?>">
                                <?php foreach ($status as $st) :
                                    if ($st['nome'] == $chamado['nomeStatus']) continue; ?>
                                    <li>
                                        <a class="dropdown-item bg-<?= $st['cor'] ?> text-white text-center" href=""><?= $st['nome'] ?></a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </td>
                    <td class="text-sm">
                        <a href="{{route('chamado.detail', Crypt::encrypt($chamado['idChamado']))}}" class="bg-primary p-2 rounded position-relative">
                            <i class="fas fa-eye text-white fa-fw"></i>
                            <?php if($chamado['visto_adm'] == 0):?>
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                            <?php endif?>
                        </a>
                        <a href="" class="mx-3 bg-warning p-2 rounded">
                            <i class="fas fa-edit text-white fa-fw"></i>
                        </a>
                    </td>
                </tr>
            <?php $i++;
            endforeach; ?>
        </tbody>
    </table>
</div>


<script src="<?= asset('assets/js/plugins/datatables.js') ?>" type="text/javascript"></script>
<script src="<?= asset('assets/js/init/datatable.js') ?>" type="text/javascript"></script>
