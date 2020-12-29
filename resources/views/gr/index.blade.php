@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('gr/add')}}" class="btn btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Tambah</a>
                </p>
            </div>
            <div class="box-body">
               
               <div class="table-responsive">
                    <table class="table table-stripped myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Action</th>
                                <th>Document Number</th>
                                <th>Total Item</th>
                                <th>Total Nilai</th>
                                <th>Status</th>
                                <th>Created_at</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $e=>$dt)
                            <tr>
                                <td>{{$e+1}}</td>
                                <td>
                                    <a href="{{ url('gr/detail/'.$dt->id)}}" id-produk="'.$id.'" class="btn btn-success btn-xs btn-edit" id="edit"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('po/'.$dt->id)}}" id-produk="'.$id.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ url('po/'.$dt->id)}}" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></a>
                                   
                                </td>
                                <td> {{ $dt->document_no}}</td>
                                <td> {{ $dt->total_item()}}</td>
                                <td>Rp. {{ number_format($dt->purchase_orders->grand_total())}}</td>

                                @if($dt->status ==1 )
                                <td>
                                    <label class="label label-warning ">{{ $dt->statuss->nama}}</label>
                                </td>
                                @else
                                <td>
                                    <label class="label label-success ">{{ $dt->statuss->nama}}</label>
                                </td>
                                @endif
                                <td> {{ date('d M Y', strtotime($dt->created_at))}}</td>
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