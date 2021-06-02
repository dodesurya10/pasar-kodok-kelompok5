@extends('layouts.user-app')

@section('content')
<section>
		<div class="container">
			<div class="row">
                <div class="padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
                        @php
                            $i=1;
                            $j=1;
                        @endphp
                        <div class="details_image w-100">
                            <div>
                            <div>
                                @foreach ($products->product_image as $jpg)
                                <img style="width: 100%;"src="/uploads/product_images/{{$jpg->image_name}}" alt="">
                                @php
                                    $home = new Home;
                                    $disc = $home->tampildiskon($products->discount);
                                @endphp
                                @if($disc!=0)
                                    <div style="background-color:red;" class="product_extra product_new"><a href="categories.html">-{{$disc}}%</a></div>
                                @endif
                                @php
                                    $i++;
                                @endphp
                                @break
                                @endforeach
                            </div>
                            </div>             
                        </div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h2>{{$products->product_name}}</h2>
								<span>
                                @php
                                    $home = new Home;
                                    $harga = $home->diskon($products->discount,$products->price);
                                @endphp
                                @if ($harga != 0)
                                    <del><h4>Rp.{{number_format($products->price)}}</h3></del>
                                    <h2>Rp.{{number_format($harga)}}</h2>
                                @else
                                    <h2>Rp.{{number_format($products->price)}}</h2>
                                @endif
                                <div class="in_stock_container">
                                    <span >Availability    :</span>
                                    @if ($products->stock <= 0)
                                    <span style="color:red;">Out of Stock!</span>
                                    @else
                                        @if ($products->stock <= 5) 
                                        <span style="color:red;">Hurry Up!</span> <br>
                                    @else
                                        <span>In Stock</span> <br>
                                    @endif
                                    @endif
                                </div>
									@if (is_null(Auth::user()))
                                        @if ($products->stock < 1)
                                        <button class="btn btn-success mr-2" disabled><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Purchase</button>
                                        <button class="btn btn-warning mr-2" disabled><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</button>
                                        @else
                                        <a href="/login" class="btn btn-success mr-2"><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Purchase</a>
                                        <a href="/login" class="btn btn-warning mr-2"><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</a>
                                        @endif
                                    @else
                                        @if ($products->stock < 1)
                                        <button class="btn btn-success mr-2" class="tombol1" disabled>
                                            <i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i> Purchase
                                        </button>
                                        <button class="btn btn-warning mr-2" id="ajaxSubmit" disabled>
                                            <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart
                                        </button>
                                        @else
                                        <table>
                                            <td>
                                            <form action="/checkout" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$products->id}}" id="product_id">
                                                @if ($harga != 0)
                                                <input type="hidden" name="subtotal" id="subtotal" value="{{$harga}}">
                                                @else
                                                <input type="hidden" name="subtotal" id="subtotal" value="{{$products->price}}">
                                                @endif
                                                <input type="hidden" name="weight" value="{{$products->weight}}">
                                                <input type="hidden" name="qty" class="qty" value="1" readonly>
                                                <button type="submit" class="btn btn-success mr-2" class="tombol1">
                                                <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Purchase
                                                </button>
                                            </form>
                                            <td>
                                            <input type="hidden" value="{{$products->id}}" id="product_id">
                                            <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                                            <button class="btn btn-warning mr-2" id="ajaxSubmit">
                                                <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart
                                            </button>
                                            </td>
                                        </table>
                                        @endif
                                    @endif
								</span>
								<p><b>Availability: {{$products->stock}}</p>
								<p><b>Condition:</b> New</p>
                                <p>{{$products->description}}</p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
                <div>
            </div>
        </div>
    </section>
@endsection

@section('script')

<script>
    jQuery(document).ready(function(e){
        jQuery('#ajaxSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{url('/tambah_cart')}}",
                method: 'post',
                data: {
                    product_id: jQuery('#product_id').val(),
                    user_id: jQuery('#user_id').val(),
                },
                success: function(result){
                    jQuery('#jumlahcart').text(result.jumlah);
                }
            });
        });
    });
</script>

@endsection