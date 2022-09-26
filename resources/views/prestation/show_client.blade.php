@extends('layouts.header')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            <h3>Prestation du client</h3>
            </div>
            <div class="clearfix"></div>
            <div class="row">
               
              <div class="col-md-12"> 
              <div class="x_panel">
                  <div class="x_title">
                    <h2> Enregistrer prestation </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start form for validation -->
                    <form method="POST" action="{{ route('prestation.add.submit')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     
                      <label for="user_id">ID Client :</label>
                      <input type="text" readonly="readonly"  class="form-control{{ $errors->has('user_id') ?  ' parsley-error' : '' }}" name="user_id" value="{{ $client->user_id}}"  required />
                        @if ($errors->has('user_id'))
                            <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('user_id') }}</strong>
                            </span>
                        @endif
                        <label for="reservation_id">ID Reservation :</label>
                      <input type="text" readonly="readonly"  class="form-control{{ $errors->has('reservation_id') ?  ' parsley-error' : '' }}" name="reservation_id" value="{{ $client->id}}"    required />
                        @if ($errors->has('reservation_id'))
                            <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('reservation_id') }}</strong>
                            </span>
                        @endif
                     
                        <label for="designation_pres">Designation prestation :</label>
                       <input  type="text" name="designation_pres" class="form-control{{ $errors->has('designation_pres') ?  ' parsley-error' : '' }}"  value="{{ old('designation_pres')}}"  >
                        @if ($errors->has('designation_pres'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('designation_pres') }}</strong>
                            </span>
                        @endif
                       
                        <label for="prix_pres"> Prix  :</label>
                        <input  type="text" name="prix_pres" class="form-control{{ $errors->has('prix_pres') ?  ' parsley-error' : '' }}"  value="{{ old('prix_pres')}}"  >
                        @if ($errors->has('prix_pres'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('prix_pres') }}</strong>
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