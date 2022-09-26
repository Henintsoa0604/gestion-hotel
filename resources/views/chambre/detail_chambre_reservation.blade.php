@extends('layouts.header_cli')

@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{ route('accueil')}}">Accueil<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="#">detail chambre</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
<section class="shop checkout section">
    <div class="container">
        <div class="row">
          @foreach($listes as $liste)
            <div class="col-lg-6 col-md-6 col-12">

                <div class="shop-single-blog">
                  <img src="{{asset('uploads/chambre/'.$liste->img_ch)}}" width="100%" alt="#">   
                </div>
                <!-- End Single Blog  -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">

                <div class="single-widget">
                    <h2>{{ $liste->description_cat}} <br> 
                       
                    </h2>
                   
                    <div class="content">
                        <ul>
                            <li>Numero chambre<span>{{ $liste->num_ch }}</span></li>
                            <li>Tel chambre<span>{{ $liste->num_tel_ch }}</span></li>
                            <li>Nombre de lit<span>{{ $liste->nbr_lit_ch }}</span></li>
                            <li>Etage<span>{{ $liste->etage_ch }}</span></li>
                            <li class="more-btn"><h5>Description:</h5>{{ $liste->description_ch}} pour {{ $liste->nbr_pers}} personnes</li>
                            <li class="last"></span></li>
                           
                        </ul>
                        @if( $liste->status_ch == 'libre')
                          <a type="button" class="btn" href="{{ route('reservation',['id' => $liste->id]) }}" style="color:white"> Reservation </a>
                        @elseif( $liste->status_ch == 'Reservé')
                          <button type="button" class="btn" style="background-color:#ff5200e8"> Deja reservé </button>
                        @else
                          <button type="button" class="btn" style="background-color:#ff5200e8"> En attente </button>
                        @endif  
                    </div>
                </div>
               
            </div>
          @endforeach  
        </div>
    </div>
</section>
 <!-- Start Most Popular -->
 <div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Chambres similaires</h2>
                        <p>Vous trouvez ci-dessous les chambres simmilaires</p>
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
								<img class="default-img" src="{{asset('uploads/chambre/'.$liste->img_ch)}}" style="height:200px" alt="#">
								<img class="hover-img" src="{{asset('uploads/chambre/'.$liste->img_ch)}}" style="height:200px" alt="#">
								@if(  $liste->status_ch == 'libre'  )
								<span class="new">{{ $liste->status_ch }}</span>
								@else 
								<span class="out-of-stock">{{ $liste->status_ch }}</span>
								@endif
								</a>
								<div class="button-head">
									<div class="product-action">
									
										<i class=" ti-heart "></i>
									
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
								<h3><a href="{{ route('chambre.detail',['id'=>$liste->id])}}">{{ $liste->description_ch }} pour {{ $liste->nbr_pers}} personnes</a></h3>
								<div class="product-price">
									<span class="old">{{ $prix + 2000 }}Ar</span>
									<span>{{ $prix }}Ar</span>
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
@endsection
