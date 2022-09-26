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
                @if(Session::has('success'))
                <div class="col-md-12">
                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Reussie!</strong> {{Session::get('success')}}
                  </div>
                </div>
                @endif
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

                    <!-- start form for validation -->
                    <form method="POST" action="{{ route('clientc.edit.submit',[ 'id' =>$client->id ])}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                      
                      <label for="name">Nom  :</label>
                      <input type="text"  class="form-control{{ $errors->has('name') ?  ' parsley-error' : '' }}" name="name" value="{{ $client->name }}"  required />
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                      <label for="prenom_cli">Prenom :</label>
                      <input type="text" class="form-control{{ $errors->has('prenom_cli') ? ' parsley-error' : '' }}" name="prenom_cli" value="{{  $client->prenom_cli }}" />
                        @if ($errors->has('prenom_cli'))
                            <span class="help-block">
                            <strong style="color: #ff00007a;">{{ $errors->first('prenom_cli') }}</strong>
                            </span>
                        @endif
                      <label for="adrs_cli">Adresse:</label>
                      <input type="text" class="form-control{{ $errors->has('adrs_cli') ? ' parsley-error' : '' }}" name="adrs_cli" value="{{  $client->adrs_cli }}" />
                        @if ($errors->has('adrs_cli'))
                            <span class="help-block">
                            <strong style="color: #ff00007a;">{{ $errors->first('adrs_cli') }}</strong>
                            </span>
                        @endif
                      <label for="ville_cli">Ville :</label>
                      <input type="text" class="form-control{{ $errors->has('ville_cli') ? ' parsley-error' : '' }}" name="ville_cli" value="{{ $client->ville_cli }}"  required />
                        @if ($errors->has('ville_cli'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('ville_cli') }}</strong>
                            </span>
                        @endif
                      
                        <label for="code_postal_cli">Code postal :</label>
                      <input type="text" class="form-control{{ $errors->has('code_postal_cli') ? ' parsley-error' : '' }}" name="code_postal_cli" value="{{ $client->code_postal_cli }}"  />
                        @if ($errors->has('code_postal_cli'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('code_postal_cli') }}</strong>
                            </span>
                        @endif
                        <label for="pays_cli">Pays :</label>
                      <input type="text" class="form-control{{ $errors->has('pays_cli') ? ' parsley-error' : '' }}" name="pays_cli" value="{{ $client->pays_cli }}"  />
                        @if ($errors->has('pays_cli'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('pays_cli') }}</strong>
                            </span>
                        @endif
                        <label for="tel_cli">Code postal :</label>
                      <input type="text" class="form-control{{ $errors->has('tel_cli') ? ' parsley-error' : '' }}" name="tel_cli" value="{{ $client->tel_cli }}"  />
                        @if ($errors->has('tel_cli'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('tel_cli') }}</strong>
                            </span>
                        @endif
                      
                          <br/>
                        
                            <button type="submit" class="btn  btn-info btn-sm">Enregistrer</button>
                        
                     
                    </form>
                    <!-- end form for validations -->

                  </div>
                </div>
              </div>  
            </div> 
        
        </div> 
    </div> 
</div>
@endsection