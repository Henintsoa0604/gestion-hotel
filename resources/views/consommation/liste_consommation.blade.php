@extends('layouts.header')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Liste des consommations</h3>
      </div>

      <div class="title_right">
        <form method="GET" action="{{route('consommation.liste.search')}}" > 
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <span class="input-group-btn" style="width: 29%;">
                <select  class="form-control"  name="select" required>  
                  <option value=""></option>
                  <option value="id">ID</option>
                  <option value="produit_id">Designation</option>
                  <option value="qte_cons">Quantite</option>
                  <option value="prix_cons">Prix</option>
                  <option value="montant_cons">Montant</option>
                  <option value="id_cli">Nom Client</option>
                  <option value="id_res">ID Reservation</option>
                  
                </select>
                </span>
                <input type="text" class="form-control" name="motCle" placeholder="Rechercher..." required>
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
            <h2> Consommation </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
      
            <div class="col-md-8 col-sm-8 col-xs-12">
                  
                <form method="GET" action="{{route('consommation.liste.searchDate')}}" > 
                  <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-left top_search">
                      <div class="input-group">
                          <input type="date" class="form-control" name="date" placeholder="date de consommation...">
                          <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">Valider</button>
                          </span>
                      </div>
                  </div>  
                </form>
            
                <a  href="{{ route('consommation.liste')}}" class="btn btn-round btn-default" >Toute les consommations</a>
                <p>La consommation du client doit enregistrer pendant la sejour du client. On retrouve sur la liste ci-dessous les clients existant </p>
          
                <br />
            
              <table class="table" id="table">
                <thead>
                  <tr>
                  
                    <th> N°</th>
                    <th> ID cons</th>
                    <th>Designation</th>
                    <th>Quantite</th>
                    <th>Prix unique(Ar)</th>
                    <th>Montant(Ar)</th>
                    <th>N° client</th>
                    <th>Nom</th>
                    <th>N° reservation</th>
                    <th>Date et Heure</th>
                    <th>Action</th>
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
                  $number = $c->montant_cons ;
                  $n=  str_replace(',',' ', number_format($number,3));
                  $a = strstr($n, '.');
                  $prix_mon= str_replace($a,'',$n);
                  
                ?>
                  <tr style="cursor: pointer">
                  
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->prod}}</td>
                    <td>{{ $c->designation }}</td>
                    <td>{{ $c->quantite_cons }}</td>
                    <td>{{ $prix }}</td>
                    <td>{{ $prix_mon }}</td>
                    <td>{{ $c->user_id }}</td>
                    <td>{{ $c->name }} {{ $c->prenom_cli }} </td>
                    <td>{{ $c->reservation_id }}</td>
                    <td>{{date('j F Y',strtotime($c->created_at)) }}</td>
                    <td>
                    
                      
                      <a href="{{ route('consommation.delete',['id'=>$c->id]) }}" onclick="return confirm('Voulez vous supprimer ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>  </a>
                      <a href="{{ route('consommation.annuler',['id'=>$c->id]) }}" onclick="return confirm('Voulez vous annuler?')" class="btn btn-info btn-xs">Annuler  </a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="pagination">
                    <ul> {{ $ch->links()}}</ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-3 col-xs-12">

              <section class="panel">

                <div class="x_title">
                  <h2>Consommation</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <!-- start form for validation -->
                    <h3 class="green"><i class="fa fa-paint-brush"></i>consommation </h3>
                    <br>
                    <p>Vous pouvez annuler une reservation en appyant sur le bouton annuler.</strong></p>
                      <!-- start form for validation 
                    <form method="POST" action="{{ route('consommation.edit.submit') }}" onsubmit="return checkEmptyInput()" enctype="multipart/form-data">
                    {{ csrf_field() }}
                   
                      <input type="text"  class="form-control" name="id" id="id"   readOnly="readOnly"   />
                    
                     
                      <label for="produit_id">Designation:</label>
                      <select  class="form-control{{ $errors->has('produit_id') ? ' parsley-error' : '' }}" name="produit_id"   >
                        <option id="produit_id" ></option>
                      </select>
                        @if ($errors->has('produit_id'))
                            <span class="help-block">
                            <strong style="color: #ff00007a;">{{ $errors->first('produit_id') }}</strong>
                            </span>
                        @endif
                      <label for="quantite_cons">Quatite :</label>
                      <input  type="text" class="form-control{{ $errors->has('quantite_cons') ?  ' parsley-error' : '' }}" name="quantite_cons"  id="quantite_cons" />
                        @if ($errors->has('quantite_cons'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('quantite_cons') }}</strong>
                            </span>
                        @endif
                     
                        
                       
                     
                           
                      
                          <br/>
                        
                            <button type="submit" class="btn  btn-info btn-sm">Modifier</button>
                         
                     
                    </form>
                    -->

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
                  
                    user_id = document.getElementById("user_id").value;
                    reservation_id = document.getElementById("reservation_id").value;
                    produit_id = document.getElementById("produit_id").value;
                    quantite_cons = document.getElementById("quantite_cons").value;
                    prix_cons = document.getElementById("prix_cons").value;
                    
                    if(  user_id === ""){
                    
                      swal({
                        
                        text: "Veuillez selectionner une ligne dans la tableau pour modifier la consommation",
                        icon: "warning",
                        button: "Ok",
                      });
                    return false;
                    } else if( reservation_id === ""){
                    
                          swal({
                          
                          text: "Veuillez selectionner une ligne dans la tableau pour modifier la consommation",
                          icon: "warning",
                          button: "Ok",
                        });
                          return false;
                    } else if( produit_id === ""){
              
                      swal({
                      
                        text: "Veuillez entrer la designation de la consommation",
                        icon: "warning",
                        button: "Ok",
                      });
                        return false;
                    } else if(  prix_cons  === ""){
                  
                        swal({
                        
                        text: "Veuillez  entrer le prix de la consommation",
                        icon: "warning",
                        button: "Ok",
                      });
                        return false;
                    } else if( quantite_cons === ""){
                          
                          swal({
                          
                            text: "Veuillez entrer la quantite de la consommation  ",
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
                            document.getElementById("produit_id").innerHTML = this.cells[1].innerHTML;
                            document.getElementById("produit_id").value = this.cells[1].innerHTML;
                            document.getElementById("quantite_cons").value = this.cells[3].innerHTML;
                          
                        
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