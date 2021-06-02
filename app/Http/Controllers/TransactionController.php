<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Transaction_Detail;
use App\Province;
use App\City;
use App\Cart;
use App\Product;
use App\Admin;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        $provinsi = Province::find($request->province);
        $kota = City::where('city_id','=',$request->regency)->first();
        $transaksi = new Transaction;
        date_default_timezone_set("Asia/Makassar");
        $transaksi->timeout = date('Y-m-d H:i:s', strtotime('+1 days'));
        $transaksi->address = $request->address;
        $transaksi->regency = $kota->title;
        $transaksi->province = $provinsi->title;
        $transaksi->total = $request->total;
        $transaksi->shipping_cost = $request->shipping_cost;
        $transaksi->sub_total = $request->sub_total;
        $transaksi->user_id = $request->user_id;
        $transaksi->courier_id = $request->courier;
        $transaksi->status = 'unverified';
        $transaksi->telp = $request->no_telp;
        $transaksi->save();
        $admin = Admin::find(1);
        $notif = "<a class='dropdown-item' href='/admin/transaksi/detail/".$transaksi->id."'>".
                "<div class='item-content flex-grow'>".
                  "<h6 class='ellipsis font-weight-normal'>".Auth::user()->name."</h6>".
                  "<p class='font-weight-light small-text text-muted mb-0'>Ada Transaksi Baru".
                  "</p>".
                "</div>".
              "</a>";
        $admin->notify(new AdminNotification($notif));
        
        if($request->product_id != 0){
            $detail_transaksi = new Transaction_Detail;
            $detail_transaksi->transaction_id = $transaksi->id;
            $detail_transaksi->product_id = $request->product_id;
            $detail_transaksi->qty = $request->qty;
            $produk = Product::with('discount')->find($request->product_id);
            if($produk->discount->count()){
                foreach($produk->discount as $diskon){
                    if($diskon->end > date('Y-m-d')){
                        $detail_transaksi->discount = $diskon->percentage;
                    }else{
                        $detail_transaksi->discount = 0;
                    }
                }
            }else{
                $detail_transaksi->discount = 0;
            }
            $detail_transaksi->selling_price = $produk->price;
            $detail_transaksi->save();
        }else{
            $cart = Cart::with(['product' => function($q){
                $q->with('product_image','discount');
            }])->where('user_id', '=', $request->user_id)->where('status', '=', 'notyet')->get();
    
            foreach($cart as $item){
                $detail_transaksi = new Transaction_Detail;
                $detail_transaksi->transaction_id = $transaksi->id;
                $detail_transaksi->product_id = $item->product->id;
                $detail_transaksi->qty = $item->qty;
                if($item->product->discount->count()){
                    foreach($item->product->discount as $diskon){
                        if($diskon->end > date('Y-m-d')){
                            $detail_transaksi->discount = $diskon->percentage;
                        }else{
                            $detail_transaksi->discount = 0;
                        }
                    }
                }else{
                    $detail_transaksi->discount = 0;
                }
                $detail_transaksi->selling_price = $item->product->price;
                $detail_transaksi->save();
    
                $item->status = 'checkedout';
                $item->save();
            }
        }

        return redirect('/transaksi/'.$request->user_id);
    }

    public function index($id){
        if(is_null(Auth::user())){
            return redirect('/login');
        }elseif(Auth::user()->id != $id){
            return abort(404);
        }else{
            $transaksi = Transaction::orderBy('id', 'DESC')->where('user_id','=',$id)->get();
            foreach($transaksi as $item){
                if($item->timeout < date('Y-m-d H:i:s') & $item->status == 'unverified'){
                    $item->status = 'expired';
                    $item->save();
                }
            }
            return view('user.transaksi', ['transaksi' => $transaksi]);
        }
    }
}
