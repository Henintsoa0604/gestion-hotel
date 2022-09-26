@extends('layouts.header_cli')

@section('content')

	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="#">Accuel<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="#l">Contacte</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<section class="section free-version-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 offset-md-2 col-xs-12">
                    <div class="section-title mb-60">
                       
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Vous pouvez nous contatcte a tout moment ou vous voulez </h2>
                        <div class="button">
                            <a href="{{ route('liste_chambre')}}"  class="btn wow fadeInUp"  >Reservation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>		
	<!-- Shopping Cart -->
	<section class="shop-home-list section">
		<div class="container">
			<div class="row">
				
					
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Vous pouvez voir le contacte ci-dessous</h1>
							</div>
						</div>
				
					<!-- Start Single List  -->
					
                    <div class="col-lg-4 col-md-6 col-12">
					    <div class="single-list">
                            <div class="row">
                                
                                <div class="col-lg-6 col-md-6col-12">
                                    <div class="">
                                     <span style="font-size: 13px;margin-bottom: 0;position: relative;color: #2c2d3f;font-weight: 700;margin-bottom: 10px;padding-bottom: 10px;"><h1 style="font-size: 23px;"><i class="fa fa-map">Adresse</i></h1><br> ID40Bis,Isaha,Fianarantsoa. </span><br>
                                     <span style="font-size: 13px;margin-bottom: 0;position: relative;color: #2c2d3f;font-weight: 700;margin-bottom: 10px;padding-bottom: 10px;"><i class="fa fa-tag"></i>  </span>Madagascar<br>
                                     <span style="font-size: 13px;margin-bottom: 0;position: relative;color: #2c2d3f;font-weight: 700;margin-bottom: 10px;padding-bottom: 10px;"><i class="fa fa-phone"></i> Tel : </span>+261 32 26 135 13/+261 34 88 852 19<br>
                                     <span style="font-size: 13px;margin-bottom: 0;position: relative;color: #2c2d3f;font-weight: 700;margin-bottom: 10px;padding-bottom: 10px;"><i class="fa fa-envelope"></i> Email : </span> miraygeek5@gmail.com<br>
                                     <p style="margin-top: 15px;font-weight: 500;background: #f7941d;display: inline-block;color: #fff;padding: 2px 18px;border-radius: 30px;font-size: 14px;font-weight: 500;">Contactez nous</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-7 col-md-7 col-12">
					    <div class="single-list">
                            <div class="row">
                                
                                <div class="col-lg-6 col-md-6col-12">
                                    <div class="">
									<form  method="POST" action="{{ route('contacte.submit') }}">
									{{ csrf_field() }}
                                     <span style="font-size: 13px;margin-bottom: 0;position: relative;color: #2c2d3f;font-weight: 700;margin-bottom: 10px;padding-bottom: 10px;"><h1 style="font-size: 23px;"><i class="fa fa-info">&nbsp Contacter nous</i></h1> </span><br>
									 <input type="text" style="width: 100%;height: 45px;line-height: 50px;padding: 0 20px;border-radius: 3px;border-radius: 0px;color: #333 !important;border: 1px solid beige;background: #FFF;" name="nom" class="form-control" placeholder="Nom" ><br>
									@if ($errors->has('nom'))
										<span class="help-block">
											<strong style="color: #ff00007a;">{{ $errors->first('nom') }}</strong>
										</span><br>
									@endif
									 <input type="text" style="width: 100%;height: 45px;line-height: 50px;padding: 0 20px;border-radius: 3px;border-radius: 0px;color: #333 !important;border: 1px solid beige;background: #FFF;" name="email" class="form-control" placeholder="Email" ><br>
									@if ($errors->has('email'))
										<span class="help-block">
											<strong style="color: #ff00007a;">{{ $errors->first('email') }}</strong>
										</span><br>
									@endif 
									 <textarea style="max-width: 100%;max-height: 80px;padding: 10px 10px 0 0;resize: none;border: none;border: 1px solid #E3E3E3;border-radius: 4px;line-height: 2;" name="message" > </textarea>
								     <br>
									 @if ($errors->has('message'))
										<span class="help-block">
											<strong style="color: #ff00007a;">{{ $errors->first('message') }}</strong>
										</span><br>
									@endif
									 <input type="submit" class="btn" style="border-width: 1px;border-radius: 30px;padding-right: 23px;padding-left: 23px;" value="Envoyer">
									<form>
								    </div>
                                </div>
                            </div>
                        </div>
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
					<!-- End Single List  -->
			
				</div>
				
			</div>
		</div>
	</section>
   <br>
	<!--/ End Shopping Cart -->
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
	
@endsection    