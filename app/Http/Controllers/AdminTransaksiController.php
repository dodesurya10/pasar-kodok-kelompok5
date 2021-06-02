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
use Illuminate\Support\Facades\Auth;


class AdminTransaksiController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index(){
        $transaksi = Transaction::orderBy('id','DESC')->get();
        return view('admin.transaksi', ['transaksi' => $transaksi]);
    }

    public function filterBulan(Request $request){
        $transaksi = transaction::whereMonth('created_at','=', $request->bulan)->whereYear('created_at','=', $request->tahun)->get();
        $status = ['unverified' => 0,'expired' => 0, 'canceled' => 0, 'verified' => 0, 'delivered' => 0, 'success' => 0, 'harga' => 0, 'total' => $transaksi->count()];
        $status['unverified'] = $this->findCountStatus('unverified',$request->bulan,$request->tahun,1);
        $status['expired'] = $this->findCountStatus('expired',$request->bulan,$request->tahun,1);
        $status['canceled'] = $this->findCountStatus('canceled',$request->bulan,$request->tahun,1);
        $status['verified'] = $this->findCountStatus('verified',$request->bulan,$request->tahun,1);
        $status['delivered'] = $this->findCountStatus('delivered',$request->bulan,$request->tahun,1);
        $status['success'] = $this->findCountStatus('success',$request->bulan,$request->tahun,1);

        foreach($transaksi as $item){
            if($item->status == 'verified' || $item->status == 'delivered' || $item->status == 'success'){
                $status['harga'] = $status['harga'] + $item->total;
            }
        }

        return response()->json(['success' => 'berhasil', 'data' => $status]);
    }

    public function filterTahun(Request $request){
        $transaksi_bulan = transaction::whereMonth('created_at','=', $request->bulan)->whereYear('created_at','=', $request->tahun)->get();
        $status_bulan = ['unverified' => 0,'expired' => 0, 'canceled' => 0, 'verified' => 0, 'delivered' => 0, 'success' => 0, 'harga' => 0, 'total' => $transaksi_bulan->count()];
        $status_bulan['unverified'] = $this->findCountStatus('unverified',$request->bulan,$request->tahun,1);
        $status_bulan['expired'] = $this->findCountStatus('expired',$request->bulan,$request->tahun,1);
        $status_bulan['canceled'] = $this->findCountStatus('canceled',$request->bulan,$request->tahun,1);
        $status_bulan['verified'] = $this->findCountStatus('verified',$request->bulan,$request->tahun,1);
        $status_bulan['delivered'] = $this->findCountStatus('delivered',$request->bulan,$request->tahun,1);
        $status_bulan['success'] = $this->findCountStatus('success',$request->bulan,$request->tahun,1);

        foreach($transaksi_bulan as $item){
            if($item->status == 'verified' || $item->status == 'delivered' || $item->status == 'success'){
                $status_bulan['harga'] = $status_bulan['harga'] + $item->total;
            }
        }

        $transaksi = transaction::whereYear('created_at','=', $request->tahun)->get();
        $status = ['unverified' => 0,'expired' => 0, 'canceled' => 0, 'verified' => 0, 'delivered' => 0, 'success' => 0, 'harga' => 0, 'total' => $transaksi->count()];
        $status['unverified'] = $this->findCountStatus('unverified',$request->bulan,$request->tahun,2);
        $status['expired'] = $this->findCountStatus('expired',$request->bulan,$request->tahun,2);
        $status['canceled'] = $this->findCountStatus('canceled',$request->bulan,$request->tahun,2);
        $status['verified'] = $this->findCountStatus('verified',$request->bulan,$request->tahun,2);
        $status['delivered'] = $this->findCountStatus('delivered',$request->bulan,$request->tahun,2);
        $status['success'] = $this->findCountStatus('success',$request->bulan,$request->tahun,2);

        foreach($transaksi as $item){
            if($item->status == 'verified' || $item->status == 'delivered' || $item->status == 'success'){
                $status['harga'] = $status['harga'] + $item->total;
            }
        }

        for($i = 1;$i<=12;$i++){
            $tahun[$i] = transaction::whereMonth('created_at','=', $i)->whereYear('created_at','=', $request->tahun)->count();
        }

        return response()->json(['success' => 'berhasil', 'data' => $status, 'data_bulan' =>$status_bulan, 'tahun' => $tahun]);
    }



    public function findCountStatus($status, $bulan, $tahun, $cek)
    {
        if($cek == 1){
            $count = transaction::whereMonth('created_at','=', $bulan)->whereYear('created_at','=', $tahun)->where('status','=',$status)->count();
        }else{
            $count = transaction::whereYear('created_at','=', $tahun)->where('status','=',$status)->count();
        }
        return $count;
    }

    public function grafik(Request $request){
        if($request->status == 'all'){
            for($i = 1;$i<=12;$i++){
                $grafik[$i] = transaction::whereMonth('created_at','=', $i)->whereYear('created_at','=', $request->tahun)->count();
            }
        }else{
            for($i = 1;$i<=12;$i++){
                $grafik[$i] = transaction::whereMonth('created_at','=', $i)->whereYear('created_at','=', $request->tahun)->where('status', '=', $request->status)->count();
            }
        }   
        return response()->json(['success' => 'berhasil', 'grafik' => $grafik]);
    }
}
