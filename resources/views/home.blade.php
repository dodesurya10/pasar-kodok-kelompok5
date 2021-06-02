@extends('layouts.user-app')

@section('content')
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>

						<div>
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>PASAR</span>-KODOK</h1>
								</div>
								<div class="col-sm-6">
									<img src="template/images/home/girl1.jpg" class="girl img-responsive" alt="" />
									<img src="template/images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>PASAR</span>-KODOK</h1>
								</div>
								<div class="col-sm-6">
									<img src="template/images/home/girl2.jpg" class="girl img-responsive" alt="" />
									<img src="template/images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>PASAR</span>-KODOK</h1>
								</div>
								<div class="col-sm-6">
									<img src="template/images/home/girl3.jpg" class="girl img-responsive" alt="" />
									<img src="template/images/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>
						</div>
						
						<a href="template/#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="template/#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 padding-right">
					<div class="category-tab"><!--category-tab-->
						<div class="row mt-5">
                        @foreach ($product as $products)
                            <div class="col-lg-3 col-md-6">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            @foreach ($products->product_image as $image)
                                            <img src="/uploads/product_images/{{$image->image_name}}" alt="" />
                                                @break
                                            @endforeach
											@php
												$home = new Home;
												$disc = $home->tampildiskon($products->discount);
											@endphp
											@if($disc!=0)
											<div style="background-color:red;"class="product_extra product_new"><a href="categories.html">-{{$disc}}%</a></div>
											@endif
											<div class="p_icon">
												<a href="/product/{{$products->id}}">
													<i class="ti-shopping-cart"></i>
												</a>
											</div>
											<div class="row m-auto">
											@if ($products->stock == 0)
												<div class="col badge badge-danger mb-2 mr-4">Stok Habis!</div>
											@else
												<div class="col"></div>
											@endif
											</div>
											<div>
											@php
												$home = new Home;
												$harga = $home->diskon($products->discount,$products->price);
											@endphp
											@if ($harga != 0)	 
												<h2><del>Rp.{{number_format($products->price)}}</del></h2>  
												<span>Rp.{{number_format($harga)}}</span>
												<p>{{$products->product_name}}</p>
											@else
											<h2>Rp.{{number_format($products->price)}}</h2>
											<p>{{$products->product_name}}</p>
											@endif
                                            <!-- <h2>Rp.{{number_format($products->price)}}</h2> -->
                                            <!-- <p>{{$products->product_name}}</p> -->
                                            <a href="/product/{{$products->id}}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View</a>
											</div>
										</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
						</div>
					</div><!--/category-tab-->
				</div>
			</div>
		</div>
	</section>
@endsection