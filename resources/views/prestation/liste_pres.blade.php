@extends('layouts.header')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Liste des prestations</h3>
      </div>

      <div class="title_right">
        <form method="GET" action="{{route('pres.liste.search')}}" > 
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <span class="input-group-btn" style="width: 29%;">
                <select  class="form-control"  name="select">  
                  <option value="id">Identifiant</option>
                  <option value="designation">Designation</option>
                  <option value="prix_unique">Prix</option>
                 
                  
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
            <h2> prestation </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
      
            <div class="col-md-8 col-sm-8 col-xs-12">
                  
                <form method="GET" action="{{route('pres.liste.searchDate')}}" > 
                  <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-left top_search">
                      <div class="input-group">
                          <input type="date" class="form-control" name="date" placeholder="date de prestation...">
                          <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">Valider</button>
                          </span>
                      </div>
                  </div>  
                </form>
            
                <a  href="{{ route('pres.liste')}}" class="btn btn-round btn-default" >Toute les prestations</a>
                <p>Liste des prestations existants dans l'hotel.</p>
          
                <br />
            
              <table class="table" id="table">
                <thead>
                  <tr>
                  
                    <th> N°</th>
                    <th>Designation</th>
                  
                    <th>Prix unitaire(Ar)</th>
                     <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($listes as $c)
                  <tr style="cursor: pointer">
                  <?php
                  $number =  $c->prix_unique ;
                  $n=  str_replace(',',' ', number_format($number,3));
                  $a = strstr($n, '.');
                  $prix= str_replace($a,'',$n);
                  
                  ?>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->designation }}</td>
                  
                    <td>{{ $prix }}</td>
                   
                    <td>
                    
                      
                      <a href="{{ route('pres.delete',['id'=>$c->id]) }}" onclick="return confirm('Voulez vous supprimer ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>  </a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="pagination">
                    <ul> {{ $listes->links()}}</ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-3 col-xs-12">

              <section class="panel">

                <div class="x_title">
                  <h2>prestation</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <!-- start form for validation -->
                    <h3 class="green"><i class="fa fa-paint-brush"></i>Modifier prestation </h3>
                    <br>
                    <p>Veuillez modifier les formulaires ci-dessous pour modifier la prestation.</strong></p>
                      <!-- start form for validation -->
                    <form method="POST" action="{{ route('pres.edit.submit') }}" onsubmit="return checkEmptyInput()" enctype="multipart/form-data">
                    {{ csrf_field() }}
                   
                      <input type="text"  class="form-control" name="id" id="id"   readOnly="readOnly" style="visibility: hidden;"   />
                    
                     
                      <label for="designation">Designation:</label>
                      <input type="text" class="form-control{{ $errors->has('designation') ? ' parsley-error' : '' }}" name="designation" id="designation"  />
                        @if ($errors->has('designation'))
                            <span class="help-block">
                            <strong style="color: #ff00007a;">{{ $errors->first('designation') }}</strong>
                            </span>
                        @endif
                     
                      <label for="prix_unique">Prix prestation(Ar) :</label>
                      <input type="number" class="form-control{{ $errors->has('prix_unique') ? ' parsley-error' : '' }}" name="prix_unique" id="prix_unique"     />
                        @if ($errors->has('prix_unique'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('prix_unique') }}</strong>
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
              <script>
                    var rIndex,
                  table = document.getElementById("table");
                  // check the empty input
                  function checkEmptyInput()
                  {
                  
    
                   designation = document.getElementById("designation").value;
                   document.getElementById("designation").value = document.getElementById("designation").value.toUpperCase();
                   prix_unique = document.getElementById("prix_unique").value;
                 
                    
                    if( designation === ""){
              
                      swal({
                      
                        text: "Veuillez selectionner la designation de la prestation dans la tableau",
                        icon: "warning",
                        button: "Ok",
                      });
                        return false;
                    } else if(  prix_unique  === ""){
                  
                        swal({
                        
                        text: "Veuillez  selectionner le prix de la prestation dans le tableau",
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
                            document.getElementById("designation").value = this.cells[1].innerHTML;
                            document.getElementById("prix_unique").value = this.cells[2].innerHTML;
                           
                        
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