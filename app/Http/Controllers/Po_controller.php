<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\M_supplier;
use App\Model\M_produk;
use App\Model\Perusahaan;
use App\Model\Goods_receipt;
use App\Model\Purchase_order;
use App\Model\Purchase_order_line;

use PDF;


class Po_controller extends Controller
{
    public function index(){
        $title = 'PO';
        // $doc= "PO-".rand();
        // $supplier = M_supplier::orderBy('nama','asc')->get();
        $data = Purchase_order::withCount('lines')->orderBy('created_at','asc')->get();

        return view('po.index',compact('title','data'
        // ,'doc','supplier'
    ));

    }

    public function pdf($id){
        try {
            //code...
            $dt= Purchase_order::with('suppliers')->find($id);
            $ph= Perusahaan::first();

            $pdf = PDF::loadView('po.pdf',compact('dt','ph'))->setPaper('a4','landscape');
            return $pdf->stream();

            \Session::flash('sukses','Data berhasil di PDF');

        } catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal', $e->getMessage().' ! '.$e->getLine());

        }
        return redirect()->back();
        
    }
    
    public function add(){
        $title = 'Tambah PO';
        $doc= "PO-".rand();
        $supplier = M_supplier::orderBy('nama','asc')->get();
        // $data = M_produk::orderBy('nama','asc')->get();

        return view('po.add',compact('title','doc','supplier'));

    }

    public function store(Request $request){
        try {
            //code...
            $produk = $request->produk;
            $qty = $request->qty;

            $document_no = $request->document_no;
            $supplier = $request->supplier;

            $id_po = Purchase_order::insertGetId([
                'document_no'=>$document_no,
                'supplier'=>$supplier,
                'status'=>1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ]);

            foreach($qty as $e=>$qt){
                if($qt == 0){
                    continue;
                }

                $dt_produk= M_produk::where('id',$produk[$e])->first();
                $buy = $dt_produk->buy;
                $grand_total = $qt * $buy;

                Purchase_order_line::insert([
                    'purchse_order'=>$id_po,
                    'produk'=>$produk[$e],
                    'qty'=>$qt,
                    'buy'=>$buy,
                    'grand_total'=>$grand_total
                ]);
            }
            \Session::flash('sukses','PO berhasil ditambahkan');

        } catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal',$e->getMessage());
        }

        return redirect('po');

    }

    public function get_produk($id_supplier){
        $title = 'Tambah PO';
        $doc= "PO-".rand();
        $supplier = M_supplier::orderBy('nama','asc')->get();
        $produk = M_produk::where('supplier',$id_supplier)->get();

        return view('po.add',compact('title','doc','supplier','produk','id_supplier'));

    }

    public function approved($id){
        try {
            //code...
            $po = Purchase_order::find($id);
            Purchase_order::where('id',$id)->update([
                'status'=>2
            ]);

            Goods_receipt::where('purchse_order',$id)->delete();

            Goods_receipt::insert([
                'purchse_order'=>$id,
                'document_no'=>'GR-'.rand(),
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);

            \Session::flash('sukses','Status PO berhasil approved');

        } catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal',$e->getMessage());

        }
        return redirect()->back();
    }

    public function detail($id){
        $dt = Purchase_order::find($id);
        $title="Detail PO $dt->document_no";

        return view('po.detail',compact('title','dt'));
    }

    public function hapus_line($id){
        try {
            //code...
            Purchase_order_line::where('id',$id)->delete();

            \Session::flash('sukses','Status PO berhasil dihapus');

        }  catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }

    public function update(Request $request){
        try {
            //code...
            $qty = $request->qty;
            $id_line = $request->id_line;
            $buy = $request->buy;
            $produk = $request->produk;

            foreach($qty as $e => $dt){
                $data['qty'] = $dt;
                $data['grand_total'] = $dt * $buy[$e];
                $data['buy'] = $buy[$e];
                $line = $id_line[$e];

                Purchase_order_line::where('id',$line)->update($data);
                
                M_produk::where('id',$produk[$e])->update([
                    'buy'=>$data['buy']
                ]);
            }
            \Session::flash('sukses','Status PO berhasil di ubah');

        } catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();

    }
}
