
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Page client | Registre
  </title>
  <!-- Favicon -->
  <link href="{{asset('assets_login/img/brand/favicon.png')}}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{asset('assets_login/js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
  <link href="{{asset('assets_login/js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('assets_login/css/argon-dashboard.css?v=1.1.1')}}" rel="stylesheet" />
</head>

<body class="bg-default" style="background-color: #172b4d !important;">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="#">
          <img src="{{asset('assets_login/img/brand/white.png')}}" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="#">
                  <img src="{{asset('assets_login/img/brand/blue.png')}}">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{ route('register') }}">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-inner--text">Registre</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{ route('login') }}">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text">Connexion</span>
              </a>
            </li>
           
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8" style ="background: linear-gradient(87deg, #ea600e 0, #DDA96A 100%) !important">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Bienvenue!</h1>
              <p class="text-lead text-light">Creer un compte pour acceder à la reservation.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100" ></polygon>
        </svg>
      </div>
    </div>
          <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-3"><small>Page de registre pour les clients</small></div>
             
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Veuillez completer les informations</small>
              </div>
              <form  class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                   <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                            </div>
                            <input id="name" placeholder="Nom" type="text" class="form-control " name="name" value="{{ old('name') }}" required autofocus>

                           
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('prenom_cli') ? ' has-error' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                            </div>
                            <input id="prenom_cli" placeholder="Prenom" type="text" class="form-control " name="prenom_cli" value="{{ old('prenom_cli') }}">

                           
                        </div>
                        @if ($errors->has('prenom_cli'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('prenom_cli') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('adrs_cli') ? ' has-error' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-briefcase-24"></i></span>
                            </div>
                            <input id="adrs_cli" placeholder="Adresse" type="text" class="form-control " name="adrs_cli" value="{{ old('adrs_cli') }}" required>

                           
                        </div>
                        @if ($errors->has('adrs_cli'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('adrs_cli') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('ville_cli') ? ' has-error' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-briefcase-24"></i></span>
                            </div>
                            <input id="ville_cli" placeholder="Ville" type="text" class="form-control " name="ville_cli" value="{{ old('ville_cli') }}" required>

                           
                        </div>
                        @if ($errors->has('ville_cli'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('ville_cli') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('pays_cli') ? ' has-error' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-briefcase-24"></i></span>
                            </div>
                            <input id="pays_cli" placeholder="Pays" type="text" class="form-control " name="pays_cli" value="{{ old('pays_cli') }}" required>

                           
                        </div>
                        @if ($errors->has('pays_cli'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('pays_cli') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('code_postal_cli') ? ' has-error' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input id="code_postal_cli" placeholder="Code postal" type="text" class="form-control " name="code_postal_cli" value="{{ old('code_postal_cli') }}" required>

                           
                        </div>
                        @if ($errors->has('code_postal_cli'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('code_postal_cli') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('tel_cli') ? ' has-error' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                            </div>
                            <input id="tel_cli" placeholder="Telephone" type="text" class="form-control " name="tel_cli" value="{{ old('tel_cli') }}" required>

                           
                        </div>
                        @if ($errors->has('tel_cli'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('tel_cli') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input id="email" placeholder="Email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autofocus>

                           
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input id="password" placeholder="Mot de passe" type="password" class="form-control" name="password" value="{{ old('password') }}" required>

                           
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input id="password-confirm" placeholder="Confirmation mot de passe" type="password" class="form-control" value="{{ old('password') }}" name="password_confirmation" required>

                           
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                   
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4">Registre</button>
                    </div>  
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                  
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('login') }}" class="text-light"><small>Connecter</small></a>
                </div>
            </div>
            </div>
      </div>
    </div>
    <footer class="py-5">
      <div class="container">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              © 2021 <a href="#" class="font-weight-bold ml-1" target="_blank">RAKOTONAVALONA HERITIANA FINARITRA</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">Chambre</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">Reservation</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">Consommation</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">Prestaion</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core   -->
  <script src="{{asset('assets_login/js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('assets_login/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="{{asset('assets_login/js/argon-dashboard.min.js?v=1.1.1')}}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>