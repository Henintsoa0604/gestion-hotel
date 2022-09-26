@extends('layouts.header_cli')

@section('content')
<!-- Slider Area -->
    <section class="hero-slider">
		<!-- Single Slider -->
	
		<div class="single-slider">
		<!--<img src="{{asset('assets_cli/images/hotel.jpg')}}" style="height: auto;max-width: 100%;position: absolute;"> -->
			<div class="container">
		
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
				
						<div class="text-inner">
							<div class="row">
							
								<div class="col-lg-7 col-12">
									<div class="hero-text">
										<h1><span>Reservation hotelerie</span>Bienvenue sur notre site</h1>
										<p>Consulter des chambres a l'aide du site.<br> faire du reservation en ligne <br> sans difficulté.</p>
										<div class="button">
											<a href="{{ route('liste_chambre')}}" class="btn">Reservation!</a>
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->
    <!-- Start Small Banner  -->
	<br><br><br>
	<section class="small-banner section">
		<div class="container-fluid">
			<div class="row">
				<!-- Single Banner  -->
                @foreach ($collection as $ch)
				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner">
						<img src="{{asset('uploads/chambre/'.$ch->img_ch)}}" alt="#" style="height: 370px;">
						<div class="content">
							<p>{{ $ch->description_cat }} pour {{ $ch->nbr_pers }} personne </p>
							<h3>une collection de <br> chambre</h3>
							<a href="{{ route('liste_chambre')}}">Consulter chambre</a>
						</div>
					</div>
				</div>
                @endforeach
				<!-- /End Single Banner  -->
			
			</div>
		</div>
	</section>
	<!-- End Small Banner -->
    <!-- Start Product Area -->
    <div class="product-area section">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Categorie des chambres</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="product-info">
							<div class="nav-main">
								<!-- Tab Nav -->
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#simple" role="tab">Chambre simple</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#double" role="tab">Chambre moyenne</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#luxe" role="tab">Chambre luxe</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#uneLit" role="tab">Une lit</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#deuxLit" role="tab">Deux lit</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#famille" role="tab">Famille</a></li>
								</ul>
								<!--/ End Tab Nav -->
							</div>
							<div class="tab-content" id="myTabContent">
								<!-- Start Single Tab -->
								<div class="tab-pane fade show active" id="simple" role="tabpanel">
									<div class="tab-single">
										<div class="row">
                                         @foreach ($simple as $sp)
											<div class="col-xl-3 col-lg-4 col-md-4 col-12">
												<div class="single-product">
													<div class="product-img">
														<a href="{{ route('chambre.detail',['id'=>$sp->id])}}">
															<img class="default-img" src="{{asset('uploads/chambre/'.$sp->img_ch)}}" alt="#" style="height: 200px;">
													
                                                            @if(  $sp->status_ch == 'libre'  )
                                                            <span class="new">{{ $sp->status_ch }}</span>
                                                            @else 
                                                            <span class="out-of-stock">{{ $sp->status_ch }}</span>
                                                            @endif
														</a>
														<div class="button-head">
															<div class="product-action">
															@if (Auth::check())
																<a href="{{ route('chambre.favorie',['id'=>$sp->id])}}" title="Ajout au favorie"><i class=" ti-heart "></i><span></span></a>
															@endif	
															</div>
															
														</div>
														
													</div>
													<?php
														$number =  $sp->prix_cat ;
														$n=  str_replace(',',' ', number_format($number,3));
														$a = strstr($n, '.');
														$prix= str_replace($a,'',$n);
														
													?>
													<div class="product-content">
														<h3><a href="{{ route('chambre.detail',['id'=>$sp->id])}}">{{ $sp->description_ch }} pour {{ $sp->nbr_pers }} personnes</a></h3>
														<div class="product-price">
															<h3>{{ $prix }} Ar</h3>
														</div>
													</div><br>
													@if(  $sp->status_ch == 'libre'  )
													<div class="product-action-2">
														<a  class="btn" style="color:white"  title="Reserve ce chambre" href="{{ route('reservation',['id'=>$sp->id]) }}"> Reservation </a>
													</div>
													@else 
													<div class="product-action-2">
														<span style="color: brown;">Ce chambre est deja reservé</span>
													</div>
													@endif
												</div>
											</div>
                                         @endforeach
											
										</div>
									</div>
								</div>
								<!--/ End Single Tab -->
								<!-- Start Single Tab -->
								<div class="tab-pane fade" id="double" role="tabpanel">
									<div class="tab-single">
										<div class="row">
                                        @foreach ($double as $db)
											<div class="col-xl-3 col-lg-4 col-md-4 col-12">
												<div class="single-product">
													<div class="product-img">
												     	<a href="{{ route('chambre.detail',['id'=>$db->id])}}">
														   <img class="default-img" src="{{asset('uploads/chambre/'.$db->img_ch)}}" alt="#" style="height: 200px;">
															
                                                            @if(  $db->status_ch == 'libre'  )
                                                            <span class="new">{{ $db->status_ch }}</span>
                                                            @else 
                                                            <span class="out-of-stock">{{ $db->status_ch }}</span>
                                                            @endif
														</a>
														<div class="button-head">
															<div class="product-action">
															@if (Auth::check())
																<a href="{{ route('chambre.favorie',['id'=>$db->id])}}" title="Ajout au favorie"><i class=" ti-heart "></i><span></span></a>
															@endif
															</div>
															
														</div>
													</div>
													<?php
														$number =  $db->prix_cat ;
														$n=  str_replace(',',' ', number_format($number,3));
														$a = strstr($n, '.');
														$prix= str_replace($a,'',$n);
														
													?>
													<div class="product-content">
														<h3><a href="{{ route('chambre.detail',['id'=>$db->id])}}">{{ $db->description_ch }} pour {{ $db->nbr_pers }} personnes</a></h3>
														<div class="product-price">
															<h3>{{ $prix }} Ar</h3>
														</div>
													</div><br>
													@if(  $db->status_ch == 'libre'  )
											
													<div class="content">
														<a class="btn" style="color:white" title="Reserve ce chambre" href="{{ route('reservation',['id'=>$db->id]) }}">Reservation</a>
													</div>
													@else 
													<div class="product-action-2">
														<span style="color: brown;">Ce chambre est deja reservé</span>
													</div>
													@endif
												</div>
											</div>
									    @endforeach
										</div>
									</div>
								</div>
								<!--/ End Single Tab -->
								<!-- Start Single Tab -->
								<div class="tab-pane fade" id="luxe" role="tabpanel">
									<div class="tab-single">
										<div class="row">
										@foreach ($luxe as $lx)
											<div class="col-xl-3 col-lg-4 col-md-4 col-12">
												<div class="single-product">
													<div class="product-img">
													    <a href="{{ route('chambre.detail',['id'=>$lx->id])}}">
													     	<img class="default-img" src="{{asset('uploads/chambre/'.$lx->img_ch)}}" alt="#" style="height: 200px;">
														
                                                            @if(  $lx->status_ch == 'libre'  )
                                                            <span class="new">{{ $lx->status_ch }}</span>
                                                            @else 
                                                            <span class="out-of-stock">{{ $lx->status_ch }}</span>
                                                            @endif
														</a>
														<div class="button-head">
															<div class="product-action">
															@if (Auth::check())
																<a href="{{ route('chambre.favorie',['id'=>$lx->id])}}" title="Ajout au favorie" ><i class=" ti-heart "></i><span></span></a>
															@endif
															</div>
														
														</div>
													</div>
													<?php
														$number =  $lx->prix_cat ;
														$n=  str_replace(',',' ', number_format($number,3));
														$a = strstr($n, '.');
														$prix= str_replace($a,'',$n);
														
													?>
													<div class="product-content">
												    	<h3><a href="{{ route('chambre.detail',['id'=>$db->id])}}">{{ $lx->description_ch }} pour {{ $lx->nbr_pers }} personnes</a></h3>
														<div class="product-price">
															<h3>{{ $prix }}Ar</h3>
														</div>
													</div><br>
													@if(  $lx->status_ch == 'libre'  )
													<div class="product-action-2">
														<a class="btn" style="color:white"  title="Reserve ce chambre" href="{{ route('reservation',['id'=>$lx->id]) }}">Reservation</a>
													</div>
													@else 
													<div class="product-action-2">
														<span style="color: brown;">Ce chambre est deja reservé</span>
													</div>
													@endif
												</div>
											</div>
										@endforeach	
										</div>
									</div>
								</div>
								<!--/ End Single Tab -->
								<!-- Start Single Tab -->
								<div class="tab-pane fade" id="uneLit" role="tabpanel">
									<div class="tab-single">
										<div class="row">
										@foreach ($uneLit as $lx)
											<div class="col-xl-3 col-lg-4 col-md-4 col-12">
												<div class="single-product">
													<div class="product-img">
												      	<a href="{{ route('chambre.detail',['id'=>$lx->id])}}">
													     	<img class="default-img" src="{{asset('uploads/chambre/'.$lx->img_ch)}}" alt="#" style="height: 200px;">
														
                                                            @if(  $lx->status_ch == 'libre'  )
                                                            <span class="new">{{ $lx->status_ch }}</span>
                                                            @else 
                                                            <span class="out-of-stock">{{ $lx->status_ch }}</span>
                                                            @endif
														</a>
														<div class="button-head">
															<div class="product-action">
															@if (Auth::check())
																<a href="{{ route('chambre.favorie',['id'=>$lx->id])}}" title="Ajout au favorie"><i class=" ti-heart "></i><span></span></a>
															@endif
															</div>
															
														</div>
													</div>
													<?php
														$number =  $lx->prix_cat ;
														$n=  str_replace(',',' ', number_format($number,3));
														$a = strstr($n, '.');
														$prix= str_replace($a,'',$n);
														
													?>
													<div class="product-content">
												    	<h3><a href="{{ route('chambre.detail',['id'=>$db->id])}}">{{ $lx->description_ch }} pour {{ $lx->nbr_pers }} personnes</a></h3>
														<div class="product-price">
															<h3>{{ $prix }}Ar</h3>
														</div>
													</div><br>
													@if(  $lx->status_ch == 'libre'  )
													<div class="product-action-2">
														<a class="btn" style="color:white"  title="Reserve ce chambre" href="{{ route('reservation',['id'=>$lx->id]) }}">Reservation</a>
													</div>
													@else 
													<div class="product-action-2">
														<span style="color: brown;">Ce chambre est deja reservé</span>
													</div>
													@endif
												</div>
											</div>
										@endforeach	
										</div>
									</div>
								</div>
								<!--/ End Single Tab -->
								<!-- Start Single Tab -->
								<div class="tab-pane fade" id="deuxLit" role="tabpanel">
									<div class="tab-single">
										<div class="row">
										@foreach ($deuxLit as $lx)
											<div class="col-xl-3 col-lg-4 col-md-4 col-12">
												<div class="single-product">
													<div class="product-img">
													    <a href="{{ route('chambre.detail',['id'=>$lx->id])}}">
													     	<img class="default-img" src="{{asset('uploads/chambre/'.$lx->img_ch)}}" alt="#" style="height: 200px;">
														
                                                            @if(  $lx->status_ch == 'libre'  )
                                                            <span class="new">{{ $lx->status_ch }}</span>
                                                            @else 
                                                            <span class="out-of-stock">{{ $lx->status_ch }}</span>
                                                            @endif
														</a>
														<div class="button-head">
															<div class="product-action">
															@if (Auth::check())
																<a href="{{ route('chambre.favorie',['id'=>$lx->id])}}" title="Ajout au favorie"><i class=" ti-heart "></i><span></span></a>
															@endif
															</div>
														
														</div>
													</div>
													<?php
														$number =  $lx->prix_cat ;
														$n=  str_replace(',',' ', number_format($number,3));
														$a = strstr($n, '.');
														$prix= str_replace($a,'',$n);
														
													?>
													<div class="product-content">
												    	<h3><a href="{{ route('chambre.detail',['id'=>$db->id])}}">{{ $lx->description_ch }} pour {{ $lx->nbr_pers }} personnes</a></h3>
														<div class="product-price">
															<h3>{{ $prix }}Ar</h3>
														</div>
													</div><br>
													@if(  $lx->status_ch == 'libre'  )
													<div class="product-action-2">
														<a class="btn" style="color:white"  title="Reserve ce chambre" href="{{ route('reservation',['id'=>$lx->id]) }}">Reservation</a>
													</div>
													@else 
													<div class="product-action-2">
														<span style="color: brown;">Ce chambre est deja reservé</span>
													</div>
													@endif
												</div>
											</div>
										@endforeach	
										</div>
									</div>
								</div>
								<!--/ End Single Tab -->
								<!-- Start Single Tab -->
								<div class="tab-pane fade" id="famille" role="tabpanel">
									<div class="tab-single">
										<div class="row">
										@foreach ($famille as $lx)
										<div class="col-xl-3 col-lg-4 col-md-4 col-12">
												<div class="single-product">
													<div class="product-img">
													    <a href="{{ route('chambre.detail',['id'=>$lx->id])}}">
													     	<img class="default-img" src="{{asset('uploads/chambre/'.$lx->img_ch)}}" alt="#" style="height: 200px;">
														
                                                            @if(  $lx->status_ch == 'libre'  )
                                                            <span class="new">{{ $lx->status_ch }}</span>
                                                            @else 
                                                            <span class="out-of-stock">{{ $lx->status_ch }}</span>
                                                            @endif
														</a>
														<div class="button-head">
															<div class="product-action">
															@if (Auth::check())
																<a href="{{ route('chambre.favorie',['id'=>$lx->id])}}" title="Ajout au favorie"><i class=" ti-heart "></i><span></span></a>
															@endif
															</div>
														
														</div>
													</div>
													<?php
														$number =  $lx->prix_cat ;
														$n=  str_replace(',',' ', number_format($number,3));
														$a = strstr($n, '.');
														$prix= str_replace($a,'',$n);
														
													?>
													<div class="product-content">
												    	<h3><a href="{{ route('chambre.detail',['id'=>$db->id])}}">{{ $lx->description_ch }} pour {{ $lx->nbr_pers }} personnes</a></h3>
														<div class="product-price">
															<h3>{{ $prix }}Ar</h3>
														</div>
													</div><br>
													@if(  $lx->status_ch == 'libre'  )
													<div class="product-action-2">
														<a class="btn" style="color:white"  title="Reserve ce chambre" href="{{ route('reservation',['id'=>$lx->id]) }}">Reservation</a>
													</div>
													@else 
													<div class="product-action-2">
														<span style="color: brown;">Ce chambre est deja reservé</span>
													</div>
													@endif
												</div>
											</div>
										@endforeach	
										</div>
									</div>
								</div>
								<!--/ End Single Tab -->
							</div>
						</div>
					</div>
				</div>
            </div>
    </div>
	<!-- End Product Area -->
    <!-- Start Midium Banner  -->
	<section class="midium-banner">
		<div class="container">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="{{ asset('assets_cli/images/2.jpg')}}" alt="#">
						<div class="content">
							<p>Une collection du chambre</p>
							<h3>Prix moin chere <br> reduction <span> 50%</span></h3>
							<a href="{{ route('liste_chambre')}}">Consulter maintenant</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="{{ asset('assets_cli/images/3.jpg')}}" alt="#">
						<div class="content">
					      	<p>Une collection du chambre</p>
							<h3>Prix moin chere <br> reduction <span> 50%</span></h3>
							<a href="{{ route('liste_chambre')}}">Consulter maintenant</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Midium Banner -->

    <!-- Start Most Popular -->
	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Les chambres</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
						<!-- Start Single Product -->
						@foreach ($liste_ch as $liste)
						<div class="single-product">
							<div class="product-img">
							    <a href="{{ route('chambre.detail',['id'=>$liste->id])}}">
								<img class="default-img" src="{{asset('uploads/chambre/'.$liste->img_ch)}}" alt="#" style="height:200px">
							
								@if(  $liste->status_ch == 'libre'  )
								<span class="new">{{ $liste->status_ch }}</span>
								@else 
								<span class="out-of-stock">{{ $liste->status_ch }}</span>
								@endif
								</a>
								<div class="button-head">
									<div class="product-action">
									@if (Auth::check())
										<a href="{{ route('chambre.favorie',['id'=>$liste->id])}}" title="Ajout au favorie"><i class=" ti-heart "></i></a>
									@endif
									</div>
									@if(  $liste->status_ch == 'libre'  )
									<div class="product-action-2">
										<a title="reserve ce chambre" href="{{ route('reservation',['id'=>$liste->id]) }}">Reservation</a>
									</div>
									@else 
									<div class="product-action-2">
										<a>Ce chambre est deja reservé</a>
									</div>
									@endif
								</div>
							</div>
							<?php
								$number =  $liste->prix_cat ;
								$n=  str_replace(',',' ', number_format($number,3));
								$a = strstr($n, '.');
								$prix= str_replace($a,'',$n);
								
							?>
							<div class="product-content">
								<h3><a href="{{ route('chambre.detail',['id'=>$liste->id])}}">{{ $liste->description_ch }} pour {{ $liste->nbr_pers }} personnes</a></h3>
								<div class="product-price">
									<span class="old">{{ $prix + 2000 }}Ar</span>
									<span >{{ $prix }}Ar</span>
								</div>
							</div>
						
						</div>
						@endforeach
						<!-- End Single Product -->
				
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->

	<section class="section free-version-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 offset-md-2 col-xs-12">
                    <div class="section-title mb-60">
                        <span class="text-white wow fadeInDown" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">Site de reservation en ligne</span>
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Vous pouvez faire du reservation <br> et consulter les chambres disponibles.</h2>
                        <p class="text-white wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">Veuillez appyuez sur le bouton ci-dessous,<br> pour consulter les chambres et faire du reservation.</p>

                        <div class="button">
                            <a href="{{ route('liste_chambre')}}"  class="btn wow fadeInUp" >RESERVATION</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

		<!-- Start Shop Home List  -->
	<section class="shop-home-list section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Top chambre Simple</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					@foreach ($s as $ch)
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
								<img src="{{asset('uploads/chambre/'.$ch->img_ch)}}" >
									<a  class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<?php
								$number =  $ch->prix_cat ;
								$n=  str_replace(',',' ', number_format($number,3));
								$a = strstr($n, '.');
								$prix= str_replace($a,'',$n);
								
							?>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h4 class="title"><a >{{ $ch->description_cat }}</a></h4>
									<p class="price with-discount">{{ $prix }}Ar</p>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<!-- End Single List  -->
			
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Top chambre moyenne</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					@foreach ($d as $ch)
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
								<img src="{{asset('uploads/chambre/'.$ch->img_ch)}}" alt="#">
									<a  class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<?php
								$number =  $ch->prix_cat ;
								$n=  str_replace(',',' ', number_format($number,3));
								$a = strstr($n, '.');
								$prix= str_replace($a,'',$n);
								
							?>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h4 class="title"><a>{{ $ch->description_cat }}</a></h4>
									<p class="price with-discount">{{ $prix}}Ar</p>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<!-- End Single List  -->
				
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Top chambre luxe</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					@foreach ($l as $ch)
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
							    	<img src="{{asset('uploads/chambre/'.$ch->img_ch)}}" alt="#">
									<a  class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<?php
								$number =  $ch->prix_cat ;
								$n=  str_replace(',',' ', number_format($number,3));
								$a = strstr($n, '.');
								$prix= str_replace($a,'',$n);
								
							?>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
								    <h4 class="title"><a >{{ $ch->description_cat }}</a></h4>
									<p class="price with-discount">{{ $prix}}Ar</p>
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
	<!-- End Shop Home List  -->
@endsection