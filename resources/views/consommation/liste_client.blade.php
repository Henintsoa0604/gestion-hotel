@extends('layouts.header')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Consommation du client</h3>
              </div>

              <div class="title_right">
               <form method="GET" action="{{route('client.liste_search')}}" > 
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <span class="input-group-btn" style="width: 29%;">
                          <select  class="form-control"  name="select">  
                            <option value="idRes">Nom client</option>
                            <option value="idCli">ID Client</option>
                           
                          </select>
                        </span>
                        <input type="text" class="form-control" name="motCle" >
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
                      <h2 > Consommation </h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        
                             <p>La consommation du client doit enregistrer pendant la sejour du client. On retrouve sur la liste ci-dessous les clients existant </p>
                        
                          <br />
                       
                   
                          <table class="table table-striped jambo_table bulk_action" id="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>N° Res</th>
                                <th>Debut</th>
                                <th>Fin</th>
                                <th>N° client</th>
                                <th>Nom</th>
                              
                              </tr>
                            </thead>
                            <tbody  id="test">
                            @foreach ($client as $cli)
                              <tr style="cursor: pointer;" class="headings" class="flat" >
                                <td class="a-center ">
                                <input type="checkbox" id="check"  >
                                </td>
                                <td  >{{ $cli->idres}}</td>
                                <td>{{date('j F Y',strtotime($cli->date_debut)) }}</td>
                                <td>{{date('j F Y',strtotime($cli->date_fin))}}</td>
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
                            <h2>Ajout consommation du client</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="panel-body">
                              <!-- start form for validation -->
                              <h3 class="green"><i class="fa fa-paint-brush"></i> Consommation </h3>
                              <br>
                              <p>Veuillez completer les formulaires ci-dessous.</strong></p>
                               <!-- start form for validation -->
                                <form method="POST" action="{{ route('consommation.add.submit')}}" onsubmit="return checkEmptyInput()" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                
                                
                                  <input type="text" readonly="readonly" style="display:none;"  class="form-control{{ $errors->has('user_id') ?  ' parsley-error' : '' }}" name="reservation_id" id="reservation_id"   required />
                                    @if ($errors->has('user_id'))
                                        <span class="help-block">
                                            <strong style="color: #ff00007a;">{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif
                                
                                  <input type="text" readonly="readonly" style="display:none;" class="form-control" name="user_id"  id="user_id"    />
                                  <label for="produit_id">Nom du client :</label>
                                  <input type="text" readonly="readonly"  class="form-control" name="nom"  id="nom"    />
                                  
                                
                                
                                    <label for="produit_id">Designation consommation :</label>
                                  <select  class="form-control" name="produit_id"  >
                                  
                                    @foreach($liste_prod as $prod)
                                     <option value="{{ $prod->id }}">{{ $prod->designation }}</option>
                                    @endforeach 
                                  </select>
                                    @if ($errors->has('produit_id'))
                                        <span class="help-block">
                                          <strong style="color: #ff00007a;">{{ $errors->first('produit_id') }}</strong>
                                        </span>
                                    @endif
                                    <label for="quantite_cons">Quantité consommé :</label>
                                  <input  type="number" name="quantite_cons"  id="quantite_cons"  value="{{ old('quantite_cons')}}" class="form-control{{ $errors->has('quantite_cons') ?  ' parsley-error' : '' }}"    >
                                    @if ($errors->has('quantite_cons'))
                                        <span class="help-block">
                                          <strong style="color: #ff00007a;">{{ $errors->first('quantite_cons') }}</strong>
                                        </span>
                                    @endif
                                   
                                      <br/>
                                    
                                        <button type="submit" class="btn  btn-info btn-sm">Enregistrer</button>
                                    
                                
                                </form>
                               <!-- end form fosr validations -->

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
                          @if(Session::has('insuffisant'))
                          // alert('{{ Session::get('success') }}');	
                            swal({
                            title: "Erreur!",
                            text: "{{ Session::get('insuffisant') }}",
                            icon: "error",
                            button: "Ok",
                            });
                          @endif
                          @if(Session::has('invalide'))
                          // alert('{{ Session::get('success') }}');	
                            swal({
                            title: "Erreur!",
                            text: "{{ Session::get('invalide') }}",
                            icon: "error",
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
                               nom = document.getElementById("nom").value;
                               quantite_cons = document.getElementById("quantite_cons").value;
                                if(  user_id === ""){
                                
                                  swal({
                                   
                                    text: "Veuillez selectionner une client dans la tableau",
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
                                } else if( nom  === ""){
                                    
                                    swal({
                                      
                                      text: "Veuillez selectionner une ligne dans la tableau",
                                      icon: "warning",
                                      button: "Ok",
                                    });
                                    return false;
                                }  else if( quantite_cons  === ""){
                                    
                                    swal({
                                      
                                      text: "Veuillez entrer la quantite de la consommation",
                                      icon: "warning",
                                      button: "Ok",
                                    });
                                    return false;
                               } 
                                      
                              }
                              function onClick(){
                                document.getElementById('test').style.color='red';
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
                                        // document.getElementById("check").checked = true;
                                          
                                      
                                        };
                                    }
                              }
                              selectedRowToInput();
                          </script>
                        </div>
                        <!-- end project-detail sidebar -->
                        </div>
                      </div>
                    </div>  
                  </div> 
        
                </div> 
              </div> 
            </div> 
          </div>

@endsection