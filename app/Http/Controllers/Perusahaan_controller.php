<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Perusahaan;

class Perusahaan_controller extends Controller
{
    public function index(){
        $title = 'Update Perusahaan';
        $dt = Perusahaan::first();
   
        return view('perusahaan.index',compact('title','dt'));
    }

    public function update(Request $request){
        try {
            //code...
            $dt = Perusahaan::first();

            $a = $request->except(['_token','_method']);
            $a['updated_at'] = date('Y-m-d H:i:s');

            Perusahaan::where('id',$dt->id)->update($a);

            \Session::flash('sukses','Update Berhasil');
        } catch (\Exception $e) {
            //throw $th;
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }

    public function update2(Request $request,$id){
        $this->validate($request,[
            'nama'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
            'email'=>'required',
            'created_at'=>'required'
        ]);

        $data['nama'] = $request->nama;
        $data['no_hp'] = $request->no_hp;
        $data['alamat'] = $request->alamat;
        $data['email'] = $request->emial;
        // $data['created_at'] = $request->date('Y-m-d H:i:s');
        $data['updated_at'] = $request->date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil diitambahkan');

        Perusahaan::where('id',$id)->update($data);

        return redirect('produk');
    }

}
