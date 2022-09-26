@extends('layouts.header')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            <h3>Modifier prestation</h3>
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
                    <h2> Modifier les informations sur la prestation </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start form for validation -->
                    <form method="POST" action="{{ route('prestation.edit.submit',['id'=>$pres->id] )}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     
                      <label for="user_id">ID Client  :</label>
                      <input type="text"  class="form-control{{ $errors->has('user_id') ?  ' parsley-error' : '' }}" name="user_id" value="{{ $pres->user_id}}" readOnly="readOnly"  required />
                        @if ($errors->has('user_id'))
                            <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('user_id') }}</strong>
                            </span>
                        @endif
                        <label for="user_id">ID Reservation  :</label>
                      <input type="text"  class="form-control{{ $errors->has('reservation_id') ?  ' parsley-error' : '' }}" name="reservation_id" value="{{ $pres->user_id}}" readOnly="readOnly"   required />
                        @if ($errors->has('reservation_id'))
                            <span class="help-block">
                                <strong style="color: #ff00007a;">{{ $errors->first('reservation_id') }}</strong>
                            </span>
                        @endif
                      <label for="designation_pres">Designation:</label>
                      <input type="text" class="form-control{{ $errors->has('designation_pres') ? ' parsley-error' : '' }}" name="designation_pres" value="{{ $pres->designation_pres}}" />
                        @if ($errors->has('designation_pres'))
                            <span class="help-block">
                            <strong style="color: #ff00007a;">{{ $errors->first('designation_pres') }}</strong>
                            </span>
                        @endif
                      
                      <label for="prix_pres">Prix :</label>
                      <input type="text" class="form-control{{ $errors->has('prix_pres') ? ' parsley-error' : '' }}" name="prix_pres" value="{{ $pres->prix_pres}}"  required />
                        @if ($errors->has('prix_pres'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('prix_pres') }}</strong>
                            </span>
                        @endif
                        
                        <label for="montant_pres">Montant :</label>
                      <input type="text" class="form-control{{ $errors->has('montant_pres') ? ' parsley-error' : '' }}" name="montant_pres" value="{{ $pres->montant_pres}}"  disabled />
                        @if ($errors->has('montant_pres'))
                            <span class="help-block">
                               <strong style="color: #ff00007a;">{{ $errors->first('montant_pres') }}</strong>
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