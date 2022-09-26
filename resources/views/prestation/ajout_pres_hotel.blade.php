@extends('layouts.header')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Prestation dans l'hotel</h3>
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
                        
                             <p>Les differentes prestations dans l'hotel se trouve dans la liste ci-dessous</p>
                        
                          <br />
                       
                   
                          <table class="table" >
                            <thead>
                              <tr>
                              
                                <th>Designation</th>
                               
                                <th>Prix unique (Ar)</th>
                                
                              
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($pres as $cli)
                              <tr style="cursor: pointer">
                              
                                <td>{{ $cli->designation}}</td>
                              
                                <td>{{ $cli->prix_unique}}</td>
                               
                              
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                          <div class="pagination">
                             <ul> {{ $pres->links() }} </ul>
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-3 col-xs-12">

                        <section class="panel">

                          <div class="x_title">
                            <h2>Ajout nouvaeau presommation</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="panel-body">
                              <!-- start form for validation -->
                              <h3 class="green"><i class="fa fa-paint-brush"></i> presommation </h3>
                              <br>
                              <p>Veuillez completer les formulaires ci-dessous.</strong></p>
                               <!-- start form for validation -->
                                <form method="POST" action="{{ route('pres.add.submit')}}" onsubmit="return checkEmptyInput()" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                 <label for="designation">Designation :</label>
                                  <input  type="text" name="designation" id="designation" class="form-control{{ $errors->has('designation') ?  ' parsley-error' : '' }}"    >
                                    @if ($errors->has('designation'))
                                        <span class="help-block">
                                          <strong style="color: #ff00007a;">{{ $errors->first('designation') }}</strong>
                                        </span>
                                    @endif
                                
                                  <input  type="number" name="qte"  id="qte" style="display:none;"  class="form-control{{ $errors->has('qte') ?  ' parsley-error' : '' }}"    >
                                    @if ($errors->has('qte'))
                                        <span class="help-block">
                                          <strong style="color: #ff00007a;">{{ $errors->first('qte') }}</strong>
                                        </span>
                                    @endif
                                    <label for="prix_unique">Prix (Ar) :</label>
                                    <input  type="number" name="prix_unique" id="prix_unique" class="form-control{{ $errors->has('prix_unique') ?  ' parsley-error' : '' }}"   >
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
                                
                                var des = document.getElementById("designation");
                                des.value = des.value.toUpperCase();
                             
                            }
                            
                            
                        </script>
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