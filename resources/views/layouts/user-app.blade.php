<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>Home | E-Shopper</title>
    <link href="../../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../template/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../template/css/prettyPhoto.css" rel="stylesheet">
    <link href="../../template/css/price-range.css" rel="stylesheet">
    <link href="../../template/css/animate.css" rel="stylesheet">
	<link href="../../template/css/main.css" rel="stylesheet">
	<link href="../../template/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="../../template/js/html5shiv.js"></script>
    <script src="../../template/js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="../../template/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../template/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../template/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../template/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../../template/images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/product.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/product_responsive.css')}}">
</head><!--/head-->

<body>
<header id="header"><!--header-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
						<a href="/"><h3><span>PASAR</span>-KODOK</h3></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li class="dropdown head-dpdn">	
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue"></span></a>
									<ul class="dropdown-menu">
										<li>
											<div class="notification_header">
												<center><h4>You have  new notification</h4>
											</div>
										</li>
										<div class="notification_bottom">
											<a class="btn btn-block" href="">Mark as Read</a>
										</div> 
									</ul>
								</li>	
								@auth
									<li><a href="/transaksi/{{ Auth::user()->id }}"><i class="fa fa-star"></i> Transaction</a></li>
								@endauth
								@auth
									<li><a href="/cart"><i class="fa fa-shopping-cart"></i> Cart<span class="badge badge-pill badge-info" id="jumlahcart">{{Auth::user()->cart->where('status','=','notyet')->count()}}</span></a></li>
								@endauth
									@guest
										<li class="nav-item">
											<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
										</li>
									@if (Route::has('register'))
										<li class="nav-item">
											<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
										</li>
									@endif
									@else
										<li class="nav-item dropdown">
										<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
											{{ Auth::user()->name }} <span class="caret"></span>
										</a>

									@if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
											<a class="dropdown-item" href="{{ route('admin.logout') }}"
												onclick="event.preventDefault();
													document.getElementById('admin-logout-form').submit();">
												{{ __('Logout') }}
											</a>
											<form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST"
												style="display: none;">
												@csrf
											</form>
										</div>
									@else
										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
											<a class="dropdown-item" href="{{ route('user.logout') }}"
											onclick="event.preventDefault();
														document.getElementById('user-logout-form').submit();">
												{{ __('Logout') }}
											</a>
											<form id="user-logout-form" action="{{ route('user.logout') }}" method="POST"
												style="display: none;">
												@csrf
											</form>
										</div>
									@endif
								@endguest
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	</header><!--/header-->
    @yield('content')
	<footer id="footer"><!--Footer-->
		<div class="footer-bottom" style="position:fixed; left:0; bottom:0; right:0;">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="../../template/http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->
	
    <script src="../../template/js/jquery-3.2.1.min.js"></script>
    <script src="../../template/js/jquery.js"></script>
	<script src="../../template/js/bootstrap.min.js"></script>
	<script src="../../template/js/jquery.scrollUp.min.js"></script>
	<script src="../../template/js/price-range.js"></script>
    <script src="../../template/js/jquery.prettyPhoto.js"></script>
    <script src="../../template/js/main.js"></script>
    <script src="{{ asset('user/product.js')  }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
    @yield('script')
</body>
</html>