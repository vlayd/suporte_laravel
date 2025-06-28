<?php
$page = '';
  //Isso é para pegar o item para javascript só pela url current
//   $urlPath = str_replace(base_url(), '', current_url());
//   $itemUrl = explode('/', $urlPath)[0];
?>
<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <title>Título</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  @yield('css')
  <!-- Font Awesome Icons -->
  <link href="{{asset('assets/fontawesome/css/all.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/fontawesome/fontawesome/css/all.min.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('assets/css/jquery.toast.min.css')}}" rel="stylesheet" />
  <link id="pagestyle" href="{{asset('assets/css/argon-dashboard.css?v=2.0.5')}}" rel="stylesheet" />
<script src="{{asset('assets/js/plugins/sweetalert2.min.js')}}"></script>

</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="d-none" id="base_url">{{asset('')}}</div>

  @include('layouts.sidebar_main')

  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <!-- INÍCIO breadcrumb -->
        <nav aria-label="breadcrumb">
            @yield('breadcrumb')
        </nav>
        <!-- FIM breadcrumb -->

        <!-- INÍCIO MENU sandwich -->
        <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
          <a href="javascript:;" class="nav-link p-0">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
            </div>
          </a>
        </div>
        <!-- FIM MENU sandwich -->

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <!-- Mantem os icons a direita -->
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <div class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">{{session('user.nome')}}</span>
              </div>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="#" class="nav-link text-white p-0">
                <i class="fa fa-cog cursor-pointer"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        @yield('content')
    </div>
  </main>

<!-- INÍCIO Plugin theme -->
<div class="fixed-plugin">
  <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
    <i class="fa fa-cog py-2"> </i>
  </a>
  <div class="card shadow-lg">
    <div class="card-header pb-0 pt-3 bg-transparent ">
      <div class="float-start">
        <h5 class="mt-3 mb-0">Configurar Tema</h5>
        <p>Escolha seu estilo.</p>
      </div>
      <div class="float-end mt-4">
        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
          <i class="fa fa-close"></i>
        </button>
      </div>
      <!-- End Toggle Button -->
    </div>
    <hr class="horizontal dark my-1">
    <div class="card-body pt-sm-3 pt-0 overflow-auto">
      <!-- Sidebar Backgrounds -->
      <div>
        <h6 class="mb-0">Item selecionado</h6>
      </div>
      <a href="javascript:void(0)" class="switch-trigger background-color">
        <div class="badge-colors my-2 text-start">
          <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
        </div>
      </a>
      <!-- Sidenav Type -->
      <div class="mt-3">
        <h6 class="mb-0">Menu lateral</h6>
        <p class="text-sm">Escolha uma cor.</p>
      </div>
      <div class="d-flex">
        <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">Claro</button>
        <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Escuro</button>
      </div>
      <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
      <!-- Navbar Fixed -->
      <div class="d-flex my-3">
        <h6 class="mb-0">Fixar Topo</h6>
        <div class="form-check form-switch ps-0 ms-auto my-auto">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
      </div>
      <hr class="horizontal dark mb-1">
      <div class="d-flex my-4">
        <h6 class="mb-0">Minimizar Menu</h6>
        <div class="form-check form-switch ps-0 ms-auto my-auto">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarMinimize" onclick="navbarMinimize(this)">
        </div>
      </div>
      <hr class="horizontal dark my-sm-4">
      <div class="mt-2 mb-5 d-flex">
        <h6 class="mb-0">Light / Dark</h6>
        <div class="form-check form-switch ps-0 ms-auto my-auto">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- FIM Plugin theme -->

  <!--   Core JS Files   -->
  <script src="{{asset('assets/core/jquery-3.6.0.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/core/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/core/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/fontawesome/js/all.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/fontawesome/fontawesome/js/all.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/jquery.mask.min.js')}}"></script>
  <script src="{{asset('assets/js/init/jquery.mask.js')}}"></script>
  <script src="{{asset('assets/js/plugins/jquery.toast.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>

  <!-- Kanban scripts -->
  <script src="{{asset('assets/js/plugins/jkanban/jkanban.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  @yield('js')
  <script src="{{asset('assets/js/argon-dashboard.min.js?v=2.0.5')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/view/pages.js')}}" type="text/javascript"></script>
  @yield('js2')
</body>

</html>
