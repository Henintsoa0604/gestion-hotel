<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Page admin | Accueil</title>

    <!-- Bootstrap -->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('assets/build/css/custom.min.css')}}" rel="stylesheet">
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
                  <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Tableau de bord </a>
                    
                  </li>
                
                  <li><a href="{{ route('categorie.add') }}"><i class="fa fa-table"></i> Categorie chambre</a>
                   
                  </li>
                  <li><a href="{{ route('chambre.add') }}"><i class="fa fa-edit"></i> Chambre</a>
                   
                  </li>
                  <li><a  href="{{ route('reservation.liste') }}"><i class="fa fa-bookmark-o"></i> Reservation</a>
                    
                  </li>
                  <li><a href="{{ route('cons.ajout') }}"><i class="fa fa-clone"></i> Consommation</a>
                   
                  </li>
                  <li><a  href="{{ route('pres.ajout') }}"><i class="fa fa-clone"></i> Prestation</a>
                   
                  </li>
                  <li><a  href="{{ route('client.liste') }}"><i class="fa fa-user"></i> Client</a>
                   
                  </li>
                  <li><a  href="{{ route('client.facture') }}"><i class="fa fa-edit"></i> Facture</a>
                   
                  </li>
                  <li><a  href="{{ route('statistique') }}"><i class="fa fa-bar-chart-o"></i> Statistique</a>
                   
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
       <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total client</span>
              <div class="count">{{$totalCli}}</div>
              <span class="count_bottom"><i class="green"></i> Client registre</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total administrateur</span>
              <div class="count">{{$totalAdmin}}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Administrateur dans l'hotel</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total reservation</span>
              <div class="count green">{{$totalRes}}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i> Total reservation</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Reservation accepté</span>
              <div class="count">{{$acc}}</div>
              <span class="count_bottom"><i class="red"> </i>Les reservation acceptées</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Reservation en attente</span>
              <div class="count">{{$att}}</div>
              <span class="count_bottom"></i></i> les reservations en attente</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Reservation annulé</span>
              <div class="count">{{$ann}}</div>
              <span class="count_bottom"><i class="green"></i> Les reservation annulé</span>
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Revenue sur la reservation  <small>par mois</small></h3>
                  </div>
                  
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <canvas id="mybarChart" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 970px; height: 280px;"></canvas>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Reservation plus recent</h2>
                    <div class="clearfix"></div>
                  </div>
               
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Description</th>
                          <th>status</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($res as $r)
                         <tr>
                          <td>{{ $r->id}}</td>
                          <td>{{ $r->description_ch}}</td>
                          <td>{{ $r->status}}</td>
                         </tr>
                        @endforeach  
                      </tbody>
                    </table>
                  
                  </div> <div class="clearfix"></div> <br>  <br>  <br>  <br>
                 

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />


          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Information <small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Information sur la reservation&nbsp;</a>
                                          </h2>
                           
                            <p class="excerpt">Vous pouvez consulter la liste des reservations du client. La liste des reservations accepté, en attente et l'annulé.La reservation est accepté si les informations du client sont complet. <a  href="{{ route('reservation.liste') }}">Detail&nbsp;de la reseration</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Information sur la consommation&nbsp;</a>
                                          </h2>
                           
                            <p class="excerpt">Vous pouvez consulter la liste des consommation . Ajouter nouveau consommation, modifier ou supprimer des consommations du client. pour gerer la consommation.Il faut appuyer sur gerer consoammtion.</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Information sur la prestation&nbsp;</a>
                                          </h2>
                           
                            <p class="excerpt">Vous pouvez consulter la liste des prestations . Ajouter nouveau prestation, modifier ou supprimer des prestations du client. pour gerer la prestation.Il faut appuyer sur gerer prestation.</a>
                            </p>
                          </div>
                        </div>
                      </li>
                   
                    </ul>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-8 col-sm-8 col-xs-12">



              <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Liste des reservations <small>reservation recent</small></h2>
                    
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Date debut</th>
                            <th>Date fin</th>
                            <th>Jour</th>
                            <th>Nom</th>
                            <th>Description</th>
                            
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($resListe as $liste)
                          <tr>
                           
                            <td>{{$liste->id}}</td>
                            <td>{{ date('j F Y',strtotime($liste->date_debut)) }}</td>
                            <td>{{ date('j F Y',strtotime($liste->date_fin)) }}</td>
                            <td>{{$liste->nbr_jour}}</td>
                            <td>{{$liste->name}} {{$liste->prenom_cli}}</td>
                            <td>{{$liste->description_ch}}</td>
                        
                            <td>{{$liste->status}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <a class="pull-right" style="color:green" href="{{ route('reservation.liste') }}">Detail</a>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">


                <!-- Start to do list -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Liste de reservation une semaine avant <small></small></h2>
                      
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Date debut</th>
                            <th>Date fin</th>
                            <th>Jour</th>
                            <th>Nom</th>
                            <th>Description</th>
                            
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($semaine as $list)
                          <tr>
                           
                            <td>{{$list->id}}</td>
                            <td>{{ date('j F Y',strtotime($list->date_debut)) }}</td>
                            <td>{{ date('j F Y',strtotime($list->date_fin)) }}</td>
                            <td>{{$list->nbr_jour}}</td>
                            <td>{{$list->name}} {{$list->prenom_cli}}</td>
                            <td>{{$list->description_ch}}</td>
                        
                            <td>{{$list->status}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- End to do list -->

                <!-- start of weather widget -->
                <div class="col-md-6 col-sm-6 col-xs-12" style="display:none;">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Daily active users <small>Sessions</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="temperature"><b>Monday</b>, 07:30 AM
                            <span>F</span>
                            <span><b>C</b></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="weather-icon">
                            <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                          </div>
                        </div>
                        <div class="col-sm-8">
                          <div class="weather-text">
                            <h2>Texas <br><i>Partly Cloudy Day</i></h2>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="weather-text pull-right">
                          <h3 class="degrees">23</h3>
                        </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="row weather-days">
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Mon</h2>
                            <h3 class="degrees">25</h3>
                            <canvas id="clear-day" width="32" height="32"></canvas>
                            <h5>15 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Tue</h2>
                            <h3 class="degrees">25</h3>
                            <canvas height="32" width="32" id="rain"></canvas>
                            <h5>12 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Wed</h2>
                            <h3 class="degrees">27</h3>
                            <canvas height="32" width="32" id="snow"></canvas>
                            <h5>14 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Thu</h2>
                            <h3 class="degrees">28</h3>
                            <canvas height="32" width="32" id="sleet"></canvas>
                            <h5>15 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Fri</h2>
                            <h3 class="degrees">28</h3>
                            <canvas height="32" width="32" id="wind"></canvas>
                            <h5>11 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="daily-weather">
                            <h2 class="day">Sat</h2>
                            <h3 class="degrees">26</h3>
                            <canvas height="32" width="32" id="cloudy"></canvas>
                            <h5>10 <i>km/h</i></h5>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- end of weather widget -->
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Reservation hotelerie <a href="https://miraygeek.com">Miray Geek</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- footer content -->
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

    <!-- Custom Theme Scripts -->
    <script src="{{asset('assets/build/js/custom.min.js')}}"></script>

     <script src="{{url( 'vendor1/Chart.min.js' )}}"></script>
    <script src="{{url( 'vendor1/create-charts.js' )}}"></script>
    <script src="{{url( 'vendor1/jquery.min.js' )}}"></script>

  </body>
</html>
