<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <title><?= NAME_APP ?></title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css" rel="stylesheet')}}" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="{{asset('assets/fontawesome/css/all.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/fontawesome/fontawesome/css/all.min.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('assets/css/jquery.toast.min.css')}}" rel="stylesheet" />
  <link id="pagestyle" href="{{asset('assets/css/argon-dashboard.css?v=2.0.5')}}" rel="stylesheet" />
</head>

<body class="bg-gray-100">
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-50 pt-7 bg-primary">
    </div>
    <div class="container">
      <div class="row mt-md-n11 mt-n12 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card">
            <div class="card-header pb-0 text-center">
              <img src="{{asset('assets/img/apoio/logo_transp.png')}}" class="img-fluid" alt="Procon/Acre" style="width: 200px;">
              <h3 class="font-weight-bolder"><?= NAME_APP ?></h3>
            </div>
            <div class="card-body">
              <form role="form" class="text-start needs-validation" method="post" action="login" novalidate>
                @csrf
                <label>CPF</label>
                <div class="mb-3">
                    <input type="text" name="cpf" class="form-control" value="{{old('cpf')}}" required>
                    {{-- show error --}}
                    @error('cpf')
                        <div class="text-danger text-xs">{{$message}}</div>
                    @enderror
                </div>
                <label>Senha</label>
                <div class="mb-3">
                    <input type="password" name="senha" class="form-control" required>
                    {{-- show error --}}
                    @error('senha')
                        <div class="text-danger text-xs">{{$message}}</div>
                    @enderror
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary w-100 mt-4 mb-0">Acessar</button>

                    {{-- invalid login --}}
                    @if(session('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show text-white mt-3" role="alert">
                            <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
                            <span class="alert-text"><strong>Erro! </strong>{{session('loginError')}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                  @endif

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/jquery-3.6.0.min.js')}}"></script>
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <!-- Kanban scripts -->
  <script src="{{asset('assets/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/jkanban/jkanban.js')}}"></script>
  <script src="{{asset('assets/fontawesome/js/all.min.js')}}"></script>
  <script src="{{asset('assets/js/init/perfect-scrollbar.js')}}"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/argon-dashboard.min.js?v=2.0.5')}}"></script>
</body>

</html>
