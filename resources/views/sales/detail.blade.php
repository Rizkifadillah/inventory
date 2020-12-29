@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('sales')}}" class="btn btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Back</a>
                </p>
            </div>
            <div class="box-body">
               
               <div class="table-responsive">
                    <table class="table table-stripped myTable">
                        
                    <tbody>
                            <tr>
                                <th>No Struk</th>
                                <td>:</td>
                                <td> {{ $dt->no_struk}}</td>
                                <th>Jumlah Bayar</th>
                                <td>:</td>
                                <td>Rp. {{number_format($dt->jumlah_bayar,0)}}</td>
                            </tr>
                            <tr>
                                <th>Kembalian</th>
                                <td>:</td>
                                <td>Rp. {{number_format($dt->kembalian,0)}}</td>
                                <th>Grand Total</th>
                                <td>:</td>
                                <td>Rp. {{number_format($dt->grand_total,0)}}</td>
                            </tr>
                           
                        </tbody>
                    </table>
               </div>
<br><br>
               <div class="table-responsive">
                    <table class="table table-stripped ">
                        
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Sub Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dt->lines as $ln)
                            <tr>
                                <td>{{ $ln->produks->nama}}</td>
                                <td>Rp.{{number_format( $ln->harga)}}</td>
                                <td>{{$ln->qty}}</td>
                                <td>Rp.{{number_format( $ln->grand_total)}}</td>
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