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
								<li class="active"><a href="#">reservation</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Start Checkout -->
		<section class="shop checkout section">
			<div class="container">
				<div class="row">
			        @if(Session::has('success'))
								<div class="col-lg-8 col-12" style="border: 1px solid green;height: 41px;/*! padding: inherit; */margin: inherit;padding: 6px;/*! background-color: yellowgreen; */color: green;"> 
									<a href="{{ route('reservation.detail') }}" type="button" class="btn_envoye"> Cliquer ici pour la detail de la reservation </a>
								</div>
							@endif	
				
						<div class="col-lg-8 col-12">
						<div class="single-widget">
								<h2>RESERVATION</h2>
							
								<!-- Form -->
									<form method="POST" class="form" action="{{ route('reservation.submit') }}" enctype="multipart/form-data">
															
										{{ csrf_field() }}
															<p>Veuillez completer les informations pour envoyer la reservation</p><br>
									<div class="row" style="border: 1px solid #e3ded4;">
								     	<div class="col-lg-6 col-md-6 col-12">
												<p style="color:orange">Information sur votre identité</p><br>
											</div>
											<div class="col-lg-6 col-md-6 col-12">
												
											</div>
											<div class="col-lg-6 col-md-6 col-12" style="display:none">
												<div class="form-group">
													<label>ID<span>*</span></label>
													<input  type="text" name="user_id" readonly="readonly" placeholder="" required="required" value="{{ Auth::user()->id }}">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-12">
												<div class="form-group">
													<label>Nom<span>*</span></label>
													<input type="text"  readonly="readonly" placeholder="" required="required" value="{{ Auth::user()->name }}">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-12">
												<div class="form-group">
													<label>Prenom<span>*</span></label>
													<input type="text" readonly="readonly" placeholder="" required="required" value="{{ Auth::user()->prenom_cli }}">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-12">
												<div class="form-group">
													<label>Adresse complet<span>*</span></label>
													<input type="text"placeholder="" readonly="readonly" required="required" value="{{ Auth::user()->adrs_cli }} {{ Auth::user()->ville_cli }} {{ Auth::user()->pays_cli }}">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-12">
												<div class="form-group">
													<label>Telephone<span>*</span></label>
													<input type="text"  placeholder="" readonly="readonly" required="required" value="{{ Auth::user()->tel_cli }}">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-12" style="display:none">
												<div class="form-group">
													<label>Email<span>*</span></label>
													<input type="text"  placeholder="" readonly="readonly" required="required" value="{{ Auth::user()->email }}">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-12" style="display:none">
												<div class="form-group">
													<label>ID Chambre<span>*</span></label>
													<input type="text" name="chambre_id"  placeholder="" readonly="readonly" required="required" value="{{ $chambre->id }}">
												</div>
											</div>
									</div><br>
									<div class="row" style="border: 1px solid #e3ded4;">
								   	<div class="col-lg-6 col-md-6 col-12">
												<p style="color:orange">Information la reservation</p><br>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
												
										</div>
										<hr>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Date debut du reservation<span>*</span></label>
												<input type="date" name="date_debut"  placeholder="" required="required" >
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Date fin reservation<span>*</span></label>
												<input type="date" name="date_fin"  placeholder=""  required="required" >
											</div>
										</div>
									</div><br>
									<div class="row">
											<div class="col-lg-6 col-md-6 col-12"> 
												<input type="submit"  value="Envoyer reservation" class="btn">
											</div>
									</div>
								</form>
								<!--/ End Form -->
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-12">

							<!-- Order Widget -->
							<div class="single-widget">
									<h2>INFORMATION CHAMBRE</h2>
									<div class="content">
											<ul>
													<li>Numero chambre<span>{{ $chambre->num_ch}}</span></li>
													<li>Tel chambre<span>{{ $chambre->num_tel_ch}}</span></li>
													<li>Nombre de lit<span>{{ $chambre->nbr_lit_ch}}</span></li>
													<li>Etage<span>{{ $chambre->etage_ch}}</span></li>
													<li class="last"></span></li>
											</ul>
									</div>
							</div>
							<!--/ End Order Widget -->
							<div class="shop-single-blog">
								<img src="{{asset('uploads/chambre/'.$chambre->img_ch)}}" alt="#">
								<div class="content">
								
								
									<a  class="more-btn">{{ $chambre->description_ch}}</a>
								</div>
							</div>
							<!-- End Single Blog  -->
						</div>
				</div>
			</div>
		</section>
		<!--/ End Checkout -->
		<script src="{{ asset('assets/js/sweetalert.js') }}"></script>
		<script>
			@if(Session::has('success'))
			 // alert('{{ Session::get('success') }}');	
			  swal({
				title: "Reussie!",
				text: "{{ Session::get('success') }}, veuillez consulter la detail de la reservation",
				icon: "success",
				button: "Ok",
			  });
			@endif
		</script>
		<script>
			@if(Session::has('error'))
			 // alert('{{ Session::get('success') }}');	
			  swal({
				title: "Erreur!",
				text: "{{ Session::get('error') }}, veuillez verifier la date de debut et la date de fin",
				icon: "error",
				button: "Ok",
			  });
			@endif
		</script>
		<script>
			@if ($errors->has('chambre_id'))
			 // alert('{{ Session::get('success') }}');	
			  swal({
				title: "Info!",
				text: "{{ $errors->first('chambre_id') }}, ou ce chambre est deja reservé",
				icon: "error",
				button: "Ok",
			  });
			@endif
		</script>
@endsection