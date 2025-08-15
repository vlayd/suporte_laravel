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
                            <img src="{{RH_USUARIOS.$usuario->idUser.'/perfil/'.$usuario->foto}}" class="avatar avatar-sm rounded-circle me-2">
                        </div>
                        <div class="my-auto">
                            {{$usuario->nome}}
                        </div>
                    </div>
                </td>
                <td class="text-sm">{{$usuario->nomeSetor}}</td>
                <td>
                    <span id="badgeNaoIniciadaNaoVisto" class="badge badge-lg bg-danger">{{$usuario->qtChamado}}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
