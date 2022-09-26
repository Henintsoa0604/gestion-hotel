@extends('layouts.header')

@section('content')
<div class="right_col" role="main">
    <div class="">
          <div class="page-title">
            <div class="title_left">
            <h3>Modifier une chambre</h3>
            </div>
            <div class="clearfix"></div>
            <div class="row">
               
              <div class="col-md-12"> 
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Modifier les informations du chambre </h2>
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
                            <th>Chambre N°</th>
                            <th>Tel chambre</th>
                            <th>Description</th>
                            <th>Nombre de lit</th>
                            <th>Nombre de personne</th>
                            <th>Etage</th>
                            <th>categorie</th>
                            <th>image</th>
                            <th>Status</th>
                        
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($listes as $ch)
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
                               
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <div class="pagination">
                          <ul> {{ $listes->links() }}  </ul>
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-3 col-xs-12">

                      <section class="panel">

                        <div class="x_title">
                          <h2>Modifier ce chambre</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <!-- start form for validation -->
                              <form method="POST" action="{{ route('chambre.edit.submit',['id'=>$chambre->id] )}}"  enctype="multipart/form-data">
                              {{ csrf_field() }}
                                <label for="categorie_id">categorie :</label>
                                  <select class="form-control" name="categorie_id">
                                      @foreach($categorie as $cat)
                                          <option value="{{ $cat->id }}">{{ $cat->description_cat}}</option>
                                      @endforeach 
                                      @foreach($catModif as $catM) 
                                      <option value="{{ $catM->id }}">{{ $catM->description_cat}}</option>
                                      @endforeach 
                                  </select>
                                <label for="num_ch">Numero du chambre  :</label>
                                <input type="number"  class="form-control{{ $errors->has('num_ch') ?  ' parsley-error' : '' }}" name="num_ch" id="num_ch"  value="{{ $chambre->num_ch}}"  required />
                                  @if ($errors->has('num_ch'))
                                      <span class="help-block">
                                          <strong style="color: #ff00007a;">{{ $errors->first('num_ch') }}</strong>
                                      </span>
                                  @endif
                                <label for="num_tel_ch">Tel chambre :</label>
                                <input type="text" class="form-control{{ $errors->has('num_tel_ch') ? ' parsley-error' : '' }}" name="num_tel_ch" id="num_tel_ch" value="{{ $chambre->num_tel_ch}}" id="num_tel_ch" onblur="prix()"/>
                                  @if ($errors->has('num_tel_ch'))
                                      <span class="help-block">
                                      <strong style="color: #ff00007a;">{{ $errors->first('num_tel_ch') }}</strong>
                                      </span>
                                  @endif
                                  <label for="description_ch">Description chambre :</label>
                                  <textarea  required="required" class="form-control{{ $errors->has('description_ch') ?  ' parsley-error' : '' }}" name="description_ch"   >{{ $chambre->description_ch }}</textarea>
                                  @if ($errors->has('description_ch'))
                                      <span class="help-block">
                                        <strong style="color: #ff00007a;">{{ $errors->first('description_ch') }}</strong>
                                      </span>
                                  @endif
                                <label for="nbr_lit_ch">Nombre de lit :</label>
                                <input type="number" class="form-control{{ $errors->has('nbr_lit_ch') ? ' parsley-error' : '' }}" name="nbr_lit_ch"  id="nbr_lit_ch"  value="{{ $chambre->nbr_lit_ch}}"  required />
                                  @if ($errors->has('nbr_lit_ch'))
                                      <span class="help-block">
                                        <strong style="color: #ff00007a;">{{ $errors->first('nbr_lit_ch') }}</strong>
                                      </span>
                                  @endif
                                  <label for="nbr_pers">Nombre de personne :</label>
                                <input type="number" class="form-control{{ $errors->has('nbr_pers') ? ' parsley-error' : '' }}" name="nbr_pers"  id="nbr_pers"  value="{{ $chambre->nbr_pers}}"  required />
                                  @if ($errors->has('nbr_lit_ch'))
                                      <span class="help-block">
                                        <strong style="color: #ff00007a;">{{ $errors->first('nbr_pers') }}</strong>
                                      </span>
                                  @endif
                                <label for="etage_ch">Etage :</label>
                                  <select class="form-control" name="etage_ch">
                                     
                                          <option value="{{ $chambre->etage_ch }}">{{ $chambre->etage_ch }}</option>
                                     
                                      @foreach($listes as $l) 
                                      <option value="{{ $l->etage_ch }}">{{ $l->etage_ch }}</option>
                                      @endforeach 
                                  </select>
                                
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
                      </div>
                    </div>
                   
                  </div>
                </div>  
              </div>  
            </div> 
        
    </div> 
</div> 

@endsection