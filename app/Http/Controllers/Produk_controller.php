<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\M_produk;
use App\Model\M_supplier;

class Produk_controller extends Controller
{
    public function index(){
        $title = 'Produk';
        $data = M_produk::orderBy('nama','asc')->get();

        return view('produk.index',compact('title','data'));

    }

    public function detail($id){
        $title = 'DetailProduk';
        $data = M_produk::find($id);

        return view('produk.detail',compact('title','data'));

    }

    public function add(){
        $title = 'Tambah Produk';
        $supplier = M_supplier::get();
        $kode = rand();

        return view('produk.add',compact('title','kode','supplier'));

    }

    public function store(Request $request){
        $this->validate($request,[
            'supplier'=>'required',
            'nama'=>'required',
            'kode'=>'required',
            'min_stock'=>'required',
            'harga'=>'required',
            'buy'=>'required'
        ]);

        // memasukan semua data dangan token
        // $data = $request->all();
        
        // memasukan datara tanpa token
        $data = $request->except(['_token']);

        //dite satu persatu data yg di butuhkan
        // $data['supplier'] = $request->supplier;
        // $data['nama'] = $request->nama;
        // $data['kode'] = $request->kode;
        $data['stock'] = 0;
        // $data['min_stock'] = $request->min_stock;
        // $data['harga'] = $request->harga;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil diitambahkan');

        M_produk::insert($data);
    
        return redirect('produk');

    }

    public function edit($id){
        $title = 'Edit Produk';
        $dt = M_produk::find($id);
        $supplier = M_supplier::get();


        return view('produk.edit',compact('title','dt','supplier'));

    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'supplier'=>'required',
            'nama'=>'required',
            'kode'=>'required',
            'min_stock'=>'required',
            'harga'=>'required',
            'buy'=>'required'
        ]);

        $data['supplier'] = $request->supplier;
        $data['nama'] = $request->nama;
        $data['kode'] = $request->kode;
        $data['min_stock'] = $request->min_stock;
        $data['buy'] = $request->buy;
        $data['harga'] = $request->harga;

        \Session::flash('sukses','Data berhasil diitambahkan');

        M_produk::where('id',$id)->update($data);

        return redirect('produk');
    }

    public function delete($id){
        try {
            M_produk::where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('produk');
    }
}
