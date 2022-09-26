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
								<li class="active"><a href="#">Chambres</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
			
		<!-- Start Blog Single -->
		<section class="blog-single section">
			<div class="container">
				<div class="row">
				<div class="col-md-12">
						<div class="main-sidebar">
							<!-- Single Widget -->
							<form method="GET" action="{{route('liste_chambre_search')}}" > 
						
								<div class="row">
									<div class="col-lg-3 col-md-3 col-12">
										<div class="content">
									     <input type="number" style="width: 100%;height: 45px;line-height: 50px;padding: 0 20px;border-radius: 3px;border-radius: 0px;color: #333 !important;border: none;background: #F6F7FB;" name="nbr_lit" class="form-control" placeholder="Nombre de lit" required>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-12">
										<div class="content">
									  	<input type="number" style="width: 100%;height: 45px;line-height: 50px;padding: 0 20px;border-radius: 3px;border-radius: 0px;color: #333 !important;border: none;background: #F6F7FB;" name="nbr_pers" class="form-control" placeholder="Nombre de personnes" required>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-12">
										<div class="content">
										<input type="text" style="width: 100%;height: 45px;line-height: 50px;padding: 0 20px;border-radius: 3px;border-radius: 0px;color: #333 !important;border: none;background: #F6F7FB;" name="etage" class="form-control" placeholder="Etage Ex:Premiere ,Deuxieme,Troisieme, Plus" required>
										</div>
									</div>
									<div class="col-lg-2 col-md-3 col-12">
										<div class="content">
									     <input type="submit" value="Valider" class="btn">
										</div>
									</div>
								
							
									
								</div> 
							</form>
						</div>
					</div>
					<div class="col-md-3">
						<div class="main-sidebar">
						
							<!-- Single Widget -->
							<div class="single-widget category">
								<h3 class="title">Chambres( @foreach($countTotal as $count) {{ $count->count }} @endforeach )</h3>
								<ul class="categor-list">
									<li><a href="#">Libre (@foreach($countLibre as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">Reservé (@foreach($countReserve as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">Simple (@foreach($countSimple as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">Moyenne (@foreach($countMoyenne as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">Luxe (@foreach($countLuxe as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">Une personne (@foreach($countUneLit as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">Deux personnes (@foreach($countDeuxLit as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">Famille (@foreach($countFamille as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">1er Etage (@foreach($countPetage as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">2eme Etage (@foreach($countDetage as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">3eme Etage (@foreach($countTetage as $count) {{ $count->count }} @endforeach)</a></li>
									<li><a href="#">Plus (@foreach($countPlus as $count) {{ $count->count }} @endforeach)</a></li>
								
								</ul>
							</div>
							<div class="single-widget category">
								<h3 class="title">Prix</h3>
								<ul class="categor-list">
									<li><a href="#">Minimum(  {{ $minprix }}Ar )</a></li>
									<li><a href="#">Maximum(  {{ $maxprix }}Ar  )</a></li>
									
									<li>Prix entre...</li>
								</ul><br>
								<div class="row">
								    <form method="GET" action="{{route('liste_chambre_prix')}}" > 
										<div class="col-lg-3">
											<input type="number" placeholder="min" name="minprix" style="color: #666;border: 1px solid #ccc;border-radius: 3px;padding: 4px;width: 60px;margin-left: -32px;" required>
										
										</div> .
										<div class="col-lg-3">
											<input type="number" placeholder="max" name="maxprix" style=" color: #666;border: 1px solid #ccc;border-radius: 3px; padding: 4px;width: 67px;    position: absolute;left:71px;top: -58px;" required>
										
										</div>
										<div class="col-lg-3">
											<input type="submit" value="Ok" style="color: #080808; border: 1px solid #ccc; border-radius: 3px; padding: 9px;width: 50px;left: 160px;top: -57px;position: absolute;background-color: #fdfafabd;">
										
										</div>
									</form>
								</div>					
								
							</div>

							
						</div>
					</div>
				
					<div class="col-md-9">
				
						<div class="product-info">
					  	   <p>Resultat de recherche</p>
						   <div class="tab-single">
								<div class="row">
								    @if( count($between) > 0)
										@foreach ($between as $sp)
											<div class="col-md-4 col-xs-6">
												<div class="single-product">
													<div class="product-img">
												  	<a href="{{ route('chambre.detail',['id'=>$sp->id])}}">
															<img class="default-img" src="{{asset('uploads/chambre/'.$sp->img_ch)}}" alt="#">
															<img class="hover-img" src="{{asset('uploads/chambre/'.$sp->img_ch)}}" alt="#">
															@if(  $sp->status_ch == 'libre'  )
															<span class="new">{{ $sp->status_ch }} </span>
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
															@if(  $sp->status_ch == 'libre'  )
															<div class="product-action-2">
																<a title="Reserve ce chambre" href="{{ route('reservation',['id'=>$sp->id]) }}"> Reservation </a>
															</div>
															@else 
															<div class="product-action-2">
																<a>Ce chambre est deja reservé</a>
															</div>
															@endif
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
															<span>{{ $prix }}Ar</span>
														</div>
													</div>
												</div>
											</div>
												
										@endforeach
									@else	
									    <div class="col-md-4 col-xs-6">
											<div class="single-product">
											 <center><h3 style="color: #c76547;"> Aucun Resultat!! <a href="{{ route('liste_chambre') }}">Retour</a></h3></center>
											</div>	
										</div>
									@endif	
								</div>
						    </div>
						</div>
		
					</div>
				
				
				</div>
			</div>
		</section>
		<!--/ End Blog Single -->
@endsection