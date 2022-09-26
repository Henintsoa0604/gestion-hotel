@extends('layouts.header')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            <h3>Categorie des chambres</h3>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              
              <div class="col-md-12"> 
                <div class="x_panel">
                    <div class="x_title">
                      <h2> Gerer categorie </h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        
                             <p>Une chambre se divise en plusieur categorie. Une chambre peut etre de type simple, moyenne ou luxe, ça depend du chambre, la liste ci-dessous represente la categorie de chambre, la description et le prix de la categorie de la chambre.  </p>
                        
                          <br />
                       
                          <table class="table" id="table">
                            <thead>
                              <tr>
                                <th>N°</th>
                                <th>Code </th>
                                <th>Description</th>
                                <th>Prix(Ar)</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($categorie as $cat)
                              <?php
                                $number =  $cat->prix_cat ;
                                $n=  str_replace(',',' ', number_format($number,3));
                                $a = strstr($n, '.');
                                $prix= str_replace($a,'',$n);
                                
                              ?>
                              <tr style="cursor: pointer">
                                <th scope="row">{{ $cat->id }}</th>
                                <td>{{ $cat->code_cat }}</td>
                                <td>{{ $cat->description_cat }}</td>
                                <td>{{ $prix }}</td>
                                <td> <a href="{{ route('categorie.delete',['id'=>$cat->id]) }}" onclick="return confirm('Voulez vous supprimer ce chambre?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></td>a
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                          <div class="pagination">
                             <ul> {{ $categorie->links() }}  </ul>
                          </div>
                      </div>
                       <!-- start project-detail sidebar -->
                       <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
                        <script>
                          @if(Session::has('successs'))
                          // alert('{{ Session::get('success') }}');	
                            swal({
                            title: "Reussie!",
                            text: "{{ Session::get('successs') }}",
                            icon: "success",
                            button: "Ok",
                            });
                          @endif
                        </script>
                      <div class="col-md-4 col-sm-3 col-xs-12">

                          <section class="panel">

                            <div class="x_title">
                              <h2>Categorie</h2>
                              <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <!-- start form for validation -->
                                <h4 class="green"><i class="fa fa-paint-brush"></i> Modification Categorie </h4>
                                <br>
                                <p>Veuillez modifier la formulaire ci-dessous.</p>
                                <form method="POST" action="{{ route('categorie.update') }}" onsubmit="return checkEmptyInput()">
                                {{ csrf_field() }}
                                  
                                  <input type="text"  class="form-control{{ $errors->has('id') ?  ' parsley-error' : '' }}" name="id" value=""  id="id" readOnly="readOnly" style="display:none;" />
                                   
                                
                                  <input type="text"  class="form-control{{ $errors->has('code_cat') ?  ' parsley-error' : '' }}" name="code_cat" value="{{ old('code_cat') }}"  id="code_cat" readOnly="readOnly" style="display:none;" />
                                  
                                  <label for="description_cat" class="green">Designation categorie :</label>
                                  <input type="text" class="form-control{{ $errors->has('description_cat') ?  ' parsley-error' : '' }}" name="description_cat" value="{{ old('description_cat') }}" id="description_cat" />
                                    @if ($errors->has('description_cat'))
                                        <span class="help-block">
                                        <strong style="color: #ff00007a;">{{ $errors->first('description_cat') }}</strong>
                                        </span>
                                    @endif
                                  <label for="prix_cat" class="green">Prix(Ar) :</label>
                                  <input type="number" class="form-control{{ $errors->has('prix_cat') ? ' parsley-error' : '' }}" name="prix_cat" value="{{ old('prix_cat') }}"  id="prix_cat"  />
                                    @if ($errors->has('prix_cat'))
                                        <span class="help-block">
                                          <strong style="color: #ff00007a;">{{ $errors->first('prix_cat') }}</strong>
                                        </span>
                                    @endif
                                      <br/>
                                    
                                        <button type="submit"  class="btn  btn-info btn-sm">Modifier</button>
                                     
                                
                                </form>
                                <!-- end form for validations -->
                            </div>

                          </section>
                          <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
                           <script>  
                             function prix(){
                              var prix = document.getElementById("prix_cat").value;
                              var isa = prix.length;
                                if (isa === 3) {
                                   document.getElementById("prix_cat").value = prix.substring(0, 3) + " ";
                                    
                                } else 
                                
                                if(isa === 4) {
                                  document.getElementById("prix_cat").value = prix.substring(0,1) + " " + prix.substring(1,4);
                                } else if(isa === 5) {
                                  document.getElementById("prix_cat").value = prix.substring(0,2) + " " + prix.substring(2,5);
                                } else if(isa === 6) {
                                  document.getElementById("prix_cat").value = prix.substring(0,3) + " " + prix.substring(3,6);
                                } else if(isa === 7) {
                                  document.getElementById("prix_cat").value = prix.substring(0,1) + " " + prix.substring(1,4)+ " " + prix.substring(4,7);
                                } else if(isa === 8) {
                                  document.getElementById("prix_cat").value = prix.substring(0,2) + " " + prix.substring(2,5)+ " " + prix.substring(5,8);
                                } else if(isa === 9) {
                                  document.getElementById("prix_cat").value = prix.substring(0,3) + " " + prix.substring(3,6)+ " " + prix.substring(6,9);
                                } else if(isa === 10) {
                                  document.getElementById("prix_cat").value = prix.substring(0,1) + " " + prix.substring(1,4)+ " " + prix.substring(4,7) + " " + prix.substring(7,10);
                                } else if(isa > 10) {
                                  document.getElementById("prix_cat").value = prix;
                                }
                             }
                          </script>
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
                              
                                description_cat = document.getElementById("description_cat").value;
                                prix_cat = document.getElementById("prix_cat").value;
                                if(  description_cat === ""){
                                
                                  swal({
                                   
                                    text: "Veuillez selectionner une ligne dans la tableau",
                                    icon: "warning",
                                    button: "Ok",
                                  });
                                return false;
                                } else if( prix_cat === ""){
                                
                                  swal({
                                   
                                   text: "Veuillez selectionner une ligne dans la tableau",
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
                                        document.getElementById("code_cat").value = this.cells[1].innerHTML;
                                        document.getElementById("description_cat").value = this.cells[2].innerHTML;
                                        document.getElementById("prix_cat").value = this.cells[3].innerHTML;
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
@endsection