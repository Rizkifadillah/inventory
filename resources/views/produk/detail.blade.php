@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('produk')}}" class="btn btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Back</a>
                </p>
            </div>
            <div class="box-body">
               
               <div class="table-responsive">
                    <table class="table table-stripped myTable">
                        
                        <tbody>
                            <tr>
                                <th>Kode Produk</th>
                                <td>:</td>
                                <td> {{ $data->kode}}</td>
                            </tr>
                            <tr>
                                <th>Barcode</th>
                                <td>:</td>
                                <td>
                               </tr>
                            <tr>
                                <th>QRcode</th>
                                <td>:</td>
                                <td>
                                    <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG($data->kode, 'QRCODE')}}" alt="barcode" style="width: 80px;" />
                                </td>
                            </tr>
                            <tr>

                                <th>Supplier</th>
                                <td>:</td>
                                <td> {{ $data->supplier_r->nama}}</td>
                            </tr>
                            <tr>
                                <th>Alamat Supplier</th>
                                <td>:</td>
                                <td> {{ $data->supplier_r->alamat}}</td>
                            </tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td>:</td>
                                <td> {{ $data->nama}}</td>
                            </tr>
                            <tr>
                                <th>Stock</th>
                                <td>:</td>
                                <td> {{ $data->stock}}</td>
                            </tr>
                            <tr>
                                <th> Minimal Stock</th>
                                <td>:</td>
                                <td> {{ $data->min_stock}}</td>
                            </tr>
                            <tr>
                                <th>Harga Beli</th>
                                <td>:</td>
                                <td>Rp. {{ number_format($data->buy,0)}}</td>
                            </tr>
                            <tr>
                                <th>Harga Jual</th>
                                <td>:</td>
                                <td>Rp. {{ number_format($data->harga,0)}}</td>
                            </tr>
                            <tr>
                                <th>created_at</th>
                                <td>:</td>
                                <td> {{ $data->created_at}}</td>
                            </tr>
                            <tr>
                                <th>updated_at</th>
                                <td>:</td>
                                <td> {{ $data->updated_at}}</td>
                            </tr>
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