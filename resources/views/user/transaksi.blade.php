@extends('layouts.user-app')

@section('content')
<section class="cart_area">
  <div class="container">
    <div class="cart_inner">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
            <th>
            <strong>No</strong>
            </th>
              <th>
                <strong>Sisa Waktu Bayar</strong>
              </th>
              <th>
                <strong>ID Transaksi</strong>
              </th>
              <th>
                <strong>Alamat</strong>
              </th>
              <th>
                <strong>Kota</strong>
              </th>
              <th>
                  <strong>Provinsi</strong>
              </th>
              <th>
                  <strong>Total Pembayaran</strong>
              </th>
              <th>
                  <strong>Status</strong>
              </th>
              <th>
                <strong>Aksi</strong>
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transaksi as $item)
              <tr> 
              <td scope="row">{{ $loop->iteration }}</td>
                <td>
                  @if ($item->status == 'unverified' & $item->timeout > date('Y-m-d H:i:s') & is_null($item->proof_of_payment))
                    @php
                      date_default_timezone_set("Asia/Makassar");
                      $date1 = new DateTime($item->timeout);
                      $date2 = new DateTime(date('Y-m-d H:i:s'));
                      $tenggat = $date1->diff($date2);
                    @endphp
                      <span class="btn-sm btn-warning font-weight-bold">{{$tenggat->h}} Jam, {{$tenggat->i}} Menit</span>
                  @endif
                </td>               
                <td>
                    <strong>{{$item->id}}</strong>
                </td>
                <td>
                    <strong>{{$item->address}}</strong>
                </td>
                <td>
                    <strong>{{$item->regency}}</strong>
                </td>
                <td>
                    <strong>{{$item->province}}</strong>
                </td>
                <td>
                    <strong>Rp{{number_format($item->total)}}</strong>
                </td>
                <td>
                  @if ($item->status == 'success')
                    <center><span style="color: white;" class="btn-sm btn-success font-weight-bold mt-1 btn-block">{{$item->status}}</span>
                  @elseif ($item->status == 'delivered' || $item->status == 'verified' || $item->status == 'in delivery')
                    <center><span style="color: white;" class="btn-sm btn-warning font-weight-bold mt-1 btn-block">{{$item->status}}</span>
                  @else
                    <center><span style="color: white;" class="btn-sm btn-danger font-weight-bold mt-1 btn-block">{{$item->status}}</span>
                  @endif
                </td>
                <td>
                  <a href="/transaksi/detail/{{$item->id}}"><strong>Lihat Detail</strong></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection