@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="#" class="btn btn-sm btn-flat btn-primary btn-filter "><i class="fa fa-filter"></i> Filter Tanggal</a>
                </p>
            </div>
            <div class="box-body">
               
               <div class="table-responsive">
                    <table class="table table-hover myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Detail</th>
                                <th>No Struk</th>
                                <th>Qty</th>
                                <th>Jumlah Bayar</th>
                                <th>Kembalian</th>
                                <th>Grand Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $e=>$dt)
                            <tr>
                                <td>{{$e+1}}</td>
                                <td>
                                <a href="{{ url('sales/detail/'.$dt->id)}}" id-produk="'.$id.'" class="btn btn-success btn-xs btn-edit" id="detail"><i class="fa fa-eye"></i>Detail</a>
                                </td>
                                <td> {{ $dt->no_struk}}</td>
                                <td> {{ $dt->lines_count}}</td>
                                <td>Rp. {{ number_format($dt->jumlah_bayar,0)}}</td>
                                <td>Rp. {{ number_format($dt->kembalian,0)}}</td>
                                <td>Rp. {{ number_format($dt->grand_total,0)}}</td>
                                <td> {{date('d M Y H:i:s',strtotime( $dt->created_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <td> {{ $dt->qty}}</td>
                                <th>
                                    <b><i>Rp. {{ number_format($dt->total_jumlah_bayar($dari,$sampai),0)}}</i></b>
                                </th>
                                <th>
                                    <b><i>Rp. {{ number_format($dt->total_kembalian($dari,$sampai),0)}}</i></b>
                                </th>
                                <th>
                                    <b><i>Rp. {{ number_format($dt->jumlah_grand_total($dari,$sampai),0)}}</i></b>
                                </th>
                                <th>
                                    <b><i>{{date('d M Y H:i:s')}}</i></b>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
               </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
 
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
 
          <div class="modal-body">
 
          <form role="form" method="get" action="{{ url('sales/periode')}}">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Dari</label>
              <input type="text" class="form-control datepicker" id="exampleInputEmail1" placeholder="Dari" autocomplete="off" name="dari" value="{{ date('Y-m-d')}}">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Sampai</label>
              <input type="text" name="sampai" class="form-control datepicker" id="exampleInputPassword1" placeholder="Sampai" autocomplete="off" value="{{ date('Y-m-d')}}">
            </div>
          </div>
          <!-- /.box-body -->
 
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
 
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
        $('.btn-filter').click(function(e){
            e.preventDefault();
            $('#modal-filter').modal();
        })
 
    })
</script>
 
@endsection