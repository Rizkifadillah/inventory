<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Goods_receipt;
use App\Model\M_produk;

class Gr_controller extends Controller
{
    public function index(){
        $title = 'List Goods Receipt';
        $data = Goods_receipt::orderBy('created_at','desc')->get();

        return view('gr.index',compact('title','data'
    ));

    }

    public function detail($id){
        $dt = Goods_receipt::find($id);
        $title="Detail PO $dt->document_no";

        return view('gr.detail',compact('title','dt'));
    }

    public function approved($id){
        try {
            //code...
            $data = Goods_receipt::find($id);

            if($data->status == 2){
                \Session::flash('gagal','Maaf Document ini sudah di approved \n dan sudah selesai');
                return redirect()->back();

            }

            \DB::transaction(function() use($id,$data){
                Goods_receipt::where('id',$id)->update([
                    'status'=>2
                ]);
    
                foreach($data->purchase_orders->lines as $ln){
                    $qty = $ln->qty;
                    $produk = $ln->produk;
    
                    $pd = M_produk::find($produk);
                    $stock_sekarang = $pd->stock;
                    $stock_baru = $stock_sekarang + $qty;
    
                    M_produk::where('id',$produk)->update([
                        'stock'=>$stock_baru
                    ]);
                }
            });

            \Session::flash('sukses','Data Berhasil di Approved');

        } catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }
}
