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
							<li class="active"><a href="#l">Favories</a></li>
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
                       
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">La liste des favoris se trouve dans la liste ci-dessous </h2>
                        <div class="button">
                            <a href="{{ route('liste_chambre')}}"  class="btn wow fadeInUp"  >Retour au liste des chambres</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>		
	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>Chambre</th>
								<th>Description</th>
								<th class="text-center">Tel chambre</th>
								<th class="text-center">Lit</th>
								<th class="text-center">Status</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
						  @foreach($favories as $fav)	
							<tr>
								<td class="image" data-title="No">N° :{{ $fav->num_ch}}</td>
								<td class="product-des" data-title="Description">
									<p class="product-name"><a href="#">Pour {{ $fav->nbr_pers}} personnes</a></p>
									<p class="product-des">{{ $fav->description_ch}}</p>
								</td>
								<td class="price" data-title="Price"><span>{{ $fav->num_tel_ch}}</span></td>
								<td class="price" data-title="Price"><span>{{ $fav->nbr_lit_ch}} lits</span></td>
								<td class="total-amount" data-title="Total"><span>{{ $fav->status_ch}}</span></td>
								<td class="action" data-title="Remove"><a href="{{ route('favorie.delete',['id'=>$fav->id]) }}" onclick="return confirm('Voulez vous supprimer ?')" ><i class="ti-trash remove-icon"></i></a></td>
							</tr>
                          @endforeach  
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			
		</div>
	</div>
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