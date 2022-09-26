@extends('layouts.header')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Liste des reservations</h3>
              </div>

              <div class="title_right">
               <form method="GET" action="{{route('reservation.liste_search')}}" > 
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="motCle" placeholder="Rechercher par ID...">
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
             
              <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Liste des reservations </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <a  href="{{ route('reservation.liste') }}" class="btn btn-round btn-default">Toute les reservation</a>
                    <a  href="{{ route('reservation.liste_attente') }}" class="btn btn-round btn-default">En attente</a>
                    <a  href="{{ route('reservation.liste_accepte') }}" class="btn btn-round btn-default">Accepté</a>
                    <a  href="{{ route('reservation.liste_annule') }}" class="btn btn-round btn-default">Annulé</a>
                    <button type="button"  class="btn btn-round btn-default" data-toggle="modal" data-target=".bs-example-modal-sm">Date de reservation</button>
                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Recherche par date</h4>
                            </div>
                            <form method="GET" action="{{route('reservation.liste_search_date')}}" > 
                            <div class="modal-body">
                            <h4>Entrer la date de la reservation</h4>
                            <input type="date" name="motCle" class="form-control" />

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Ok</button>
                            </div>
                            </form> 
                        </div>
                        </div>
                    </div>
                    <button type="button"  class="btn btn-round btn-default" data-toggle="modal" data-target=".debut">Debut</button>
                    <div class="modal fade debut" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Date debut</h4>
                            </div>
                            <form method="GET" action="{{route('reservation.liste_search_debut')}}" > 
                            <div class="modal-body">
                            <h4>Entrer la date debut de la reservation</h4>
                            <input type="date" name="motCle" class="form-control" />

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Ok</button>
                            </div>
                            </form> 
                        </div>
                        </div>
                    </div>
                    <button type="button"  class="btn btn-round btn-default" data-toggle="modal" data-target=".fin">Fin</button>
                    <div class="modal fade fin" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Date fin</h4>
                            </div>
                            <form method="GET" action="{{route('reservation.liste_search_fin')}}" > 
                            <div class="modal-body">
                            <h4>Entrer la date fin de la reservation</h4>
                            <input type="date" name="motCle" class="form-control" />

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Ok</button>
                            </div>
                            </form> 
                        </div>
                        </div>
                    </div>
                    <button type="button"  class="btn btn-round btn-default" data-toggle="modal" data-target=".cli">Par client</button>
                    <div class="modal fade cli" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Par client</h4>
                            </div>
                            <form method="GET" action="{{route('reservation.liste_search_cli')}}" > 
                            <div class="modal-body">
                            <h4>Entrer ID client</h4>
                            <input type="number" name="motCle" class="form-control" />

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Ok</button>
                            </div>
                            </form> 
                        </div>
                        </div>
                    </div>
                    @if(Session::has('success'))
                      <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <strong>Reussie!</strong> {{Session::get('success')}}
                        </div>
                      </div>
                    @endif
                @if( count($resListe) > 0 )
                    <div class="table-responsive">
                      <table  class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                          
                          <th class="column-title">N°:</th>
                          <th class="column-title">Ch n°</th>
                         
                          <th class="column-title">Nom</th>
                          <th class="column-title">Lit</th>
                          <th class="column-title">Personne</th>
                          <th class="column-title">Etage</th>
                          <th class="column-title">Debut</th> 
                          <th class="column-title">Fin</th> 
                          <th class="column-title">Jour</th> 
                          <th class="column-title">Montant</th> 
                          <th class="column-title">Status</th> 
                          <th class="column-title">Description</th>
                          <th class="column-title">Information</th>
                          
                          <th class="column-title no-link last"><span class="nobr">Action</span>
                          <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                            $date = Carbon\Carbon::now();
                          
                            
                          ?>
                        @foreach ($resListe as $liste)
                        <?php
                          $number = $liste->montant;
                          $n=  str_replace(',',' ', number_format($number,3));
                          $a = strstr($n, '.');
                          $prix= str_replace($a,'',$n);
                          
                          ?>
                          <tr>
                          
                            
                            <td class=" ">{{$liste->id }}</td>
                            <td class=" ">{{$liste->num_ch }}</td>
                          
                            <td class=" ">{{$liste->name }} {{$liste->prenom_cli }}</td>
                            <td class=" ">{{$liste->nbr_lit_ch}}</td>
                            <td class=" ">{{$liste->nbr_pers}}</td>
                            <td class=" ">{{$liste->etage_ch}} </td>
                            <td class=" ">{{ date('j F Y',strtotime($liste->date_debut)) }} </td>
                            <td class=" ">{{ date('j F Y',strtotime($liste->date_fin)) }}</td>
                            <td class=" ">{{$liste->nbr_jour}} </td>
                            <td class=" ">{{$prix}}Ar </td>
                            <td class=" ">
                               
                                @if(  $liste->status == 'Accepté')
                                <span style="display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: middle;background-color: #1abb9c;border-radius: 10px;">{{ $liste->status }}</span>
                                @elseif( $liste->status == 'En attente')  
                                <span class="badge badge-success">{{ $liste->status }}</span>
                                @else 
                                <span style="display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: middle;background-color: red;border-radius: 10px;">{{ $liste->status }}</span>
                                @endif 
                            </td> 
                            
                            <td class=" "> 
                            @if($liste->desc != 'Reservation en attente')
                            
                              {{ $liste->desc }}
                            @else 
                              {{ $liste->desc }}
                            @endif
                            </td> 
                            <td>
                            @if($liste->date_fin < $date)
                              <span style="font-size: 14px;color:red" title="Reservation expiré"><i class="fa fa-close"></i></span>
                            @else 
                              <span style="font-size: 14px;color:green" title="reservation en cours"><i class="fa fa-check"></i></span>
                            @endif  
                          </td>
                            <td class=" last">
                            @if(  $liste->status == 'En attente' ) 
                              
                            <a href="{{route('reservation.edit',['id' => $liste->id])}}"  class="btn btn-info btn-xs" ><i class="fa fa-pencil"></i> </a>
                            <a href="{{route('reservation.print',['id' => $liste->id])}}"  class="btn btn-default btn-xs" ><i class="fa fa-print"></i> </a>
                            @else 
                                <a href="{{route('reservation.edit',['id' => $liste->id])}}"  class="btn btn-info btn-xs" ><i class="fa fa-pencil"></i> </a>
                                <a href="{{ route('reservation.delete',['id'=>$liste->id]) }}" onclick="return confirm('Voulez vous supprimer ce reservation?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>  </a>
                                <a href="{{route('reservation.print',['id' => $liste->id])}}"  class="btn btn-default btn-xs" ><i class="fa fa-print"></i> </a>
                            @endif 
                              </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                      <span style="font-size: 14px;color:red" title="Reservation expiré"><i class="fa fa-close">     :Reservation expiré</i></span>&nbsp&nbsp&nbsp&nbsp&nbsp<span style="font-size: 14px;color:green" title="Reservation en cours"><i class="fa fa-check">     :Reservation encours</i></span>
                       <hr><br>
                       
                          <h2 style="color:green"><i class="fa fa-check-square"></i>  Les reservations dont la date d'arrivé  aujourd'huit se trouve dans la liste ci-dessous</h2>
                        
                          <div class="table-responsive">
                      <table  class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                          
                          <th class="column-title">N°:</th>
                          <th class="column-title">Ch n°</th>
                         
                          <th class="column-title">Nom</th>
                          <th class="column-title">Lit</th>
                          <th class="column-title">Personne</th>
                          <th class="column-title">Etage</th>
                          <th class="column-title">Debut</th> 
                          <th class="column-title">Fin</th> 
                          <th class="column-title">Jour</th> 
                          <th class="column-title">Montant</th> 
                          <th class="column-title">Status</th> 
                          <th class="column-title">Description</th>
                          <th class="column-title">Information</th>
                          
                         
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                            $date = Carbon\Carbon::now();
                          
                            
                          ?>
                        @foreach ($now as $liste)
                        <?php
                          $number = $liste->montant;
                          $n=  str_replace(',',' ', number_format($number,3));
                          $a = strstr($n, '.');
                          $prix= str_replace($a,'',$n);
                          
                          ?>
                          <tr>
                          
                            
                            <td class=" ">{{$liste->id }}</td>
                            <td class=" ">{{$liste->num_ch }}</td>
                          
                            <td class=" ">{{$liste->name }} {{$liste->prenom_cli }}</td>
                            <td class=" ">{{$liste->nbr_lit_ch}}</td>
                            <td class=" ">{{$liste->nbr_pers}}</td>
                            <td class=" ">{{$liste->etage_ch}} </td>
                            <td class=" ">{{ date('j F Y',strtotime($liste->date_debut)) }} </td>
                            <td class=" ">{{ date('j F Y',strtotime($liste->date_fin)) }}</td>
                            <td class=" ">{{$liste->nbr_jour}} </td>
                            <td class=" ">{{$prix}}Ar </td>
                            <td class=" ">
                               
                                @if(  $liste->status == 'Accepté')
                                <span style="display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: middle;background-color: #1abb9c;border-radius: 10px;">{{ $liste->status }}</span>
                                @elseif( $liste->status == 'En attente')  
                                <span class="badge badge-success">{{ $liste->status }}</span>
                                @else 
                                <span style="display: inline-block;min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: middle;background-color: red;border-radius: 10px;">{{ $liste->status }}</span>
                                @endif 
                            </td> 
                            
                            <td class=" "> 
                            @if($liste->desc != 'Veuillez attender la validation de votre reservation!')
                            
                              {{ $liste->desc }}
                            @else 
                              {{ $liste->desc }}
                            @endif
                            </td> 
                            <td>
                            @if($liste->date_fin < $date)
                              <span style="font-size: 14px;color:red" title="Reservation expiré"><i class="fa fa-close"></i></span>
                            @else 
                              <span style="font-size: 14px;color:green" title="reservation en cours"><i class="fa fa-check"></i></span>
                            @endif  
                          </td>
                           
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                      
                        
                        
                       
                    </div>
                       
                    </div>  
                @else
                    <center><h3 style="color: red"> Aucun reservation !! </h3> </center>
                @endif
                  </div>
                </div>
              </div> 
            </div> 
          </div>
        </div>
@endsection