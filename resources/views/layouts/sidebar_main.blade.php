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
                <a href="{{asset('')}}" class="nav-link {{$activeHome??''}}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-home text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <hr class="horizontal dark" />
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">CHAMADO</h6>
            </li>
            <li class="nav-item">
                @if (session('user.nivel') != 1)
                <a data-bs-toggle="collapse" aria-controls="listaColapse" role="button" aria-expanded="false" href="#listaColapse" class="nav-link {{$activeLista??''}}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-list text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text mx-1">Lista </span>
                    <span class="badge bg-danger badge-circle {{TODOS['nao_visto']['setor'] > 0 ?'':'d-none'}} badge_nao_visto">
                        <div class="nao_visto_setor">{{TODOS['nao_visto']['setor']}}</div>
                    </span>
                </a>
                <div class="collapse {{$showLista??''}}" id="listaColapse">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{$activeListaenviados??''}}" href="{{route('chamado', 'enviados')}}">
                                <span class="sidenav-mini-icon"> Env </span>
                                <span class="sidenav-normal"> Enviados </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{$activeListarecebidos??''}}" href="{{route('chamado', 'recebidos')}}">
                                <span class="sidenav-mini-icon"> Rec </span>
                                <span class="sidenav-normal me-1"> Recebidos</span>
                                <span class="badge bg-danger badge-circle {{TODOS['nao_visto']['setor'] > 0 ?'':'d-none'}} badge_nao_visto">
                                    <div class="nao_visto_setor">{{TODOS['nao_visto']['setor']}}</div>
                                </span>
                            </a>
                        </li>
                        @if (session('user.nivel')==2)
                        <li class="nav-item ">
                            <a class="nav-link {{$activeListatodos??''}}" href="{{route('chamado', 'todos')}}">
                                <span class="sidenav-mini-icon"> Tod </span>
                                <span class="sidenav-normal"> Todos </span>
                            </a>
                        </li>    
                        @endif                        
                    </ul>
                </div>
                @else
                <a href="{{route('chamado', 'enviados')}}" role="button" class="nav-link {{$activeLista??''}}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-list text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text mx-1">Lista </span>
                    <div id="no_view_d" class="d-none">{{TODOS['nao_visto']['todos']}}</div>
                    <span class="no_view_e badge bg-danger badge-circle {{TODOS['nao_visto']['todos'] > 0 ?'':'d-none'}}">
                        <div>{{TODOS['nao_visto']['todos']}}</div>
                    </span>
                </a>    
                @endif
                
            </li>
            <li class="nav-item">
                <a href="{{route('chamado.novo')}}" class="nav-link {{$activeNovo??''}}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-plus text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Novo</span>
                </a>
            </li>
            @if (session('user.nivel') == 2 || session('user.nivel') == 3)
            <li class="nav-item">
                <a href="{{route('chamado.relatorio.analitico')}}" class="nav-link {{$activeRelatorio??''}}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-file-alt text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Relatório</span>
                </a>
            </li>
            @endif
            @if (session('user.nivel') == 2)
            <li class="nav-item">
                <hr class="horizontal dark" />
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">USUÁRIOS</h6>
            </li>
            <li class="nav-item">
                <a href="{{route('usuario')}}" class="nav-link {{$activeListaUser??''}}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-list text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text mx-1">Lista </span>
                </a>
            </li>
            <li class="nav-item">
                <hr class="horizontal dark" />
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">GERENCIAR</h6>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" aria-controls="informacoesColapse" role="button" aria-expanded="false" href="#informacoesColapse" class="nav-link {{$activeInformacoes??''}}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-spaceship text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Informações</span>
                </a>
                <div class="collapse {{$showInformacoes??''}}" id="informacoesColapse">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{$activeCategoria??''}}" href="{{route('categoria')}}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Categoria </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{$activeServico??''}}" href="{{route('servico')}}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal"> Serviços </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{$activeStatus??''}}" href="{{route('status')}}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal"> Status </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
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
