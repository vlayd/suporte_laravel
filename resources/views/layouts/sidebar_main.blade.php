<!-- INÍCIO Menu lateral -->
<div class="min-height-300 bg-primary position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" href="{{asset('')}}">
            <img src="{{asset('assets/img/apoio/logo_transp.png')}}" class="navbar-brand-img" alt="Logo Procon"><br>
            <span class="font-weight-bold mt-n2"><?= NAME_APP ?></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">DASHBOARD</h6>
            </li>
            <li class="nav-item">
                <a href="{{asset('')}}" class="nav-link">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-home text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 ">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <hr class="horizontal dark" />
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">CHAMADO</h6>
            </li>
            <li class="nav-item">
                <a href="{{route('chamado')}}" class="nav-link">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-list text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text mx-1">Lista </span>
                    <span id="no_view_d" class="badge bg-danger badge-circle {{NAO_VISTO > 0 ?'':'d-none'}}">
                        <div id="no_view_d2">{{NAO_VISTO}}</div>
                    </span>
                    <div class="d-none" id="no_view_e">{{NAO_VISTO}}</div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('chamado.novo')}}" class="nav-link ">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-plus text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Novo</span>
                </a>
            </li>
            <li class="nav-item">
                <hr class="horizontal dark" />
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">USUÁRIOS</h6>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Listar</span>
                </a>
            </li>
            <li class="nav-item">
                <hr class="horizontal dark" />
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">GERENCIAR</h6>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" aria-controls="informacoesColapse" role="button" aria-expanded="false" href="#informacoesColapse" class="nav-link ">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-spaceship text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Informações</span>
                </a>
                <div class="collapse " id="informacoesColapse">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{route('categoria')}}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Categoria </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{route('servico')}}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal"> Serviços </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal"> Status </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 my-3">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <div class="card-body text-center p-3 w-100 pt-0">
            </div>
        </div>
    </div>
</aside>
<!-- FIM Menu lateral -->
