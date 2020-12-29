<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\M_supplier;

class Supplier_controller extends Controller
{
    public function index(){
        $title = 'Supplier';
        $data = M_supplier::orderBy('nama','asc')->get();

        return view('supplier.index',compact('title','data'));

    }

    public function add(){
        $title = 'Tambah Supplier';

        return view('supplier.add',compact('title'));

    }

    public function store(Request $request){
        $this->validate($request,[
            'nama'=>'required',
            'no_telp'=>'required',
            'alamat'=>'required'
        ]);
        $data['nama'] = $request->nama;
        $data['no_telp'] = $request->no_telp;
        $data['alamat'] = $request->alamat;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil diitambahkan');

        M_supplier::insert($data);
    
        return redirect('supplier');

    }
    
    public function edit($id){
        $title = 'Edit Supplier';
        $dt = M_supplier::find($id);


        return view('supplier.edit',compact('title','dt'));

    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'nama'=>'required',
            'no_telp'=>'required',
            'alamat'=>'required'
        ]);
        $data['nama'] = $request->nama;
        $data['no_telp'] = $request->no_telp;
        $data['alamat'] = $request->alamat;

        \Session::flash('sukses','Data berhasil diitambahkan');

        M_supplier::where('id',$id)->update($data);

        return redirect('supplier');
    }

    public function delete($id){
        try {
            M_supplier::where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('supplier');
    }
}

