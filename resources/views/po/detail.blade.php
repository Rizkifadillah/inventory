@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('po')}}" class="btn btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Back</a>
                    <a target="_blank" href="{{ url('po/pdf/'.$dt->id)}}" class="btn btn-sm btn-flat btn-success "><i class="fa fa-download"></i> Export PDF</a>
                </p>
            </div>
            <div class="box-body">
               
               <div class="col-md-6 table-responsive">
                    <table class="table table-stripped myTable">
                        
                        <tbody>
                            <tr>
                                <th>Document No</th>
                                <td>:</td>
                                <td> {{$dt->document_no}}</td>

                                <th>Supplier</th>
                                <td>:</td>
                                <td> {{$dt->suppliers->nama}}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                @if($dt->status ==1 )
                                <td>
                                    <label class="label label-warning ">{{ $dt->statuss->nama}}</label>
                                </td>
                                @else
                                <td>
                                    <label class="label label-success ">{{ $dt->statuss->nama}}</label>
                                </td>
                                @endif
                                
                                <th>Created_at</th>
                                <td>:</td>
                                <td> {{ date('d M Y', strtotime($dt->created_at))}}</td>
                            </tr>       
                        </tbody>
                    </table>
               </div>

               <div class="col-md-6 pull-right">
                   <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG($dt->document_no, 'QRCODE')}}" alt="barcode" style="width: 80px;" />
               </div>
                <form method="post" action="{{ url('po/'.$dt->id) }}">
                @csrf
                {{method_field('put')}}
                    <div class ="row">
                            <div class="col-md-12">
                                <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Harga Beli</th>
                                        <th>Total Harga</th>
                                        <th>Delete</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $total_qty = 0;
                                        $total_buy = 0;
                                        $total = 0;
                                    ?>
                                    @foreach($dt->lines as $e=>$ln)
                                    <?php
                                        $total_qty += $ln->qty;
                                        $total_buy += $ln->buy;
                                        $total += $ln->grand_total;
                                    ?>
                                        <tr>
                                            <td>{{$e+1}}</td>
                                            <td> {{ $ln->produks->nama}}</td>
                                            @if($dt->status != 2)
                                            <td>
                                                <input type="number" name="qty[]" value="{{ $ln->qty}}" class="form-control" id="exampleInputPassword1" placeholder="Harga Jual">
                                                <input type="hidden" name="id_line[]" value="{{$ln->id}}">
                                                <input type="hidden" name="produk[]" value="{{$ln->produk}}">
                                            </td>
                                            @else
                                                <td>{{ $ln->qty }}</td>
                                            @endif

                                            @if($dt->status != 2)
                                            <td>
                                                <input type="number" name="buy[]" value="{{ $ln->buy}}" class="form-control" id="exampleInputPassword1" placeholder="Harga Jual">
                                            <!-- Rp. {{ number_format($ln->buy)}} -->
                                            </td>
                                            @else
                                                <td> Rp. {{ number_format($ln->buy)}} </td>
                                            @endif
                                            <td>Rp. {{ number_format($ln->grand_total)}}</td>
                                            <td>
                                                <a href="{{ url('/po/line/'.$ln->id)}}" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            <b>Jumlah</b>
                                        </th>
                                        <th>
                                            <b>{{$total_qty}}</b>
                                        </th>
                                        <th>
                                            <b>Rp. {{number_format($total_buy)}}</b>
                                        </th>
                                        <th>
                                            <b>Rp. {{number_format($total)}}</b>
                                        </th>
                                    </tr>
                                </tfoot>
                                </table>
                            </div>
                    </div>
                    @if($dt->status != 2)
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="box box-success">
            
            <div class="box-body">
               

               <div class ="row">
                    <div class="col-md-12">
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Harga Beli</th>
                                <th>Total Harga</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dt->lines as $e=>$ln)
                                <tr>
                                    <td>{{$e+1}}</td>
                                    <td> {{ $ln->produks->nama}}</td>
                                    <td> {{ $ln->qty}}</td>
                                    <td>Rp. {{ number_format($ln->buy)}}</td>
                                    <td>Rp. {{ number_format($ln->grand_total)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
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