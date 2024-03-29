<!doctype html>
<html lang="en">

<head>
	<title>Dashboard Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('style/template/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('style/template/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('style/template/assets/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{asset('style/template/assets/vendor/chartist/css/chartist-custom.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('style/template/assets/css/main.css')}}">
	@yield('css')
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('style/template/assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('style/template/assets/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('style/template/assets/img/favicon.png')}}">
	
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="/admin/">Admin Page</a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
									<li class="dropdown head-dpdn">
										<?php 
                  								$id = 1;
                  								$admin = App\Admin::find(1);
                  								$notif_count = $admin->unreadNotifications->count();
                  								$notifications = DB::table('admin_notifications')->where('notifiable_id',$id)->where('read_at',NULL)->orderBy('created_at','desc')->get();
                						?>
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">{{$notif_count}}</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<center><h4>You have {{$notif_count}} new notification</h4>
												</div>
											</li>
											<li>
												@foreach($notifications as $notif)
													{!!$notif->data!!}
											  	@endforeach
											</li>
											 <li>
												<div class="notification_bottom">
													<a class="btn btn-block" href="/admin/marknotifadmin">Mark as Read</a>
												</div> 
											</li>
										</ul>
									</li>	
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">Basic Use</a></li>
								<li><a href="#">Working With Data</a></li>
								<li><a href="#">Security</a></li>
								<li><a href="#">Troubleshooting</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('style/template/assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span>Admin</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
								<li><a href="{{ route('admin.logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span>
                                </a></li>
							</ul>
						</li>
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/admin" class="{{ request()->is('admin') ? ' active' : ''}}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>						<li><a href="/products" class="{{ request()->is('products') ? ' active' : ''}}"><i class="lnr lnr-chart-bars"></i> <span>Product</span></a></li>
						<li><a href="/categories" class="{{ request()->is('categories') ? ' active' : ''}}"><i class="lnr lnr-cog"></i> <span>Product Categories</span></a></li>
						<li><a href="/admin/transaksi" class="{{ request()->is('admin/transaksi') ? ' active' : ''}}"><i class="lnr lnr-cog"></i> <span>Transaksi</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="container-fluid">
						@yield('page-contents')
	
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer class="fixed-bottom">
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	@yield('javascript')
	<script src="{{asset('style/template/assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('style/template/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('style/template/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('style/template/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	<script src="{{asset('style/template/assets/vendor/chartist/js/chartist.min.js')}}"></script>
	<script src="{{asset('style/template/assets/scripts/klorofil-common.js')}}"></script>
	@yield('script')
	
	
</body>

</html>