<a href="{{route('chamado.detail', Crypt::encrypt($chamado['idChamado']))}}" class="bg-primary p-2 rounded position-relative" target="_blank">
    <i class="fas fa-eye text-white fa-fw"></i>
    <?php if (($chamado['visto_adm'] == 0 && $tipo != 'enviados') || ($chamado['visto_user'] == 0 && $tipo == 'enviados')) : ?>
        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger rounded-circle">
            <span class="visually-hidden">New alerts</span>
        </span>
    <?php endif ?>
</a>
@if ($tipo == 'enviados')
@if ($chamado['status'] != 1)
<span class="mx-2 bg-secondary p-2 rounded">
    <i class="fas fa-edit text-white fa-fw"></i>
</span>
<span class="bg-secondary p-2 rounded">
    <i class="fas fa-window-close text-white fa-fw"></i>
</span>
@else
<a href="{{route('chamado.edit', Crypt::encrypt($chamado['idChamado']))}}" class="mx-2 bg-warning p-2 rounded">
    <i class="fas fa-edit text-white fa-fw"></i>
</a>
<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#cancelaModal" class="bg-danger p-2 rounded border-0 cancel-chamado" onclick="prepareCancel(<?= $chamado['idChamado'] ?>)">
    <i class="fas fa-window-close text-white fa-fw"></i>
</a>
@endif
@endif

@if ($tipo == 'recebidos')
<a href="{{route('chamado.edit', Crypt::encrypt($chamado['idChamado']))}}" class="mx-2 bg-warning p-2 rounded">
    <i class="fas fa-edit text-white fa-fw"></i>
</a>
@if ($chamado['status'] == 4)
<a href="javascript:;" class="bg-success p-2 rounded position-relative prepare_obs" data-bs-toggle="modal" data-bs-target="#modalObservacao" data-id="{{$chamado['idChamado']}}">
    <i class="fa-solid fa-message text-white fa-fw"></i>
    @if ($chamado['observacao'] == '')
        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger rounded-circle">
            <span class="visually-hidden">New alerts</span>
        </span>
    @endif
</a>
@else
<span href="javascript:;" class="bg-secondary p-2 rounded">
    <i class="fa-solid fa-message text-white fa-fw"></i>    
</span>
@endif
@endif