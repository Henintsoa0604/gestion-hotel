@extends('layouts.header')

@section('content')
   <!-- page content -->
   <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">
                    @foreach($sumMontant as $sums) 
                    <?php
                        $number =  $sums->sumMontant;
                        $n=  str_replace(',',' ', number_format($number,3));
                        $a = strstr($n, '.');
                        $sumM= str_replace($a,'',$n);
                    
                    ?>
                    {{ $sumM }}Ar 
                    @endforeach
                  </div>
                  <h3>Revenue reservation</h3>
                  <p>Total reservation</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">
                    @foreach($sumCons as $sumss) 
                        <?php
                            $number =  $sumss->sumCons;
                            $n=  str_replace(',',' ', number_format($number,3));
                            $a = strstr($n, '.');
                            $sumC= str_replace($a,'',$n);
                        
                        ?>
                        {{ $sumC }}Ar 
                    @endforeach
                  </div>
                  <h3>Revenue consommation</h3>
                  <p>Total consommation.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">
                    @foreach($sumPres as $sumsss) 
                        <?php
                            $number =  $sumsss->sumPres;
                            $n=  str_replace(',',' ', number_format($number,3));
                            $a = strstr($n, '.');
                            $sumP= str_replace($a,'',$n);
                        
                        ?>
                        {{ $sumP }}Ar 
                    @endforeach
                  </div>
                  <h3>Revenue prestation</h3>
                  <p>Total prestation.</p>
                </div>
              </div>
              <?php
                    $number = $sums->sumMontant +  $sumss->sumCons +  $sumsss->sumPres;
                    $n=  str_replace(',',' ', number_format($number,3));
                    $a = strstr($n, '.');
                    $sumT= str_replace($a,'',$n);
                
                ?>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">{{ $sumT }}Ar</div>
                  <h3>Revenue total</h3>
                  <p>Toltal revenue</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Statistique des depenses des clients </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                      <div class="demo-container" style="height:280px">
                        <div id="chartContainer" class="demo-placeholder"></div>
                      </div>
                      <div class="tiles">
                        <div class="col-md-4 tile">
                          <span>Total clients</span>
                          <h2> @foreach($countCli as $count) {{ $count->countCli }} @endforeach</h2>
                          <span class="sparkline11 graph" style="height: 160px;">
                               <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                        </div>
                        <div class="col-md-4 tile">
                          <span>Total Revenues</span>
                          <h2>{{ $sumT }}Ar</h2>
                          <span class="sparkline22 graph" style="height: 160px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                        </div>
                        <div class="col-md-4 tile">
                          <span>Total reservations</span>
                          <h2>@foreach($countRes as $count) {{ $count->countRes }} @endforeach</h2>
                          <span class="sparkline11 graph" style="height: 160px;">
                                 <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                        </div>
                      </div>

                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                      <div>
                        <div class="x_title">
                          <h2>Top 5 clients plus revenue</h2>
                         
                          <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles scroll-view">
                          @foreach($top as $t) 
                          <?php
                                $number = $t->montant;
                                $n=  str_replace(',',' ', number_format($number,3));
                                $a = strstr($n, '.');
                                $mm= str_replace($a,'',$n);
                            
                            ?>
                            <li class="media event">
                                <a class="pull-left border-aero profile_thumb">
                                <i class="fa fa-user aero"></i>
                                </a>
                                <div class="media-body">
                                <a class="title" href="#">{{ $t->name }} {{ $t->prenom_cli }}</a>
                                <p><strong>{{ $mm }} </strong> Ariary </p>
                               
                                </p>
                                </div>
                            </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Statistique reservation chambre </h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                      <div class="demo-container" style="height:280px">
                        <div id="chartRes" class="demo-placeholder"></div>
                      </div>
                      <div class="tiles">
                        <div class="col-md-4 tile">
                          <span>Total clients</span>
                          <h2> @foreach($countCli as $count) {{ $count->countCli }} @endforeach</h2>
                          <span class="sparkline11 graph" style="height: 160px;">
                               <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                        </div>
                        <div class="col-md-4 tile">
                          <span>Total Revenues</span>
                          <h2>{{ $sumT }}Ar</h2>
                          <span class="sparkline22 graph" style="height: 160px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                        </div>
                        <div class="col-md-4 tile">
                          <span>Total reservations</span>
                          <h2>@foreach($countRes as $count) {{ $count->countRes }} @endforeach</h2>
                          <span class="sparkline11 graph" style="height: 160px;">
                                 <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                        </div>
                      </div>

                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                      <div>
                        <div class="x_title">
                          <h2>Top 5 clients plus revenue</h2>
                         
                          <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles scroll-view">
                          @foreach($top as $t) 
                          <?php
                                $number = $t->montant;
                                $n=  str_replace(',',' ', number_format($number,3));
                                $a = strstr($n, '.');
                                $mm= str_replace($a,'',$n);
                            
                            ?>
                            <li class="media event">
                                <a class="pull-left border-aero profile_thumb">
                                <i class="fa fa-user aero"></i>
                                </a>
                                <div class="media-body">
                                <a class="title" href="#">{{ $t->name }} {{ $t->prenom_cli }}</a>
                                <p><strong>{{ $mm }} </strong> Ariary </p>
                               
                                </p>
                                </div>
                            </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="col-md-6">
                      <h3>Revenue sur la reservation<small></small></h3>
                    </div>
                    <div class="col-md-6">
                      <input type="text"  id="myInput" onkeyup="myFunction()" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                       
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12"  >
                      <table id="myTable" class="table table-striped"> 
                      
                          <tr class="header">
                            <th>Date de reservation</th>
                            <th>Reservation N°</th>
                            <th>Chambre N°</th>
                            <th>Montant(Ar)</th>
                           
                          </tr>
                      
                       
                          @foreach($reservation as $res)
                          <?php
                              $number = $res->montant;
                              $n=  str_replace(',',' ', number_format($number,3));
                              $a = strstr($n, '.');
                              $montant= str_replace($a,'',$n);
                          
                          ?>
                          <tr>
                            <td> {{ date('j F Y',strtotime($res->created_at)) }}</td>
                            <td>{{ $res->id}}</td>
                            <td>{{ $res->num_ch}}</td>
                           
                            <td>{{ $montant }}</td>
                          </tr>
                          @endforeach
                          <?php
                              $number =  $sum;
                              $n=  str_replace(',',' ', number_format($number,3));
                              $a = strstr($n, '.');
                              $total= str_replace($a,'',$n);
                          
                          ?>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td >Revenue: {{ $total }}Ar</td>
                           
                          </tr>
                       
                      </table>
                     
                  
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                      <div>
                        <div class="x_title">
                          <h2>Top 5 clients plus revenue</h2>
                         
                          <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles scroll-view">
                          @foreach($top as $t) 
                          <?php
                                $number = $t->montant;
                                $n=  str_replace(',',' ', number_format($number,3));
                                $a = strstr($n, '.');
                                $mm= str_replace($a,'',$n);
                            
                            ?>
                            <li class="media event">
                                <a class="pull-left border-aero profile_thumb">
                                <i class="fa fa-user aero"></i>
                                </a>
                                <div class="media-body">
                                <a class="title" href="#">{{ $t->name }} {{ $t->prenom_cli }}</a>
                                <p><strong>{{ $mm }} </strong> Ariary </p>
                               
                                </p>
                                </div>
                            </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>
        <!-- /page content -->
         
        <!-- /page content -->
        <script>
        function myFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
              td = tr[i].getElementsByTagName("td")[0];
              if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
                } else {
                  tr[i].style.display = "none";
                }
              }       
            }
        }
        
        </script>
        <script src="{{ asset('assets/js/chart_js.js') }}"></script>
        <script>
        window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          title: {
            text: "Statistique de chaque client avec leur depense dans l'hotel"
          },
          data: [{
                type:'pie', //"column",  type: "pie",
                yValueFormatString: "#,##0.\"Ar\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

        }
        </script>
        <script>

          
            // var chartType = document.getElementById("chart").value;

            var chart = new CanvasJS.Chart("chartRes", {
            animationEnabled: true,
            title: {
              text: "Revenue par mois du reservation de chambre"
            },
            
            data: [{
                type:'column', //"column",  type: "pie",
              yValueFormatString: "#,##0.\"Ar\"",
              indexLabel: "{label} ({y})",
              dataPoints: <?php echo json_encode($datares, JSON_NUMERIC_CHECK); ?>
            }]
          });
          chart.render();
         

          // window.onload = function() {

                
          // }
        </script>
        

@endsection