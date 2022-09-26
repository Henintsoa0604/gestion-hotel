@extends('layouts.header')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Prestation du client</h3>
              </div>

              <div class="title_right">
               <form method="GET" action="{{route('client.liste_searchp')}}" > 
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <span class="input-group-btn" style="width: 29%;">
                          <select  class="form-control"  name="select" required>  
                            <option value=""></option>
                            <option value="idCli">Nom client</option>
                           
                          </select>
                        </span>
                        <input type="search" class="form-control" name="motCle" required>
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">OK</button>
                        </span>
                    </div>
                </div>  
               </form>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              
              <div class="col-md-12"> 
                <div class="x_panel">
                    <div class="x_title">
                      <h2> Prestation </h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        
                             <p>La prestation du client doit enregistrer pendant la sejour du client. On retrouve sur la liste ci-dessous les clients existant </p>
                        
                          <br />
                       
                   
                          <table class="table" id="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>N° Reservation</th>
                                <th>Debut</th>
                                <th>Fin</th>
                                <th>N° client</th>
                                <th>Nom</th>
                              
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($client as $cli)
                              <tr style="cursor: pointer">
                                <td class="a-center ">
                                 <input type="checkbox" id="check"  >
                                </td>
                                <td>{{ $cli->idPres}}</td>
                                <td>{{ $cli->date_debut}}</td>
                                <td>{{ $cli->date_fin}}</td>
                                <td>{{ $cli->id}}</td>
                                <td>{{ $cli->name }} {{ $cli->prenom_cli }}</td>
                              
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                          <div class="pagination">
                             <ul> {{ $client->links() }} </ul>
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-3 col-xs-12">

                        <section class="panel">

                          <div class="x_title">
                            <h2>Ajout prestation du client</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="panel-body">
                              <!-- start form for validation -->
                              <h3 class="green"><i class="fa fa-paint-brush"></i> prestation </h3>
                              <br>
                              <p>Veuillez completer les formulaires ci-dessous pour enregistrer une prestation du client.</strong></p>
                               <!-- start form for validation -->
                                <form method="POST" action="{{ route('prestation.add.submit' )}}" onsubmit="return checkEmptyInput()" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                
                               
                                  <input type="text"  class="form-control{{ $errors->has('user_id') ?  ' parsley-error' : '' }}" name="user_id" id="user_id"  readOnly="readOnly"  style="display:none;"/>
                                    @if ($errors->has('user_id'))
                                        <span class="help-block">
                                            <strong style="color: #ff00007a;">{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif
                               
                                  <input type="text"  class="form-control{{ $errors->has('reservation_id') ?  ' parsley-error' : '' }}" name="reservation_id" id="reservation_id" readOnly="readOnly" style="display:none;" />
                                    @if ($errors->has('reservation_id'))
                                        <span class="help-block">
                                            <strong style="color: #ff00007a;">{{ $errors->first('reservation_id') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text"  class="form-control"  id="nom" readOnly="readOnly"  />
                                  <label for="prestation_id">Designation:</label>
                                  <select class="form-control{{ $errors->has('prestation_id') ? ' parsley-error' : '' }}" name="prestation_id"  id="prestation_id" >
                                    <option value=""></option>
                                    @foreach($pres as $pre)
                                    <option value="{{ $pre->id}}"> {{ $pre->designation }}</option>
                                    @endforeach
                                  </select>  
                                    @if ($errors->has('prestation_id'))
                                        <span class="help-block">
                                        <strong style="color: #ff00007a;">{{ $errors->first('prestation_id') }}</strong>
                                        </span>
                                    @endif
                                  
                                 
                                    
                                  
                                  
                                  
                                      <br/>
                                    
                                        <button type="submit" class="btn  btn-info btn-sm">Enregistrer</button>
                                    
                                
                                </form>
                                <!-- end form for validations -->

                          </div>

                        </section>
                        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
                        <script>
                          @if(Session::has('success'))
                          // alert('{{ Session::get('success') }}');	
                            swal({
                            title: "Reussie!",
                            text: "{{ Session::get('success') }}",
                            icon: "success",
                            button: "Ok",
                            });
                          @endif
                        </script>
                        <script>
                            var rIndex,
                            table = document.getElementById("table");
                            // check the empty input
                            function checkEmptyInput()
                            {
                            
                            user_id = document.getElementById("user_id").value;
                            reservation_id = document.getElementById("reservation_id").value;
                            prestation_id = document.getElementById("prestation_id").value;
                         
                         
                              if(  user_id === ""){
                              
                                swal({
                                
                                  text: "Veuillez selectionner une clientvdans la tableau",
                                  icon: "warning",
                                  button: "Ok",
                                });
                              return false;
                              } else if( reservation_id === ""){
                              
                                swal({
                                
                                  text: "Veuillez selectionner une ligne dans la tableau",
                                  icon: "warning",
                                  button: "Ok",
                                });
                                return false;
                              } else if( prestation_id === ""){
                                  
                                swal({
                                
                                text: "Veuillez selectionner la designation de la prestation",
                                icon: "warning",
                                button: "Ok",
                                });
                                return false;
                              }  
                            }
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
                                      document.getElementById("reservation_id").value = this.cells[1].innerHTML;
                                      document.getElementById("user_id").value = this.cells[4].innerHTML;
                                      document.getElementById("nom").value = this.cells[5].innerHTML;
                                  
                                    };
                                }
                            }
                            selectedRowToInput();
                        </script>
                      </div>
                           
                    </div>  
                </div> 
        
              </div> 
            </div> 
          </div> 
        </div>  
@endsection