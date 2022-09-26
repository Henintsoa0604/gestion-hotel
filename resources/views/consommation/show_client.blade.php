@extends('layouts.header')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            <h3>Consommatin du client</h3>
            </div>
            <div class="clearfix"></div>
            <div class="row">
               
              <div class="col-md-12"> 
              <div class="x_panel">
                  <div class="x_title">
                    <h2> Enregistrer consommation </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start form for validation -->
                    <form method="POST" action="{{ route('consommation.add.submit')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     
                      <label for="user_id">ID Reservation :</label>
                      <input type="text" readonly="readonly"  class="form-control{{ $errors->has('user_id') ?  ' parsley-error' : '' }}" name="reservation_id" value="{{ $client->id}}"  required />
                        @if ($errors->has('num_ch'))
                            <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('user_id') }}</strong>
                            </span>
                        @endif
                      <label for="nom client">ID Client :</label>
                      <input type="text" readonly="readonly" class="form-control" name="user_id"   value="{{ $client->user_id}}" />
                      
                     
                     
                        <label for="designation_cons">Designation consommation :</label>
                       <input  type="text" name="designation_cons" class="form-control{{ $errors->has('designation_cons') ?  ' parsley-error' : '' }}"  value="{{ old('designation_cons')}}"  >
                        @if ($errors->has('designation_cons'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('designation_cons') }}</strong>
                            </span>
                        @endif
                        <label for="quantite_cons">Quantité consommé :</label>
                       <input  type="text" name="quantite_cons" class="form-control{{ $errors->has('quantite_cons') ?  ' parsley-error' : '' }}"  value="{{ old('quantite_cons')}}"  >
                        @if ($errors->has('quantite_cons'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('quantite_cons') }}</strong>
                            </span>
                        @endif
                        <label for="prix_cons">Total prix  :</label>
                        <input  type="text" name="prix_cons" class="form-control{{ $errors->has('prix_cons') ?  ' parsley-error' : '' }}"  value="{{ old('prix_cons')}}"  >
                        @if ($errors->has('prix_cons'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('prix_cons') }}</strong>
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