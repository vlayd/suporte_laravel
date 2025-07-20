<div class="table-responsive p-4">
    <table class="table align-items-center mb-0" id="data-list-usuarios">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Setor</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr class="status" data-bs-toggle="modal" data-bs-target="#statusModal" id="tr{{$usuario->idUser}}">
                <td class="text-sm">
                    <div class="d-flex px-2">
                        <div>
                            <img src="{{asset(PATH_FOTO.'/'.$usuario->idUser.'/'.$usuario->foto)}}" class="avatar avatar-sm rounded-circle me-2">
                        </div>
                        <div class="my-auto">
                            {{$usuario->nome}}
                        </div>
                    </div>
                </td>
                <td class="text-sm">{{$usuario->nomeSetor}}</td>
                <td class="">
                    <span id="badgeNaoIniciadaNaoVisto" class="badge badge-lg bg-danger">{{$usuario->qtChamado}}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="<?= asset('assets/js/plugins/datatables.js') ?>" type="text/javascript"></script>
<script src="<?= asset('assets/js/init/datatable.js') ?>" type="text/javascript"></script>
