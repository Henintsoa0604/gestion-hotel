<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Miray-Geek Reservation hotelerie.</title>
	<!-- Favicon -->
	<link rel="icon" type="image/jpg" href="{{ asset('assets_cli/images/icon.jpg')}}">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset('assets_cli/css/bootstrap.css') }}">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets_cli/css/magnific-popup.min.css')}}">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets_cli/css/font-awesome.css')}}">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{asset('assets_cli/css/jquery.fancybox.min.css')}}">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="{{asset('assets_cli/css/themify-icons.css')}}">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('assets_cli/css/niceselect.css')}}">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('assets_cli/css/animate.css')}}">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{asset('assets_cli/css/flex-slider.min.css')}}">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('assets_cli/css/owl-carousel.css')}}">
	<!-- Slicknav -->
    <link rel="stylesheet" href="{{asset('assets_cli/css/slicknav.min.css')}}">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="{{asset('assets_cli/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('assets_cli/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets_cli/css/responsive.css')}}">

	
	
</head>
<body class="js">
	
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->
	
	
	<!-- Header -->
	<header class="header shop">
		<!-- Topbar -->
		@if (Route::has('login'))
			@if (Auth::check())
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 col-md-12 col-12">
							<!-- Top Left -->
							<div class="top-left">
								<ul class="list-main">
									<li><i class="ti-headphone-alt"></i> {{ Auth::user()->tel_cli}}</li>
									<li><i class="ti-email"></i>  {{ Auth::user()->email }}</li>
								</ul>
							</div>
							<!--/ End Top Left -->
						</div>
						<div class="col-lg-7 col-md-12 col-12">
							<!-- Top Right -->
							<div class="right-content">
								<ul class="list-main">
								
									<li><i class="ti-user"></i> <a href="#"> {{ Auth::user()->name }}</a></li>
									
									<li><i class="ti-power-off"></i><a href="{{ route('user.logout') }}"
                                            >Se deconnecter</a></li>
								</ul>
								
							</div>
							<!-- End Top Right -->
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 col-md-12 col-12">
							<!-- Top Left -->
							<div class="top-left">
								<ul class="list-main">
									<li><i class="ti-headphone-alt"></i> 034 25 079 77</li>
									<li><i class="ti-email"></i> rakotonavalonaheritiana@gmail.com.com</li>
								</ul>
							</div>
							<!--/ End Top Left -->
						</div>
						<div class="col-lg-7 col-md-12 col-12">
							<!-- Top Right -->
							<div class="right-content">
								<ul class="list-main">
									
									<li><i class="ti-user"></i> <a href="{{ route('admin.login') }}" target="_blank">Admin</a></li>
									<li><i class="ti-power-off"></i><a href="{{ route('login') }}">Connecter</a></li>
								</ul>
							</div>
							<!-- End Top Right -->
						</div>
					</div>
				</div>
			</div>
			@endif
		@endif
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="#"><img src="{{ asset('assets_cli/images/miray.png')}}" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<select>
									<option selected="selected">Par categorie</option>
									<option>Etage</option>
									<option>Nbr lit</option>
									<option>Type</option>
								</select>
								<form>
									<input name="search" placeholder="Rechercher chambre....." type="search">
									<button class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
						
			              @if (Auth::check())
							<div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="fa fa-heart-o"></i><span class="total-count">@foreach($count_id_fav as $count) {{ $count->count }} @endforeach</span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span>Vous avez @foreach($count_id_fav as $count) {{ $count->count }} @endforeach chambre au favorie</span>
									
									</div>
									<ul class="shopping-list">
									 @foreach($favListe as $liste)
										<li>
											
											
											<h4><a href="#">{{ $liste->description_ch }}</a></h4>
											<p class="quantity">Nombre personne: <span class="amount">{{ $liste->nbr_pers}}</span></p>
										</li>
									 @endforeach	
									</ul>
									<div class="bottom">
									 <a  class="btn animate" href="{{ route('favorie.detail') }}"> Voir les favorie</a>
									
									</div>
								</div>
								
								<!--/ End Shopping Item -->
							</div>
							<div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="ti-bag"></i><span class="total-count">@foreach($count_id as $count) {{ $count->count }} @endforeach</span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span>Liste des reservation</span>
									
									</div>
									<ul class="shopping-list">
									 @foreach($resListe as $liste)
										<li>
											
											<a class="cart-img" href="#"><img src="{{asset('uploads/chambre/'.$liste->img_ch)}}" alt="#"></a>
											<h4><a href="#">{{ $liste->description_ch }}</a></h4>
											<p class="quantity">Status: <span class="amount">{{ $liste->status}}</span></p>
										</li>
									 @endforeach	
									</ul>
									<div class="bottom">
									 <a  class="btn animate" href="{{ route('reservation.detail') }}"> Historique de reservation</a>
									
									</div>
								</div>
								
								<!--/ End Shopping Item -->
							</div>
						  @endif
					
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
					
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav">
													<li class="{{ '/' == request()->path() ? 'active':''}}"><a href="{{route('accueil')}}">Accueil</a></li>
													<li class="{{ 'chambre/liste_chambre' == request()->path() ? 'active':''}}"><a href="{{route('liste_chambre')}}">Chambres</a></li>												
													<li class="{{ 'membre_hotel/liste' == request()->path() ? 'active':''}}"><a href="{{route('membre.liste')}}">Membres Hotel</a></li>
	
													<li class="{{ 'contacte' == request()->path() ? 'active':''}}"><a href="{{route('contacte')}}">Contacte</a></li>									
												
												</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->

    @yield('content')
    <!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<a href="#"><img src="{{ asset('assets_cli/images/miray.png')}}" alt="#"></a>
							</div>
							<p class="text">MIRAY GEEK nous offre le meilleur pour la reservation d'hotel. Contactez nous pour vous aider </p>
							<p class="call">Contacte :<span><a href="tel:0348885219">+261 34 88 852 19</a></span></p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Information</h4>
							<ul>
								
								<li><a href="#">Reservation d'hotel 7j/7</a></li>
								<li><a href="#">Disponibilite de la chambre</a></li>
								<li><a href="#">Consultation de la reservation </a></li>
								
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Partenaire</h4>
							<ul>
								<li><a href="#">Emit</a></li>
								<li><a href="#">Orange Madagascar</a></li>
								<li><a href="#">Hazenfield</a></li>
								<li><a href="#">Shipping</a></li>
								<li><a href="#">Otwoo Madagascar</a></li>
								<li><a href="#">Rower Construction </a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Adresse</h4>
							<!-- Single Widget -->
							<div class="contact">
								<ul>
									<li>ID40Bis,Isaha,Fianarantsoa.</li>
									<li>+261 32 26 135 13/+261 34 88 852 19</li>
									<li>miraygeek5@gmail.com</li>
									
								</ul>
							</div>
							<!-- End Single Widget -->
							<ul>
								<li><a href="www.facebook/miray.Geel"><i class="ti-facebook"></i></a></li>
								
								<li><a href="www.miraygeek.com"><i class="ti-flickr"></i></a></li>
							
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Copyright © <span id="demo"></span> <a href="http://www.miraygeek.mg" target="_blank">Miray Geek</a>  - Tous droit reservé.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="images/payments.png" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<script>
		var d = new Date();
		document.getElementById("demo").innerHTML = d.getFullYear();
	</script>
	<!-- /End Footer Area -->
 
	<!-- Jquery -->
    <script src="{{asset('assets_cli/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets_cli/js/jquery-migrate-3.0.0.js')}}"></script>
	<script src="{{asset('assets_cli/js/jquery-ui.min.js')}}"></script>
	<!-- Popper JS -->
	<script src="{{asset('assets_cli/js/popper.min.js')}}"></script>
	<!-- Bootstrap JS -->
	<script src="{{asset('assets_cli/js/bootstrap.min.js')}}"></script>
	<!-- Color JS -->
	<script src="{{asset('assets_cli/js/colors.js')}}"></script>
	<!-- Slicknav JS -->
	<script src="{{asset('assets_cli/js/slicknav.min.js')}}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{asset('assets_cli/js/owl-carousel.js')}}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{asset('assets_cli/js/magnific-popup.js')}}"></script>
	<!-- Waypoints JS -->
	<script src="{{asset('assets_cli/js/waypoints.min.js')}}"></script>
	<!-- Countdown JS -->
	<script src="{{asset('assets_cli/js/finalcountdown.min.js')}}"></script>
	<!-- Nice Select JS -->
	<script src="{{asset('assets_cli/js/nicesellect.js')}}"></script>
	<!-- Flex Slider JS -->
	<script src="{{asset('assets_cli/js/flex-slider.js')}}"></script>
	<!-- ScrollUp JS -->
	<script src="{{asset('assets_cli/js/scrollup.js')}}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{asset('assets_cli/js/onepage-nav.min.js')}}"></script>
	<!-- Easing JS -->
	<script src="{{asset('assets_cli/js/easing.js')}}"></script>
	<!-- Active JS -->
	<script src="{{asset('assets_cli/js/active.js')}}"></script>
</body>
</html>