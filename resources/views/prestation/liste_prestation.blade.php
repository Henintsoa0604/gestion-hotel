@extends('layouts.header')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">a
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Liste des prestations du client</h3>
              </div>

              <div class="title_right">
               <form method="GET" action="{{route('prestation.liste.search')}}" > 
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <span class="input-group-btn" style="width: 29%;">
                        <select  class="form-control"  name="select">  
                          <option value="id">ID</option>
                          <option value="prestation_id">Designation</option>
                          <option value="prix_pres">Prix</option>
                          <option value="montant_pres">Montant</option>
                          <option value="id_cli">ID Client</option>
                          <option value="id_res">ID Reservation</option>
                         
                        </select>
                        </span>
                        <input type="text" class="form-control" name="motCle" placeholder="Rechercher...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Chercher</button>
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
                      <form method="GET" action="{{route('prestation.liste.searchDate')}}" > 
                        <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-left top_search">
                            <div class="input-group">
                                <input type="date" class="form-control" name="date" placeholder="date de prestation...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Valider</button>
                                </span>
                            </div>
                        </div>  
                      </form>
          
                      <a  href="{{ route('prestation.liste')}}" class="btn btn-round btn-default" >Toute les prestations</a>
                    
                    
                      <table class="table" id="table">
                        <thead>
                          <tr>
                          
                            <th> N°</th>
                            <th> N° prestation</th>
                            <th> Designation</th>
                            <th>Montant(Ar)</th>
                            <th>N° client</th>
                            <th>Nom et prenom</th>
                            <th>N° Reservation</th>
                            <th>Date et heure</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($ch as $c)
                          <tr style="cursor: pointer">
                          <?php
                            $number =   $c->montant_pres ;
                            $n=  str_replace(',',' ', number_format($number,3));
                            $a = strstr($n, '.');
                            $prix= str_replace($a,'',$n);
                            
                            ?>
                            <td>{{ $c->id }}</td>
                          
                            <td>{{ $c->prestation_id }}</td>
                            <td>{{ $c->designation }}</td>
                            <td>{{ $prix }}</td>
                            <td>{{ $c->prestation_id}}</td>
                            <td>{{ $c->name }} {{ $c->prenom_cli }}</td>
                            <td>{{ $c->reservation_id }}</td>
                            <td>{{ $c->created_at }}</td>
                            
                            <td>
                            
                             
                              <a href="{{ route('prestation.delete',['id'=>$c->id]) }}" onclick="return confirm('Voulez vous supprimer ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                      <div class="pagination">
                          <ul>{{ $ch->links()}} </ul>
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-3 col-xs-12">

                    <section class="panel">

                      <div class="x_title">
                        <h2>Prestation</h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="panel-body">
                          <!-- start form for validation -->
                          <h3 class="green"><i class="fa fa-paint-brush"></i>Modifier Prestation </h3>
                          <br>
                          <p>Veuillez modifier les formulaires ci-dessous pour modifier la Prestation.</strong></p>
                          <!-- start form for validation -->
                          <form method="POST" action="{{ route('prestation.edit.submit' )}}" onsubmit="return checkEmptyInput()" enctype="multipart/form-data">
                          {{ csrf_field() }}
                         
                            <input type="text"  class="form-control{{ $errors->has('id') ?  ' parsley-error' : '' }}" name="id" id="id"   readOnly="readOnly" style="display:none;" />
                            
                            <label for="prestation_id">Designation:</label>
                            <select class="form-control{{ $errors->has('prestation_id') ? ' parsley-error' : '' }}" name="prestation_id"  >
                              <option id="prestation_id"></option>
                              @foreach($pres as $p)
                               <option value="{{ $p->id}}">{{ $p->designation}}</option>
                              @endforeach
                            </select>
                              @if ($errors->has('prestation_id'))
                                  <span class="help-block">
                                  <strong style="color: #ff00007a;">{{ $errors->first('prestation_id') }}</strong>
                                  </span>
                              @endif
                           
                           
                             
                           
                                <br/>
                              
                                  <button type="submit" class="btn  btn-info btn-sm">Modifier</button>
                              
                          
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
                        
                          prestation_id= document.getElementById("prestation_id").value;
                       
                          
                          if(  prestation_id=== ""){
                          
                            swal({
                              
                              text: "Veuillez selectionner une ligne dans la tableau pour modifier la Prestation",
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
                                  document.getElementById("id").value = this.cells[0].innerHTML;
                                  document.getElementById("prestation_id").value = this.cells[1].innerHTML;
                                  document.getElementById("prestation_id").innerHTML = this.cells[2].innerHTML;
                                 
                              
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