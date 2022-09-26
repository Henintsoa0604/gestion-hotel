@extends('layouts.header_cli')

@section('content')

	<!-- Breadcrumbs -->
    <div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{ route('accueil') }}">Accueil<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="#">Membre d'hotel</a></li>
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
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Vous pouvez voir ci-dessous la liste des membres d'hotel <br> et consulter leur adreses ou les contacter.</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

		<!-- Start Shop Home List  -->
	<section class="shop-home-list section">
		<div class="container">
			<div class="row">
				
					
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Liste des membres d'hotel</h1>
							</div>
						</div>
				
					<!-- Start Single List  -->
					@foreach ($liste as $ch)
                    <div class="col-lg-4 col-md-6 col-12">
					    <div class="single-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-image overlay">
                                    <img src="{{asset('uploads/admin/'.$ch->image)}}"style="border: 1px solid #E6E9ED;padding: 2px;border-radius: 50%;height: 175px;width: 189px;" >
                                        <a  class="buy"><i class="fa fa-shopping-bag"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6col-12">
                                    <div class="">
                                     <span style="font-size: 13px;margin-bottom: 0;position: relative;color: #2c2d3f;font-weight: 700;margin-bottom: 10px;padding-bottom: 10px;"><i class="fa fa-tag"></i> {{ $ch->name}} {{ $ch->name}} </span><br>
                                     <span style="font-size: 13px;margin-bottom: 0;position: relative;color: #2c2d3f;font-weight: 700;margin-bottom: 10px;padding-bottom: 10px;"><i class="fa fa-building"></i> Adresse : </span> {{ $ch->adrs_resp}}<br>
                                     <span style="font-size: 13px;margin-bottom: 0;position: relative;color: #2c2d3f;font-weight: 700;margin-bottom: 10px;padding-bottom: 10px;"><i class="fa fa-phone"></i> Tel : </span> {{ $ch->tel_resp}}<br>
                                     <span style="font-size: 13px;margin-bottom: 0;position: relative;color: #2c2d3f;font-weight: 700;margin-bottom: 10px;padding-bottom: 10px;"><i class="fa fa-envelope"></i> Email : </span> {{ $ch->email}}<br>
                                     <p style="margin-top: 15px;font-weight: 500;background: #f7941d;display: inline-block;color: #fff;padding: 2px 18px;border-radius: 30px;font-size: 14px;font-weight: 500;">{{ $ch->job_title}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					@endforeach
                    
					<!-- End Single List  -->
			
				</div>
				
			</div>
		</div>
	</section>
	<!-- End Shop Home List  -->
@endsection