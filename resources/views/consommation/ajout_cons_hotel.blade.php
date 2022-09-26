@extends('layouts.header')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Consommation dans l'hotel</h3>
              </div>

         

            <div class="clearfix"></div>
            <div class="row">
              
              <div class="col-md-12"> 
                <div class="x_panel">
                    <div class="x_title">
                      <h2> Consommation </h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        
                             <p>Les differentes consommations dans l'hotel se trouve dans la liste ci-dessous</p>
                        
                          <br />
                       
                   
                          <table class="table" id="table">
                            <thead>
                              <tr>
                              
                                <th>Designation</th>
                                <th>Quantite</th>
                                <th>Prix unique</th>
                                
                              
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($cons as $cli)
                              <tr >
                              
                                <td>{{ $cli->designation}}</td>
                                <td>{{ $cli->qte}}</td>
                                <td>{{ $cli->prix_unique}}</td>
                               
                              
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                          <div class="pagination">
                             <ul> {{ $cons->links() }} </ul>
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-3 col-xs-12">

                        <section class="panel">

                          <div class="x_title">
                            <h2>Ajout nouvaeau consommation</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="panel-body">
                              <!-- start form for validation -->
                              <h3 class="green"><i class="fa fa-paint-brush"></i> Consommation </h3>
                              <br>
                              <p>Veuillez completer les formulaires ci-dessous.</strong></p>
                               <!-- start form for validation -->
                                <form method="POST" action="{{ route('cons.add.submit')}}"  enctype="multipart/form-data"  onsubmit="return checkEmptyInput()">
                                {{ csrf_field() }}
                                 <label for="designation">Designation :</label>
                                  <input  type="text" name="designation" id="designation" class="form-control{{ $errors->has('designation') ?  ' parsley-error' : '' }}"  >
                                    @if ($errors->has('designation'))
                                        <span class="help-block">
                                          <strong style="color: #ff00007a;">{{ $errors->first('designation') }}</strong>
                                        </span>
                                    @endif
                                    <label for="qte">Quantité :</label>
                                  <input  type="number" name="qte"  id="qte"  class="form-control{{ $errors->has('qte') ?  ' parsley-error' : '' }}"    >
                                    @if ($errors->has('qte'))
                                        <span class="help-block">
                                          <strong style="color: #ff00007a;">{{ $errors->first('qte') }}</strong>
                                        </span>
                                    @endif
                                    <label for="prix_unique">Prix (Ar) :</label>
                                    <input  type="text" name="prix_unique" id="prix_unique" class="form-control{{ $errors->has('prix_unique') ?  ' parsley-error' : '' }}"  >
                                    @if ($errors->has('prix_unique'))
                                        <span class="help-block">
                                          <strong style="color: #ff00007a;">{{ $errors->first('prix_unique') }}</strong>
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
                        </script>
                        <script>
                              
                              function checkEmptyInput()
                              {
                                  var prix = document.getElementById("prix_unique").value;
                                  var des = document.getElementById("designation");
                                  des.value = des.value.toUpperCase();
                                var isa = prix.length;
                                  if (isa === 3) {
                                    document.getElementById("prix_unique").value = prix.substring(0, 3) + " ";
                                      
                                  } else 
                                  
                                  if(isa === 4) {
                                    document.getElementById("prix_unique").value = prix.substring(0,1) + " " + prix.substring(1,4);
                                  } else if(isa === 5) {
                                    document.getElementById("prix_unique").value = prix.substring(0,2) + " " + prix.substring(2,5);
                                  } else if(isa === 6) {
                                    document.getElementById("prix_unique").value = prix.substring(0,3) + " " + prix.substring(3,6);
                                  } else if(isa === 7) {
                                    document.getElementById("prix_unique").value = prix.substring(0,1) + " " + prix.substring(1,4)+ " " + prix.substring(4,7);
                                  } else if(isa === 8) {
                                    document.getElementById("prix_unique").value = prix.substring(0,2) + " " + prix.substring(2,5)+ " " + prix.substring(5,8);
                                  } else if(isa === 9) {
                                    document.getElementById("prix_unique").value = prix.substring(0,3) + " " + prix.substring(3,6)+ " " + prix.substring(6,9);
                                  } else if(isa === 10) {
                                    document.getElementById("prix_unique").value = prix.substring(0,1) + " " + prix.substring(1,4)+ " " + prix.substring(4,7) + " " + prix.substring(7,10);
                                  } else if(isa > 10) {
                                    document.getElementById("prix_unique").value = prix;
                                  }
                              }
                              
                              
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