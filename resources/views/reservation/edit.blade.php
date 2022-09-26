@extends('layouts.header')

@section('content')
<div class="right_col" role="main">
    <div class="">
          <div class="page-title">
            <div class="title_left">
             <h3>Confirmation de la reservation</h3>
            </div>
            <div class="clearfix"></div>
            <div class="row">
               
              <div class="col-md-12"> 
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Confirmer reservation </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
                  
                  <div class="x_content">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                            
                            <p>Pour que le porte la reservation, il  faut la confirmer. Veuiller accepté ou annulé la reservation en completant la description de la confirmation  </p>
                      
                        <br />
                      
                        <table class="table" id="table">
                          <thead>
                            <tr>
                              <th>N°:</th>
                              <th>Chambre N°:</th>
                              <th>Client N°:</th>
                              <th class="text-center">Lit</th>
                              <th class="text-center">Etage</th>
                              <th class="text-center">Debut</th> 
                              <th class="text-center">Fin</th> 
                              <th class="text-center">Jour</th> 
                              <th class="text-center">Montant</th> 
                              <th class="text-center">Status</th> 
                           
                                
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($resListe as $liste)
                                <tr>
                                
                                            
                                  <td>{{$liste->id }}</td>
                                  <td>{{$liste->num_ch }}</td>
                                  <td>{{$liste->cli }}</td>
                                  <td>{{$liste->nbr_lit_ch}}</td>
                                  <td>{{$liste->etage_ch}} </td>
                                  <td>{{$liste->date_debut}} </td>
                                  <td>{{$liste->date_fin}} </td>
                                  <td>{{$liste->nbr_jour}} </td>
                                  <td>{{$liste->montant}}Ar </td>
                                  <td>
                                      @if(  $liste->status == 'Accepté')
                                      <span style="display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: middle;background-color: #1abb9c;border-radius: 10px;">{{ $liste->status }}</span>
                                      @elseif( $liste->status == 'En attente')  
                                      <span class="badge badge-success">{{ $liste->status }}</span>
                                      @else 
                                      <span style="display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: middle;background-color: red;border-radius: 10px;">{{ $liste->status }}</span>
                                      @endif 
                                  </td> 
                                
                                 
                                
                                 
                                </tr>
                              @endforeach
                          </tbody>
                        </table>
                        <div class="pagination">
                            <ul> {{ $resListe->links() }}  </ul>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">

                      <section class="panel">

                        <div class="x_title">
                          <h2 class="green">Confirmer la reservation ci-dessous</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="panel-body"> 
                          <!-- start form for validation -->
                          <form method="POST" action="{{ route('reservation.edit.submit',['id'=>$res->id] )}}" enctype="multipart/form-data">
                          {{ csrf_field() }}
                            <label for="status">Confirmation :</label>
                            <p>Confirmation de la reservation n° {{ $res->id}}</p>
                              <select class="form-control" name="status">
                                
                                      <option value="Accepté">Accepté</option>
                                      <option value="Annulé">Annulé</option>
                              </select>
                            <label for="desc">Description :</label>
                            <textarea id="message" required="required" class="form-control" name="desc"  data-parsley-minlength="0" data-parsley-maxlength="5000"></textarea>
                    
                            
                                <br/>
                              
                                  <button type="submit" class="btn  btn-info btn-sm">Valider</button>
                              
                          
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
                    </div>
                  </div>  
                </div>  
              </div> 
        
            </div> 
          </div>
    </div> 
</div> 

@endsection