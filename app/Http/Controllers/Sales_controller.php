<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Sales;

use App\Model\Sales_line;

class Sales_controller extends Controller
{
    public function index(){
        $title = 'History Transaksi Penjualan';
        $data = Sales::withCount('lines')->orderBy('created_at','desc')->get();
        $dt = Sales_line::get('qty');

        $dari = date('Y-m-d',strtotime('-1 days'));
        $sampai = date('Y-m-d');

        return view('sales.index',compact('title','dt','data','dari','sampai'));
    }

    public function detail($id){
        $dt = Sales::find($id);
        $title = 'Detail transaksi :'. $dt->no_struk;

        return view('sales.detail',compact('title','dt'));

    }

    public function periode(Request $request){
        try {
            //code...
            $title = 'History Transaksi Pesanan dari $dari sampai $sampai';
 
            $dari = $request->dari;
            $sampai = $request->sampai;
 
            $data = Sales::whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->orderBy('created_at','desc')->get();
 
            \Session::flash('sukses','Transaksi berhasil difilter');
 
            return view('sales.index',compact('title','data','dari','sampai'));
 
 
        } catch (\Throwable $th) {
            //throw $th;
            \Session::flash('gagal','Transaksi berhasil diitambahkan');
 
            return redirect()->back();
 
        }
     }
}
