@extends('layouts.header')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            <h3>Ajouter des chambres</h3>
            </div>
            <div class="clearfix"></div>
            <div class="row">
               
              <div class="col-md-12"> 
              <div class="x_panel">
                  <div class="x_title">
                    <h2> Ajouter nouveau chambre </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-4 col-sm-8 col-xs-12">
                      <!-- start form for validation -->
                      <h3 class="green"><i class="fa fa-paint-brush"></i> Ajout Chambre </h3>
                      <br>
                      <p>Veuillez completer les formulaires ci-dessous.</p>
                      <form method="POST" action="{{ route('chambre.add.submit') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                        <label for="categorie_id">categorie :</label>
                          <select class="form-control" name="categorie_id">
                              @foreach($categorie as $cat)
                                  <option value="{{ $cat->id }}">{{ $cat->description_cat}}</option>
                              @endforeach  
                          </select>
                        <label for="num_ch">Numero du chambre  :</label>
                        <input type="number"  class="form-control{{ $errors->has('num_ch') ?  ' parsley-error' : '' }}" name="num_ch" value="{{ old('num_ch') }}"  required />
                          @if ($errors->has('num_ch'))
                              <span class="help-block">
                                  <strong style="color: #ff00007a;">{{ $errors->first('num_ch') }}</strong>
                              </span>
                          @endif
                        <label for="num_tel_ch">Tel chambre :</label>
                        <input type="text" class="form-control{{ $errors->has('num_tel_ch') ? ' parsley-error' : '' }}" name="num_tel_ch" value="{{ old('num_tel_ch') }}" id="num_tel_ch" onblur="prix()"/>
                          @if ($errors->has('num_tel_ch'))
                              <span class="help-block">
                              <strong style="color: #ff00007a;">{{ $errors->first('num_tel_ch') }}</strong>
                              </span>
                          @endif
                        <label for="description_ch">Description :</label>
                        <textarea  required="required" class="form-control{{ $errors->has('description_ch') ?  ' parsley-error' : '' }}" name="description_ch"  >{{ old('description_ch') }}</textarea>
                          @if ($errors->has('description_ch'))
                              <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('description_ch') }}</strong>
                              </span>
                          @endif
                        <label for="nbr_lit_ch">Nombre de lit :</label>
                        <input type="number" class="form-control{{ $errors->has('nbr_lit_ch') ? ' parsley-error' : '' }}" name="nbr_lit_ch" value="{{ old('nbr_lit_ch') }}"  required />
                          @if ($errors->has('nbr_lit_ch'))
                              <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('nbr_lit_ch') }}</strong>
                              </span>
                          @endif
                          <label for="nbr_pers">Nombre de personne  :</label>
                        <input type="number" class="form-control{{ $errors->has('nbr_pers') ? ' parsley-error' : '' }}" name="nbr_pers" value="{{ old('nbr_pers') }}"  required />
                          @if ($errors->has('nbr_pers'))
                              <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('nbr_pers') }}</strong>
                              </span>
                          @endif
                          <label for="etage_ch">Etage :</label>
                        <select class="form-control{{ $errors->has('etage_ch') ? ' parsley-error' : '' }}" name="etage_ch" value="{{ old('etage_ch') }}"  >
                          <option value="Premiere">Premiere</option>
                          <option value="Deuxieme">Deuxieme</option>
                          <option value="Troisieme">Troisieme</option>
                          <option value="Quatrieme">Quatrieme</option>
                          <option value="Cinquieme">Cinquieme</option>
                          <option  value="Plus">Plus</option>
                        </select>
                          @if ($errors->has('etage_ch'))
                              <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('etage_ch') }}</strong>
                              </span>
                          @endif
                          <label for="img_ch">image :</label>
                        <input type="file" class="form-control{{ $errors->has('img_ch') ? ' parsley-error' : '' }}" name="img_ch" value="{{ old('img_ch') }}"  />
                          @if ($errors->has('img_ch'))
                              <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('img_ch') }}</strong>
                              </span>
                          @endif
                            
                        
                            <br/>
                          
                              <button type="submit" class="btn  btn-info btn-sm">Enregistrer</button>
                          
                      
                      </form>
                      <!-- end form for validations -->
                    </div>
                    <script>  
                        function prix(){
                            var tel = document.getElementById("num_tel_ch").value;
                            if (isNaN(tel) == false) {
                                var isa = tel.length;
                                if (isa == 10) {
                                    var cs = tel.substring(0, 3);
                                    if (cs == "032" || cs == "033" || cs == "034" || cs == "039") {
                                      document.getElementById("num_tel_ch").value = tel.substring(0, 3) + " " + tel.substring(3, 5) + " " + tel.substring(5, 8) + " " + tel.substring(8, 10);
                                    } else {
                                      swal({
                                        title: "Erreur!",
                                        text: "Operateur inconnnue à Madagascar",
                                        icon: "error",
                                        button: "Ok",
                                      });
                                        return false;
                                    }
                                } else {
                                  swal({
                                      title: "Erreur!",
                                      text: "Tel invalide",
                                      icon: "error",
                                      button: "Ok",
                                    });
                                  return false;
                                }
                            } else {
                              swal({
                                  title: "Erreur!",
                                  text: "Tel doit etre en chiffre",
                                  icon: "error",
                                  button: "Ok",
                                });
                                return false;
                            }
                        }
                    </script>
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
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        
                        <p>Une chambre se divise en plusieur categorie. Une chambre peut etre de type simple, moyenne ou luxe, ça depend du chambre, la liste ci-dessous represente la chambre deja enregistrer et disponible dans l'hotel.  </p>
                   
                     <br />
                  
                     <table class="table">
                      <thead>
                        <tr>
                         
                          <th>Chambre N°</th>
                          <th>Tel chambre</th>
                         
                          <th>Nombre de lit</th>
                          <th>Nombre de personne</th>
                          <th>Etage</th>
                          <th>categorie</th>
                         
                          <th>Status</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($chambre as $ch)
                        <tr>
                        
                          <td>{{ $ch->num_ch }}</td>
                          <td>{{ $ch->num_tel_ch }}</td>
                         
                          <td>{{ $ch->nbr_lit_ch }}</td>
                          <td>{{ $ch->nbr_pers }}</td>
                          <td>{{ $ch->etage_ch }}</td>
                          <td>{{ $ch->description_cat }}</td>
                         
                          <td>
                            @if(  $ch->status_ch == 'libre')
                             <span style="    display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: middle;background-color: #1abb9c;border-radius: 10px;">{{ $ch->status_ch }}</span>
                            @else  
                             <span class="badge badge-success">{{ $ch->status_ch }}</span>
                            @endif 
                         
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                     <div class="pagination">
                        <ul> {{ $chambre->links() }}  </ul>
                     </div>
                 </div>
                  </div>
                </div>
              </div>  
            </div> 
        
        </div> 
    </div> 
</div>
@endsection