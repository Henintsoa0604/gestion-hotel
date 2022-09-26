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
							<li class="active"><a href="#">reservation</a></li>
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
                       
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">L'historique de votre reservation se trouve dans la liste ci-dessous </h2>
                        <div class="button">
                            <a href="{{ route('liste_chambre')}}"  class="btn wow fadeInUp"  >Retour au liste des chambres</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<!-- Shopping Cart -->
	@foreach($resListe as $liste)
	<section class="shop checkout section">
		<div class="container">
			<div class="row">
		
           
           
			<div class="col-lg-8 col-md-6 col-12">

                <div class="single-widget">
                    <h2>Reservation N°: {{ $liste->id }}<br> 
                       
                    </h2>
                   
                    <div class="content"><br>
                     
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Chambre</th>
                                            <th scope="col">Tel</th>
                                            <th scope="col">Lits</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Etage</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                <div class="media align-items-center">
                                                    <a href="#" class="avatar rounded-circle mr-3">
                                                    <img alt="Image placeholder" style="height: 52px;" src="{{asset('uploads/chambre/'.$liste->img_ch)}}">
                                                    </a>
                                                    <div class="media-body">
                                                    <span class="mb-0 text-sm">Chambre N° {{ $liste->num_ch }}</span>
                                                    </div>
                                                </div>
                                                </th>
                                                <td>
                                                {{ $liste->num_tel_ch }} 
                                                </td>
                                                <td>
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-warning"></i> {{ $liste->nbr_lit_ch }} lits
                                                </span>
                                                </td>
                                                <td>
                                                <div class="avatar-group">
                                                {{ $liste->description_ch}}
                                                </div>
                                                </td>
                                                <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2">  {{ $liste->etage_ch}}</span>
                                                    <div>
                                                   
                                                    </div>
                                                </div>
                                                </td>
                                               
                                            </tr>
                                    
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                </div>
               
            </div>
             <div class="col-lg-3 col-md-6 col-12">

               
                <div class="single-widget">
                    <h2>Information sur la chambre </h2>
                   
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
                <!-- End Single Blog  -->
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