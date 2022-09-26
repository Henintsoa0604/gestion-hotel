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
							<li class="active"><a href="#">Profile</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
			
	<!-- Shopping Cart -->
	@foreach($resListe as $liste)
	<section class="shop checkout section">
		<div class="container">
			<div class="row">
		
            <div class="col-lg-6 col-md-6 col-12">

                <div class="shop-single-blog">
                  <img src="{{asset('uploads/chambre/'.$liste->img_ch)}}" width="100%" alt="#">   
                </div>
                <!-- End Single Blog  -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">

                <div class="single-widget">
                    <h2>Information sur la chambre <br> 
                        <i class="fa fa-star" style="color:red;"></i>
                        <i class="fa fa-star" style="color:red;"></i>
                        <i class="fa fa-star" style="color:red;"></i>
                        <i class="fa fa-star" style="color:red;"></i>
                        <i class="fa fa-star-o"></i>
                    </h2>
                   
                    <div class="content">
                        <ul>
                            <li>Numero chambre:<span>{{ $liste->num_ch }}</span></li>
                            <li>Tel chambre:<span>{{ $liste->num_tel_ch }}</span></li>
                            <li>Nombre de lit:<span>{{ $liste->nbr_lit_ch }}</span></li>
                            <li>Etage:<span>{{ $liste->etage_ch }}</span></li>
                            <li class="more-btn">{{ $liste->description_ch}}</li>
                            <li class="last"></span></li>
                           
                        </ul>
                      
                    </div>
                </div>
               
            </div>
			<div class="col-lg-3 col-md-6 col-12">

                <div class="single-widget">
                    <h2>Information sur la reservation <br> 
                        <i class="fa fa-star" style="color:red;"></i>
                        <i class="fa fa-star" style="color:red;"></i>
                        <i class="fa fa-star" style="color:red;"></i>
                        <i class="fa fa-star" style="color:red;"></i>
                        <i class="fa fa-star-o"></i>
                    </h2>
                   
                    <div class="content">
                        <ul>
                            <li>Debut :<span>{{$liste->date_debut}}</span></li>
                            <li>Fin :<span>{{$liste->date_fin}}</span></li>
                            <li>Jour :<span>{{$liste->nbr_jour}}</span></li>
                            <li>Montant : <span>{{$liste->montant}}Ar</span></li>
							@if($liste->status == 'Accepté')
							<li>Status : <span style=" display: inline-block;padding: .25em .4em;font-size: 90%;font-weight: 700;line-height: 1;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;color: #fff;background: #46a61a !important;">{{$liste->status}} </span></li>
                            @elseif($liste->status == 'En attente')
							<li>Status : <span style=" display: inline-block;padding: .25em .4em;font-size: 90%;font-weight: 700;line-height: 1;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;color: #fff;background: #6f736e !important;">{{$liste->status}} </span></li>
							@else
							<li>Status : <span style=" display: inline-block;padding: .25em .4em;font-size: 90%;font-weight: 700;line-height: 1;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;color: #fff;background: #f7002e !important;">{{$liste->status}} </span></li>
							@endif			
							<li class="more-btn">{{ $liste->desc}}</li>
                            <li class="last"><span><a href="{{ route('reservation.deleteAdmin',['id'=>$liste->id]) }}" onclick="return confirm('Voulez vous supprimer ce reservation?')" title="Effacer" style="color:red;"><i class="ti-trash remove-icon">Effacer</i></a>&nbsp&nbsp&nbsp&nbsp<a href="{{ route('reservation.print',['id'=>$liste->id]) }}" target="_blank"><i class="ti-eye" title="Imprimer">Imprimer</i></a></span></li>
							
                           
                        </ul>
                      
                    </div>
                </div>
               
            </div>
			</div>  
		</div>
	</section>
	<hr>
	@endforeach  
    <div class="col-md-12">
        <div class="store-filter clearfix">
        <li>{{ $resListe->links() }}</li>
        </div>
    </div>	  

	<!--/ End Shopping Cart -->
		<script src="{{ asset('assets/js/sweetalert.js') }}"></script>
		<script>
			@if(Session::has('success'))
				// alert('{{ Session::get('success') }}');	
				swal({
					title: "Info!",
					text: "{{ Session::get('success') }}!!!",
					icon: "info",
					button: "Ok",
				});
			@endif
		</script>
	
@endsection    