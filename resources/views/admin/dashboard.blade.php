
<!doctype html>
<html lang="en">

<head>
	<title>Dashboard Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('style/template/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('style/template/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('style/template/assets/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{asset('style/template/assets/vendor/chartist/css/chartist-custom.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('style/template/assets/css/main.css')}}">
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
						<li><a href="/admin" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="/products" class=""><i class="lnr lnr-chart-bars"></i> <span>Product</span></a></li>
						<li><a href="/categories" class=""><i class="lnr lnr-cog"></i> <span>Product Categories</span></a></li>
						<li><a href="/admin/transaksi" class=""><i class="lnr lnr-cog"></i> <span>Transaksi</span></a></li>
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
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"></h3>
							<p class="panel-subtitle"></p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<div class="metric">
										<p>
										<h3>{{ \App\User::all()->count() }}</h3>
										<h4>Registered User</h4>
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="metric">
										<p>
										<h3>{{ \App\Transaction::all()->count() }}</h3>
										<h4>Transaction</h4>
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="metric">
										<p>
										<h3>{{ \App\Product::all()->count() }}</h3>
										<h4>Active Product</h4>
										</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="metric">
									<span ><i class=""></i></span>
									<p>
										<center><h4>Transaksi Bulan<select name="bulan" id="bulan" style="
											margin-bottom: 1em;
											padding: .25em;
											border: 0;
											font-weight: bold;
											letter-spacing: .15em;
											color: black;
											background-color: rgba(255,255,255,0.1);
											border-radius: 0;
											&:focus, &:active {
											outline: 0;
											border-bottom-color: red;
											color: black;
											}
										">
										<option value="1" style="color:black" @if (date('m') == 1)
												selected
											@endif>Januari</option>
											<option value="2" style="color:black"  @if (date('m') == 2)
											selected
										@endif>Februari</option>
											<option value="3" style="color:black"  @if (date('m') == 3)
											selected
										@endif>Maret</option>
											<option value="4" style="color:black"  @if (date('m') == 4)
											selected
										@endif>April</option>
											<option value="5" style="color:black"  @if (date('m') == 5)
											selected
										@endif>Mei</option>
											<option value="6" style="color:black"  @if (date('m') == 6)
											selected
										@endif>Juni</option>
											<option value="7" style="color:black"  @if (date('m') == 7)
											selected
										@endif>Juli</option>
											<option value="8" style="color:black"  @if (date('m') == 8)
											selected
										@endif>Agustus</option>
											<option value="9" style="color:black"  @if (date('m') == 9)
											selected
										@endif>September</option>
											<option value="10" style="color:black"  @if (date('m') == 10)
											selected
										@endif>Oktober</option>
											<option value="11" style="color:black"  @if (date('m') == 11)
											selected
										@endif>November</option>
											<option value="12" style="color:black"  @if (date('m') == 12)
											selected
										@endif>Desember</option>
										</select>
										</h4>
										@php
											setlocale(LC_MONETARY,"id_ID");
										@endphp
										<h2 class="mb-2">Jumlah Transaksi: <span><strong id="total">{{$status['total']}}</strong></span></h2>
										<h4>Unverified Transaction <span><strong id="unverified">{{$status['unverified']}}</strong></span></h4>
										<h4>Expired Transaction <span><strong id="expired">{{$status['expired']}}</strong></span></h4>
										<h4>Canceled Transaction <span><strong id="canceled">{{$status['canceled']}}</strong></span></h4>
										<h4>Verified Transaction <span><strong id="verified">{{$status['verified']}}</strong></span></h4>
										<h4>Delivered Transaction <span><strong id="delivered">{{$status['delivered']}}</strong></span></h4>
										<h4>Success Transaction <span><strong id="success">{{$status['success']}}</strong></span></h4>
										<h2>Total Penghasilan <span><strong id="harga">Rp {{number_format($status['harga'],0,',','.')}}</strong></span></h2>
									</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="metric">
									<span><i class=""></i></span>
									<p>
										<center><h4>Transaksi Tahun<select name="tahun" id="tahun" style="
										margin-bottom: 1em;
										padding: .25em;
										border: 0;
										font-weight: bold;
										letter-spacing: .15em;
										color: black;
										background-color: rgba(255,255,255,0.1);
										border-radius: 0;
										&:focus, &:active {
											outline: 0;
											border-bottom-color: red;
											color: black;
										}
										">
											@for ($i = 2019; $i <= date('Y'); $i++)
												<option value="{{$i}}" @if ($i == date('Y'))
													selected
												@endif style="color:black">{{$i}}</option>
											@endfor
											</select> <i class="mdi mdi-diamond mdi-24px float-right"></i>
										</h4>
										<h2 class="mb-2">Jumlah Transaksi: <span><strong id="total-tahun">{{$transaksi_tahun->count()}}</strong></span></h2>
										<h4>Unverified Transaction <span> <strong id="unverified-tahun">{{$status_tahun['unverified']}}</strong></span></h4>
										<h4>Expired Transaction <span><strong id="expired-tahun">{{$status_tahun['expired']}}</strong></span></h4>
										<h4>Canceled Transaction <span><strong id="canceled-tahun">{{$status_tahun['canceled']}}</strong></span></h4>
										<h4>Verified Transaction <span><strong id="verified-tahun">{{$status_tahun['verified']}}</strong></span></h4>
										<h4>Delivered Transaction <span><strong id="delivered-tahun">{{$status_tahun['delivered']}}</strong></span></h4>
										<h4>Success Transaction <span><strong id="success-tahun">{{$status_tahun['success']}}</strong></span></h4>
										<h2>Total Penghasilan <span><strong id="harga-tahun">Rp {{number_format($status_tahun['harga'],0,',','.')}}</strong></span></h2>
									</p>
								</div>
							</div>
							@for ($i = 1; $i <= 12; $i++)
							<input type="hidden" id='bulan{{$i}}' value="{{$bulan[$i]}}">
							@endfor
							<div class="row">
								<div class="col-md-9">
									<div id="headline-chart" class="ct-chart"></div>
								</div>
								<!-- <div class="col-md-3">
									<div class="weekly-summary text-right">
										<span class="number">2,315</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span>
										<span class="info-label">Total Sales</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number">$5,758</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
										<span class="info-label">Monthly Income</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number">$65,938</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
										<span class="info-label">Total Income</span>
									</div>
								</div> -->
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2021 <a href="https://www.themeineed.com" target="_blank">Kelompok 2</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{asset('style/template/assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('style/template/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('style/template/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('style/template/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	<script src="{{asset('style/template/assets/vendor/chartist/js/chartist.min.js')}}"></script>
	<script src="{{asset('style/template/assets/scripts/klorofil-common.js')}}"></script>
</body>

</html>
