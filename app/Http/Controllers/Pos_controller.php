<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\M_produk;
use App\Model\Sales;
use App\Model\Sales_line;

class Pos_controller extends Controller
{
    public function index(){
        $title = "POS / Penjualan Barang";

        return view('pos.index',compact('title'));
    }

    public function get_produk($kode){
        $dt = M_produk::where('kode',$kode)->first();

        return response()->json([
            'data'=>$dt
        ]);
    }

    public function store(Request $request){
        try {
            //code...
            $produk = $request->produk;
            $qty = $request->qty;
            $harga = $request->harga;
            $grand_total = $request->grand_total;
            $jumlah_bayar = $request->jumlah_bayar;

            $total_qty = array_sum($qty);
            $total_harga = array_sum($harga);
            $total_bayar = $total_qty * $total_harga;

            $kembalian = $jumlah_bayar - $total_bayar;

            if ($jumlah_bayar < $total_bayar) {
                # code...
                $kurangnya = $total_bayar - $jumlah_bayar;
                \Session::flash('gagal','Uang anda kurang Rp. '.number_format($kurangnya,0));

                return redirect()->back();

            }

            \DB::transaction(function()use($produk,$qty,$harga,$jumlah_bayar){
                $header =Sales::insertGetId([
                    'no_struk'=>rand(),
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
                
                foreach($produk as $e=>$pd){
                    Sales_line::insert([
                        'sales'=>$header,
                        'produk'=>$pd,
                        'harga'=>$harga[$e],
                        'qty'=>$qty[$e],
                        'grand_total'=>(Int)$qty[$e] * (Int)$harga[$e]
                    ]);
                    $dt =M_produk::find($pd);
                    $qty_now = $dt->stock;
                    $qty_new = $qty_now - $qty[$e];
                    M_produk::where('id',$pd)->update([
                        'stock'=>$qty_new
                    ]);
                }
                $sum_total = Sales_line::where('sales',$header)->sum('grand_total');
                $kembalian = $jumlah_bayar - $sum_total;
                Sales::where('id',$header)->update([
                    'grand_total'=>$sum_total,
                    'jumlah_bayar'=>$jumlah_bayar,
                    'kembalian'=>$kembalian
                ]);
            });
            \Session::flash('sukses','Kembalian Rp. '.number_format($kembalian,0));

        } catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }
}
