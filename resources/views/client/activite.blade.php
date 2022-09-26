@extends('layouts.header')

@section('content')

   <!-- page content -->
   <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Profile client</h3>
              </div>


            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Le profile du client <small>et leur activité</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="{{asset('assets/images/user.png')}}" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3>{{ $user->name}} {{ $user->prenom_cli}}</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> {{$user->adrs_cli}}, {{$user->ville_cli}}, {{$user->pays_cli}}
                        </li>

                        <li>
                          <i class="fa fa-phone user-profile-icon"></i> {{$user->tel_cli}}
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-envelope user-profile-icon"></i> {{$user->email}}
                         
                        </li>
                      </ul>

                  
                      <br />

                      <!-- start skills -->
                      <h4>Activite</h4>
                      <ul class="list-unstyled user_data">
                        <li>
                          <p>Reservation effectuer ({{count($resTotal)}})</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{count($resTotal)}}"></div>
                          </div>
                        </li>
                        <li>
                          <p>Favorie({{ $favTotal->fav}})</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{ $favTotal->fav}}"></div>
                          </div>
                        </li>
                        
                          
                      </ul>
                      <!-- end of skills -->

                    </div>
                   
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div class="profile_title">
                          <div class="col-md-6">
                            <h2>Activité du client</h2>
                          </div>
                          
                        </div>
                      <!-- start of user-activity-graph -->
                      <div id="chartContainer" style="width:100%; height:280px;"></div>
                      <!-- end of user-activity-graph -->
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Historique de reservation</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Favoris</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Consommation</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Prestation</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                           <!-- start user projects -->
                          <table class="data table table-striped no-margin">
                            <thead>
                                <tr>
                                
                                <th>N°:</th>
                            
                                <th class="text-center">Lit</th>
                                <th class="text-center">Personne</th>
                                <th class="text-center">Etage</th>
                                <th class="text-center">Debut</th> 
                                <th class="text-center">Fin</th> 
                                <th class="text-center">Jour</th> 
                                <th class="text-center">Montant</th> 
                                <th class="text-center">Status</th> 
                                <th>Description</th>
                                
                            
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($resListe as $liste)
                                <?php
                                  $number =  $liste->montant ;
                                  $n=  str_replace(',',' ', number_format($number,3));
                                  $a = strstr($n, '.');
                                  $prix= str_replace($a,'',$n);
                                  
                                ?>
                                <tr>
                                
                                <td>{{$liste->id }}</td>
                                
                                <td>{{$liste->nbr_lit_ch}}</td>
                                <td>{{$liste->nbr_pers}}</td>
                                <td>{{$liste->etage_ch}} </td>
                                <td>{{$liste->date_debut}} </td>
                                <td>{{$liste->date_fin}} </td>
                                <td>{{$liste->nbr_jour}} </td>
                                <td>{{$prix}}Ar </td>
                                <td>
                                    @if(  $liste->status == 'Accepté')
                                    <span style="display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: middle;background-color: #1abb9c;border-radius: 10px;">{{ $liste->status }}</span>
                                    @elseif( $liste->status == 'En attente')  
                                    <span class="badge badge-success">{{ $liste->status }}</span>
                                    @else 
                                    <span style="display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: middle;background-color: red;border-radius: 10px;">{{ $liste->status }}</span>
                                    @endif 
                                </td> 
                                
                                <td> 
                                @if($liste->desc != 'Veuillez attender la validation de votre reservation!')
                                
                                    {{ $liste->desc }}
                                @else 
                                    {{ $liste->desc }}
                                @endif
                                </td> 
                                
                                
                                </tr>
                            @endforeach
                            </tbody>
                          </table>
                          <div class="pagination">
                              {{ $resListe->links()}}
                          </div>
                          <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <table class="data table table-striped no-margin">
                            <thead>
                                <tr>
                                
                              
                            
                                <th class="text-center">Chambre N°</th>
                                <th class="text-center">Chambre N°tel</th>
                                <th class="text-center">Etage</th>
                                <th class="text-center">Description</th> 
                                
                                
                            
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($favories as $liste)
                               
                                <tr>
                                
                                <td>{{$liste->id }}</td>
                                
                                <td>{{$liste->num_tel_ch}}</td>
                               
                                <td>{{$liste->etage_ch}} </td>
                                <td>{{$liste->description_ch}} </td>
               
                                
                                </tr>
                            @endforeach
                            </tbody>
                          </table>
                          <div class="pagination">
                              {{ $favories->links()}}
                          </div>
                            <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <table class="data table table-striped no-margin">
                                <thead>
                                <tr>
                                
                                    <th> N°</th>
                                  
                                    <th>Designation</th>
                                    <th>Quantite</th>
                                    <th>Prix unique(Ar)</th>
                                    <th>Montant(Ar)</th>
                                  
                                    <th>Date et Heure</th>
                                  
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ch as $c)
                                <?php
                                  $number =  $c->prix_unique ;
                                  $n=  str_replace(',',' ', number_format($number,3));
                                  $a = strstr($n, '.');
                                  $prix= str_replace($a,'',$n);
                                  
                                ?>
                                 <?php
                                  $number =  $c->montant_cons ;
                                  $n=  str_replace(',',' ', number_format($number,3));
                                  $a = strstr($n, '.');
                                  $mo= str_replace($a,'',$n);
                                  
                                ?>
                                <tr>
                                
                                    <td>{{ $c->id }}</td>
                                   
                                    <td>{{ $c->designation }}</td>
                                    <td>{{ $c->quantite_cons }}</td>
                                    <td>{{ $prix }}</td>
                                    <td>{{ $mo }}</td>
                                   
                                    <td>{{ $c->created_at }}</td>
                                   
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $ch->links()}}
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                            <table class="data table table-striped no-margin">
                                <thead>
                                    <tr>
                                    
                                        <th> N°</th>
                                        <th> Designation</th>
                                        <th>Montant(Ar)</th>
                                        <th>Date et heure</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chc as $c)
                                    <?php
                                      $number =  $c->montant_pres;
                                      $n=  str_replace(',',' ', number_format($number,3));
                                      $a = strstr($n, '.');
                                      $pres= str_replace($a,'',$n);
                                      
                                    ?>
                                    <tr>
                                    
                                        <td>{{ $c->id }}</td>
                                        <td>{{ $c->designation }}</td>
                                        <td>{{ $pres }}</td>
                                        <td>{{ $c->created_at }}</td>
                                      
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $ch->links()}}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        <script src="{{ asset('assets/js/chart_js.js') }}"></script>
        <script>
        window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          title: {
            text: "Activité au sein de l'hôtel "
          },
          data: [{
            type: "pie",
            yValueFormatString: "#,##0.\"Ar\"",
		        indexLabel: "{label} ({y})",
            dataPoints: [
              {y: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>, label: "Reservations"},
              {y: <?php echo json_encode($data_cons, JSON_NUMERIC_CHECK); ?>, label: "Consommations"},
              {y:  <?php echo json_encode($data_pres, JSON_NUMERIC_CHECK); ?>, label: "Prestations"},
             
            ]
          }]
        });
        chart.render();

        }
        </script>
@endsection