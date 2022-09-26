@extends('layouts.header')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div >
            <div class="page-title">
              <div class="title_left">
                <h3>Liste des chambres</h3>
              </div>

              <div class="title_right">
               <form method="GET" action="{{route('chambre.liste.search')}}" > 
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
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
                  <div class="x_content">         
                    <div class="col-md-3 col-sm-8 col-xs-12">
                      <!-- start form for validation -->
                      <h3 class="green"><i class="fa fa-info"></i> Chambre </h3>
                      <br>
                     
                      
                      <ul class="liste">
                        <li  class="{{ 'chambre/liste' == request()->path() ? 'active':''}}"><a  class="{{ 'chambre/liste' == request()->path() ? 'active':''}}"  href="{{ route('chambre.liste')}}" >Toute les chambres</a></li>
                        <br><li class="{{ 'chambre/liste/une' == request()->path() ? 'active':''}}"><a class="{{ 'chambre/liste/une' == request()->path() ? 'active':''}}"  href="{{ route('chambre.uneLit')}}" >Chambre une lit</a></li>
                        <br><li class="{{ 'chambre/liste/deux' == request()->path() ? 'active':''}}"><a class="{{ 'chambre/liste/deux' == request()->path() ? 'active':''}}"  href="{{ route('chambre.deuxLit')}}"  >Chambre 2 lits</a></li>
                        <br><li class="{{ 'chambre/liste/famille' == request()->path() ? 'active':''}}"><a  class="{{ 'chambre/liste/famille' == request()->path() ? 'active':''}}"  href="{{ route('chambre.familleLit')}}" >Chambre famille</a></li>
                        <br><li class="{{ 'chambre/liste/libre' == request()->path() ? 'active':''}}"><a  class="{{ 'chambre/liste/libre' == request()->path() ? 'active':''}}"  href="{{ route('chambre.libre')}}" >Disponible</a></li>
                        <br><li class="{{ 'chambre/liste/reserve' == request()->path() ? 'active':''}}"><a  class="{{ 'chambre/liste/reserve' == request()->path() ? 'active':''}}" href="{{ route('chambre.reserve')}}"class="">Reservé</a></li>
                      </ul>
                      <br>
                      <div class="clearfix"></div>
                      <h3 class="green"><i class="fa fa-info"></i> Recherche par: </h3>
                      <br>
                      <div class="col">
                        <div class="input-group">
                            <form method="GET" action="{{route('chambre.liste.searchCat')}}" > 
                            <div class="col-md-3">
                              <select name="select" class="form-control">
                                <option value="id">Id chambre</option>
                                <option value="nbr_lit_ch">Nbr de lit</option>
                                <option value="etage_ch">Etage</option>
                                <option value="description_ch">Description</option>
                              </select>
                            </div>
                            <div class="col-md-5">
                              <input type="text" name="cat" class="form-control" aria-label="Text input with dropdown button">
                            </div>
                            <div class="col-md-3">
                              <span class="input-group-btn">
                              <button class="btn btn-default" type="submit">Chercher</button>
                              </span>
                            </div>
                            </form> 
                        </div>
                              <!-- /btn-group -->
                      </div>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                   
                        <div class="x_title">
                          <h2>Liste des  chambres </h2>
                         
                          <div class="clearfix"></div>
                        </div>
                      
                         
                          <p>Une chambre se divise en plusieur categorie. Une chambre peut etre de type simple, moyenne ou luxe, ça depend du chambre, la liste ci-dessous represente la chambre deja enregistrer et disponible dans l'hotel.  </p>
                   
                     <br />
                          <table class="table">
                            <thead>
                              <tr>
                              
                                <th>Chambre N°</th>
                                <th>Tel chambre</th>
                                <th>Description</th>
                                <th>Nombre de lit</th>
                                <th>Nombre de personne</th>
                                <th>Etage</th>
                                <th>categorie</th>
                                <th>image</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($chambre as $ch)
                              <tr>
                              
                                <td>{{ $ch->num_ch }}</td>
                                <td>{{ $ch->num_tel_ch }}</td>
                                <td>{{ $ch->description_ch }}</td>
                                <td>{{ $ch->nbr_lit_ch }}</td>
                                <td>{{ $ch->nbr_pers }}</td>
                                <td>{{ $ch->etage_ch }}</td>
                                <td>{{ $ch->description_cat }}</td>
                                <td>
                                  <ul class="list-inline">
                                    <li>
                                      <img src="{{asset('uploads/chambre/'.$ch->img_ch)}}" class="avatar" alt="Avatar">
                                    </li>
                                  
                                  </ul>
                                </td>
                                <td>
                                  @if(  $ch->status_ch == 'libre')
                                  <span style="    display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: middle;background-color: #1abb9c;border-radius: 10px;">{{ $ch->status_ch }}</span>
                                  @else  
                                  <span class="badge badge-success">{{ $ch->status_ch }}</span>
                                  @endif 
                                <td>
                                
                                  <a href="{{ route('chambre.edit',['id'=>$ch->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editer </a>
                                  <a href="{{ route('chambre.delete',['id'=>$ch->id]) }}" onclick="return confirm('Voulez vous supprimer ce chambre?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Effacer </a>
                                </td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                          <div class="pagination">
                              <ul> {{ $chambre->links() }}  </ul>
                          </div>
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
@endsection