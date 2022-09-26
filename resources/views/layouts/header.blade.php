<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Admin page | </title>

    <!-- Bootstrap -->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('assets/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('assets/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('assets/build/css/custom.min.css')}}" rel="stylesheet">
    <style>
    .pagination {
      float: right;
    }
    .pagination li {
      display: contents;
      width: 40px;
      height: 40px;
      line-height: 40px;
      text-align: center;
      background-color: #FFF;
      border: 1px solid #E4E7ED;
      -webkit-transition: 0.2s all;
      transition: 0.2s all;
    }
    .liste {
      list-style-type: none;
    }
    .liste li:hover {
      list-style-type: circle;
      color:#1ABB9C;
      font-size: medium;
    }
    .liste li a:hover {
      list-style-type: circle;
      color: #1ABB9C;
      font-size: medium;
    }
    .active {
      list-style-type: circle;
      color:#687B78;
      font-size: medium;
    }
    </style>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Miray Geek!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('assets/images/user.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenue,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Accueil <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                     
                    </ul>
                  </li>
                
                  <li><a><i class="fa fa-table"></i> Categorie chambre <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('categorie.add') }}">Ajout categorie</a></li>
                      <li><a href="{{ route('categorie.liste') }}">Gerer categorie</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Chambre <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="{{ route('chambre.add') }}">Ajout chambre</a></li>
                      <li><a href="{{ route('chambre.liste') }}">Gerer chambre</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bookmark-o"></i> Reservation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('reservation.liste') }}">Toutes reservation</a></li>
                      <li><a href="{{ route('reservation.liste_attente') }}">Nouveau reservation</a></li>
                      <li><a href="{{ route('reservation.liste_accepte') }}">Reservation accepté</a></li>
                      <li><a href="{{ route('reservation.liste_annule') }}">Reservation annulé</a></li>
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i> Consommation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('cons.ajout') }}">Ajout consommation</a></li>
                      <li><a href="{{ route('cons.liste') }}">Liste des consommations</a></li>
                   
                      <li><a href="{{ route('client.listecc') }}">Ajout consommation du client</a></li>
                      <li><a href="{{ route('consommation.liste') }}">Gerer consommation du client</a></li>
                   
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i> Prestation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('pres.ajout') }}">Ajout prestation</a></li>
                      <li><a href="{{ route('pres.liste') }}">Liste des prestations</a></li>
                      <li><a href="{{ route('client.listec') }}">Ajout prestation du client</a></li>
                      <li><a href="{{ route('prestation.liste') }}">Gerer prestation du client</a></li>
                   
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user"></i> Gerer client <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                   
                      <li><a href="{{ route('client.liste') }}">Liste</a></li>
                   
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Facture <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                   
                      <li><a href="{{ route('client.facture') }}">Gerer facture</a></li>
                   
                     
                    </ul>
                  </li>
                  <li><a  href="{{ route('statistique') }}"><i class="fa fa-bar-chart-o"></i> Statistique </a>
                   
                  </li>
                </ul>
              </div>
            

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
         
              <a data-toggle="tooltip" data-placement="top" title="Se deconnecter" href="{{route('admin.logout')}}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('assets/images/user.png')}}" alt=""> {{ Auth::user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                   
                    <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out pull-right"></i> Se deconnecter</a></li>
                  </ul>
                </li>

               
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <!-- page content --> 
        @yield('content')
        <!-- /page content -->
         <!-- footer content -->
         <footer>
          <div class="pull-right">
            Gestion hotelerie realisé par <a href="https://colorlib.com"> Mr Finaritra</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('assets/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('assets/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('assets/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('assets/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('assets/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('assets/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('assets/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('assets/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('assets/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('assets/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('assets/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('assets/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('assets/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('assets/build/js/custom.min.js')}}"></script>
   <!-- Charts js -->
 
 <!--
      <script src="{{url( 'vendor1/Chart.min.js' )}}"></script>
    <script src="{{url( 'vendor1/create-charts.js' )}}"></script>
    <script src="{{url( 'vendor1/jquery.min.js' )}}"></script>
 -->
  </body>
</html>
