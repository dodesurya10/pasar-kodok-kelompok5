@extends('layouts.user-app')

@section('content')
<section class="checkout_area section_gap">
  <div class="container">
    <div class="billing_details">
      <div class="row">
        <div class="col-lg-8">
          <h3>Detail Pemesanan</h3>
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <form
            action="/beli" method="post"
            class="row contact_form needs-validation"
            id="checkout_form" class="checkout_form"
          >
            @csrf
            <div class="col-md-12 form-group p_star">
              <label>Nama</label>
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value="{{Auth::user()->name}}"
              />
            </div>
            <div class="col-md-6 form-group p_star">
              <label>No Telp</label>
              <input
                type="text"
                class="form-control"
                id="number"
                name="no_telp"
                placeholder="Phone Number"
                required
              />
            </div>
            <div class="col-md-6 form-group p_star">
              <label>Email</label>
              <input
                type="text"
                class="form-control"
                id="email"
                name="compemailany"
                value="{{Auth::user()->email}}"
              />
            </div>
            <div class="col-md-12 form-group p_star">
              <label>Provinsi</label>
                <select 
                  style="border: 1px solid #C8C8C8; border-radius:3px; padding:5px 7px; color: #707070; font-size: 16px;"
                  name="province" id="provinsi" class="form-select dropdown_item_select checkout_input cekongkir" required
                >
                  <option></option>
                    @foreach ($provinsi as $prov)
                      <option value="{{$prov->id}}">{{$prov->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-group p_star">
              <label>Kota</label>
              <select 
                style="border: 1px solid #C8C8C8; border-radius:3px; padding:5px 7px; color: #707070; font-size: 16px;"
                name="regency" id="kota" class="form-select country_select dropdown_item_select checkout_input cekongkir" required
              >
                <option value=""></option>
              </select>
            </div>
            <div class="col-md-12 form-group p_star">
              <label>Alamat</label>
              <input
                type="text"
                class="form-control"
                id="address"
                name="address"
                placeholder="Address"required>
            </div>
            <div class="col-md-12 form-group p_star">
              <label>Kurir</label>
              <select style="border: 1px solid #C8C8C8; border-radius:3px; padding:5px 7px; color: #707070; font-size: 16px;" name="courier" id="kurir" class="form-select country_select dropdown_item_select checkout_input cekongkir" required>
                <option></option>
                @foreach ($kurir as $k)
                    <option value="{{$k->id}}">{{$k->courier}}</option>
                @endforeach
              </select>
            </div> 
          </div>
          <div class="col-lg-4">
            <div class="order_box">
              <h2>Rincian Pemesanan</h2>
              <ul class="list">
                @foreach ($cart as $item)
                  <li>
                    <a href="#">
                    <table class="table table-borderless">
                      
                      <tbody>
                      @if (is_null($item->product))
                        <tr>
                          <td>{{$item->product_name}}</td>
                          <td>@php
                          $home = new Home;
                          $hasil = $home->diskon($item->discount,$item->price);
                        @endphp
                        @if ($hasil != 0)
                          <span>Rp.{{number_format($hasil)}}</span>
                        @else
                          <span>Rp.{{number_format($item->price)}}</span>
                        @endif</td>
                        </tr>
                        <tr>
                            <td>Qty</td>
                            <td><span class="middle">{{$qty}}</span></td>
                        </tr>
                      @else
                        <tr>
                            <td>{{$item->product->product_name}}</td>
                            <td>
                            @php
                          $home = new Home;
                          $hasil = $home->diskon($item->product->discount,$item->product->price);
                        @endphp
                        @if ($hasil != 0)
                        <span>Rp.{{number_format($hasil)}}</span>
                        @else
                        <span>Rp.{{number_format($item->product->price)}}</span>
                        @endif  
                            </td>
                        </tr>
                        <tr>
                            <td>Qty</td>
                            <td><span class="middle">{{$item->qty}}</span></td>
                        </tr>
                        @endif

                        <tr>
                          <td>Sub Total</td>
                          <td><span>Rp.{{ number_format($subtotal)}}</span></td>
                        </tr>
                        <tr>
                          <td>Shipping</td>
                          <td><span id="biaya-ongkir">Rp.</span></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                          <td><span class = "font-weight-bold">Rp.<span class = "font-weight-bold" id="total-biaya"></span></span></td>
                        </tr>
                      </tbody>
                      
                    </table>
                      <!-- @if (is_null($item->product))
                        {{$item->product_name}}<span class="middle"> x {{$qty}}</span>
                        @php
                          $home = new Home;
                          $hasil = $home->diskon($item->discount,$item->price);
                        @endphp
                        @if ($hasil != 0)
                          <span>Rp{{number_format($hasil)}}</span>
                        @else
                          <span>Rp{{number_format($item->price)}}</span>
                        @endif -->
                      <!-- @else
                        {{$item->product->product_name}}<span class="middle">x {{$item->qty}}</span>
                        @php
                          $home = new Home;
                          $hasil = $home->diskon($item->product->discount,$item->product->price);
                        @endphp
                        @if ($hasil != 0)
                        <span>Rp{{number_format($hasil)}}</span>
                        @else
                        <span>{{number_format($item->product->price)}}</span>
                        @endif  
                      @endif -->
                    <!-- </a>
                  </li>
                @endforeach
                <li>
                  <a href="#">
                    Sub Total
                    <span>Rp{{ number_format($subtotal)}}</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    Shipping
                    <span id="biaya-ongkir">Rp</span>
                  </a>
                </li>
              </ul>
              <ul class="list list_2">
                <li>
                  <a href="#">
                    Total
                    <span class = "font-weight-bold">Rp<span class = "font-weight-bold" id="total-biaya"></span></span>
                  </a>
                </li>
              </ul> -->
              <input type="hidden" name="sub_total" value="{{$subtotal}}">
              <input type="hidden" name="total" id="totalbiaya">
              <input type="hidden" name="shipping_cost" id="ongkir">
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <input type="hidden" name="product_id" value="{{$product_id}}">
              <input type="hidden" name="qty" value="{{$qty}}">
              <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary btn-block" id="beli">Proceed to Payment</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="billing_details my-5">
      <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
      <input type="hidden" value="{{$weight}}" id="weight">
    </div>
  </div>
  <br><br><br>
</section>
<!--================End Checkout Area =================-->
@endsection

@section('script')
<script>
    $(document).ready(function(e){
        function formatNumber(num) {
          return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
        $('#provinsi').change(function(e){
            var id_provinsi = $('#provinsi').val()
            if(id_provinsi){
                jQuery.ajax({
                    url: '/kota/'+id_provinsi,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#kota').empty();
                        $.each(data, function(key,value){
                            $('#kota').append('<option value="'+key+'">'+value+'</option>');
                        });
                    },
                });
            }else{
                $('#kota').empty();
            }
        });

        $('.cekongkir').change(function(e){
            var kurir = $('#kurir').val();
            var provinsi = $('#provinsi').val();
            var kota = $('#kota').val();
            var berat = parseInt($('#weight').val());
            if(provinsi>0 && kurir>0){
                jQuery.ajax({
                    url: "{{url('/ongkir')}}",
                    method: 'POST',
                    data: {
                        _token: $('#signup-token').val(),
                        destination: kota,
                        weight: berat,
                        courier: kurir,
                        prov: provinsi, 
                    },
                    success: function(result){
                        console.log(result.success);
                        console.log(result.hasil["etd"]);
                        $('#biaya-ongkir').text('Rp.'+ formatNumber(result.hasil["value"]));
                        $('#ongkir').val(result.hasil["value"]);
                        $('#biaya-ongkir').append('<input type="hidden" id="biaya-ongkir" value="'+result.hasil["value"]+'">');
                        $('#total-biaya').text( formatNumber({{$subtotal}}+result.hasil["value"]));
                        $('#totalbiaya').val({{$subtotal}}+result.hasil["value"]);
                    }
                });
                // console.log('wrong');
                // console.log('kota: '+kota+' provinsi: '+provinsi+' Kurir: '+kurir)
            }else{
                console.log('wrong');
                console.log('provinsi: '+provinsi+' Kurir: '+kurir)
            }

        });

        $('#beli').click(function(e){
          var kurir = $('#kurir').val();
          var provinsi = $('#provinsi').val();
          var kota = $('#kota').val();
          var alamat = $('#alamat').val();
          var totals = parseInt($('#total-biaya').text());
          var subtotal = parseInt('{{$subtotal}}');
          var ongkir = $('#biaya-ongkir').val();
          var user = $('#user_id').val();
          console.log(totals)
          if(totals==0){
            alert('Tolong Lengkapi Masukan Data');
            return false;
          }
        });
    });
</script>
@endsection