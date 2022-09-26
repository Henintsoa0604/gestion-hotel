@extends('layouts.header')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Liste des clients</h3>
              </div>

              <div class="title_right">
               <form method="GET" action="{{route('client.search')}}" > 
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                    
                        
                        <span class="input-group-btn" style="width: 29%;">
                        <select  class="form-control"  name="select">  
                          <option value="id">ID</option>
                          <option value="name">Nom</option>
                          <option value="prenom_cli">Prenom</option>
                          <option value="adrs_cli">Adresse</option>
                          <option value="ville_cli">Ville</option>
                          <option value="code_postal_cli">Code postal</option>
                          <option value="pays_cli">Pays</option>
                          <option value="tel_cli">Tel</option>
                          <option value="email">Email</option>
                        </select>
                        </span>
                        <input type="text" class="form-control" name="motCle" >
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">OK</button>
                        </span>
                    </div>
                    
                </div>  
               </form>
              </div>
            </div>

            <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total clients</span>
              <div class="count">{{ count($total) }}</div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total reservations</span>
              <div class="count">{{ count($totalRes) }}</div>
            
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total consommations</span>
              <div class="count green">{{ count($totalCons) }}</div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total prestations</span>
              <div class="count green">{{ count($totalPres) }}</div>
             
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total chambre</span>
              <div class="count">{{ count($totalCh) }}</div>
              <span class="count_bottom"><i class="green">{{ count($totalChLibre) }} </i> disponible.</span>&nbsp&nbsp<span class="count_bottom"><i class="red">{{ count($totalCh) - count($totalChLibre) }} </i> Reservé</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total admins</span>
              <div class="count">{{ count($totalAd) }}</div>
             
            </div>
          </div> </div>
           <div class="col-md-12">
             <div class="x_panel">
              <div class="x_content">
                @if(Session::has('success'))
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Reussie!</strong> {{Session::get('success')}}
                        </div>
                    </div>
                @endif
                <div class="row">
            
                    @foreach($listes as $liste)
                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">
                            <h4 class="brief"><i>{{ $liste->id }}</i></h4>
                            <div class="left col-xs-7">
                                <h2>{{ $liste->name }} {{ $liste->prenom_cli }}</h2>
                                <p><strong>Adresse: </strong> {{ $liste->adrs_cli }} {{ $liste->ville_cli }} {{ $liste->pays_cli }}</p>
                                <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Email:{{ $liste->email }} </li>
                                <li><i class="fa fa-phone"></i> Tel: {{ $liste->tel_cli }} </li>
                                </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                                <img src="{{ asset('assets/images/user.png')}}" alt="" class="img-circle img-responsive">
                            </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                                
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                                <a href="{{ route('client.delete',[ 'id' =>$liste->id]) }}"  onclick="return confirm('Voulez vous supprimer?')" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash-o"></i> </a>
                               
                                <a href="{{ route('client.activite',[ 'id' =>$liste->id]) }}" class="btn btn-success btn-xs">
                                 Profile
                                </a>
                                
                               
                            </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <ul class="pagination pagination-split">
                          {{ $listes->links()}}
                        </ul>
                    </div>
                </div> 
              </div>
             </div>
           </div>
          </div>
        </div>
      
@endsection