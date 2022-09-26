@extends('layouts.header')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            <h3>Modifier consommation</h3>
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
                    <h2> Modifier les informations sur la consommation </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start form for validation -->
                    <form method="POST" action="{{ route('consommation.edit.submit',['id'=>$cons->id] )}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     
                      <label for="user_id">ID Client :</label>
                      <input type="text"  class="form-control{{ $errors->has('user_id') ?  ' parsley-error' : '' }}" name="user_id" value="{{ $cons->user_id}}" readOnly="readOnly"  required />
                        @if ($errors->has('user_id'))
                            <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('user_id') }}</strong>
                            </span>
                        @endif
                        <label for="user_id">ID Reservation  :</label>
                      <input type="text"  class="form-control{{ $errors->has('reservation_id') ?  ' parsley-error' : '' }}" name="reservation_id" value="{{ $cons->reservation_id}}" readOnly="readOnly"   required />
                        @if ($errors->has('user_id'))
                            <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('user_id') }}</strong>
                            </span>
                        @endif
                      <label for="designation_cons">Designation:</label>
                      <input type="text" class="form-control{{ $errors->has('designation_cons') ? ' parsley-error' : '' }}" name="designation_cons" value="{{ $cons->designation_cons}}" />
                        @if ($errors->has('designation_cons'))
                            <span class="help-block">
                            <strong style="color: #ff00007a;">{{ $errors->first('designation_cons') }}</strong>
                            </span>
                        @endif
                      <label for="quantite_cons">Quatite :</label>
                      <input  type="text" class="form-control{{ $errors->has('quantite_cons') ?  ' parsley-error' : '' }}" name="quantite_cons" value="{{ $cons->quantite_cons}}"  >
                        @if ($errors->has('quantite_cons'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('quantite_cons') }}</strong>
                            </span>
                        @endif
                      <label for="prix_cons">Prix :</label>
                      <input type="text" class="form-control{{ $errors->has('prix_cons') ? ' parsley-error' : '' }}" name="prix_cons" value="{{ $cons->prix_cons}}"  required />
                        @if ($errors->has('prix_cons'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('prix_cons') }}</strong>
                            </span>
                        @endif
                        
                        <label for="montant_cons">Montant :</label>
                      <input type="text" class="form-control{{ $errors->has('montant_cons') ? ' parsley-error' : '' }}" name="montant_cons" value="{{ $cons->montant_cons}}"  disabled />
                        @if ($errors->has('montant_cons'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('montant_cons') }}</strong>
                            </span>
                        @endif
                           
                      
                          <br/>
                        
                            <button type="submit" class="btn  btn-info btn-sm">Modifier</button>
                         
                     
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