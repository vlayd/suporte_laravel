<div class="">
    @if ($confirma)
    <a class="" href="#" id="dropdownMenuLink<?= $i??'' ?>" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="badge badge-<?= $chamado['cor'] ?> dropdown-toggle"><?= $chamado['nomeStatus'] ?></span>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink<?= $i??'' ?>">
        <?php foreach ($status as $st) :
            if ($st['nome'] == $chamado['nomeStatus']) continue; ?>
            <li>
                <a class="dropdown-item bg-<?= $st['cor'] ?> text-white text-center" href="<?=route('chamado.updatestatus', [$chamado['idChamado'], $st['id']])?>"><?= $st['nome'] ?></a>
            </li>
        <?php endforeach ?>
    </ul>
    @else
    <div class="">
        <span class="badge badge-<?= $chamado['cor'] ?>"><?= $chamado['nomeStatus'] ?></span>
    </div>
    @endif

</div>
