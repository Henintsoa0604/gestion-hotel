@extends('layouts.header')

@section('content')
   <!-- page content -->
   <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Facture Pour le client au sein de l'hotel</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Liste de reservation</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="col-md-7 col-sm-9 col-xs-12">

                      <ul class="stats-overview">
                        <li>
                          <span class="name">Total Reservation </span>
                          <span class="value text-success">@foreach($countRes as $count) {{ $count->count }} @endforeach</span>
                        </li>
                        <li>
                          <span class="name"> Total accepté </span>
                          <span class="value text-success"> @foreach($countResAccept as $count) {{ $count->count }} @endforeach </span>
                        </li>
                        <li class="hidden-phone">
                          <span class="name"> Total client  </span>
                          <span class="value text-success"> @foreach($countCli as $count) {{ $count->count }} @endforeach </span>
                        </li>
                      </ul>
                      <br />
                      <p>La liste ci-dessous represernte la liste des clients et l Identifiant de la reservation qu'ils faites</p>
                      <table class="table table-striped" id="table">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Id client</th>
                                  <th>ID Res</th>
                                  <th>Nom et Prenom</th>
                                  <th>Debut</th>
                                  <th>Fin</th>
                                  <th>Status</th>
                                  
                                  
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($resListe as $liste)
                                <tr style="cursor: pointer">
                                 <td class="a-center ">
                                   <input type="checkbox" id="check"  />
                                  </td>
                                  <td>{{ $liste->idcli}}</td>
                                  <th >{{ $liste->id}}</th>
                                  <td>{{ $liste->name}} {{ $liste->prenom_cli}}</td>
                                  <td>{{ $liste->date_debut}}</td>
                                  <td>{{ $liste->date_fin}}</td>
                                  <td>{{ $liste->status}}</td>
                                  
                                 
                                </tr>
                              @endforeach
                              </tbody>
                            </table>

                      <div>

                       


                      </div>


                    </div>

                    <!-- start project-detail sidebar -->
                    <div class="col-md-5 col-sm-3 col-xs-12">

                      <section class="panel">

                        <div class="x_title">
                          <h2>Facture du client</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                          <h3 class="green"><i class="fa fa-paint-brush"></i> Facture </h3>

                          <p>La facture represente la reservation, la consommation et la prestation du client pendant le sejour du client ai sein de l'hotel. <br><strong> </strong></p>
                          <br />
                          <form method="get" action="{{ route('client.fac') }}" onsubmit="return checkEmptyInput()">
                          <div class="project_detail">
                           
                           
                            <input type="text" class="form-control" name="id_cli" id="id_cli" style="display:none;"><br>
                          
                            <input type="text" class="form-control" name="id_res" id="id_res" style="display:none;"><br>
                            <input type="text" class="form-control"  id="nom" readonly="readonly" ><br>
                          
                          </div>

                        

                          <div class="text-left mtop20"  target="_blank">
                        
                            <input type ="submit" class="btn btn-sm btn-warning" value="Valider">
                          </div>
                          </form>
                        </div>

                      </section>

                    </div>
                    <!-- end project-detail sidebar -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
        <script>
          function checkEmptyInput()
          {
                  
                  var  id_cli = document.getElementById("id_cli").value;
                  var  id_res = document.getElementById("id_res").value;
                  var  nom = document.getElementById("nom").value;
                   
                    if(  id_cli === ""){
                    
                      swal({
                        
                        text: "Veuillez selectionner une ligne dans la tableau pour obtenir la facture",
                        icon: "warning",
                        button: "Ok",
                      });
                    return false;
                    } else if( id_res === ""){
                    
                          swal({
                          
                          text: "Veuillez selectionner une ligne dans la tableau pour obtenir la facture",
                          icon: "warning",
                          button: "Ok",
                        });
                          return false;
                    }   else if( nom === ""){
                    
                          swal({
                          
                          text: "Veuillez selectionner une ligne dans la tableau pour obtenir la facture",
                          icon: "warning",
                          button: "Ok",
                        });
                          return false;
                    }  
          }
        </script>
        <script>
            
            var rIndex,
                table = document.getElementById("table");
            
                
          
            
            // display selected row data into input text
            function selectedRowToInput()
            {
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                      // get the seected row index
                      rIndex = this.rowIndex;
                      this.cells[0].style.color ='red';
                      this.cells[1].style.color ='red';
                      this.cells[2].style.color ='red';
                      this.cells[3].style.color ='red';
                      this.cells[4].style.color ='red';
                      this.cells[5].style.color ='red';
                      this.cells[6].style.color ='red';
                      document.getElementById("id_cli").value = this.cells[1].innerHTML;
                      document.getElementById("id_res").value = this.cells[2].innerHTML;
                      document.getElementById("nom").value = this.cells[3].innerHTML;
                    
                    };
                }
            }
            selectedRowToInput();
            
           
        </script>
        <!-- /page content -->
@endsection