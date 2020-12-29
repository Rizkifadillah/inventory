@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('produk/add')}}" class="btn btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Tambah</a>
                </p>
            </div>
            <div class="box-body">
               
               <div class="table-responsive">
                    <table class="table table-hover myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Supplier</th>
                                <th>Nama</th>
                                <th>Kode</th>
                                <th>Stock</th>
                                <th>Min. Stock</th>
                                <th>Beli</th>
                                <th>Jual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $e=>$dt)
                            <tr>
                                <td>{{$e+1}}</td>
                                <td>
                                <div style="width:60px">
                                    <a href="{{ url('produk/'.$dt->id)}}" id-produk="'.$id.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ url('produk/'.$dt->id)}}" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></a></div>
                                    <a href="{{ url('produk/detail/'.$dt->id)}}" id-produk="'.$id.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-eye"></i></a>
                                </td>
                                <td> {{ $dt->supplier_r->nama}}</td>
                                <td> {{ $dt->nama}}</td>
                                <td> {{ $dt->kode}}</td>
                                <td> {{ $dt->stock}}</td>
                                <td> {{ $dt->min_stock}}</td>
                                <td>Rp. {{ number_format($dt->buy,0)}}</td>
                                <td>Rp. {{ number_format($dt->harga,0)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>

            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection