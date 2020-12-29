
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
                     @if ($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                 </p>
             </div>
             <div class="box-body">
                

             <form role="form" method="post" action="{{url('produk/'.$dt->id)}}">
             @csrf
             {{ method_field('put')}}
              <div class="box-body">

              <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Supplier</label>
                    <select class="form-control select2" name="supplier" id="">
                        @foreach($supplier as $sp)
                        <option value="{{ $sp->id}}" {{ ($dt->supplier == $sp->id) ? 'selected' : ''}} >{{$sp->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Produk</label>
                  <input type="text" name="nama" value="{{$dt->nama}}" class="form-control" id="exampleInputEmail1" placeholder="Nama Produk">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Kode</label>
                  <input type="text" value="{{$dt->kode}}" name="kode" class="form-control" id="exampleInputPassword1" placeholder="Kode">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Min. Stock</label>
                  <input type="number" name="min_stock" value="{{$dt->min_stock}}" class="form-control" id="exampleInputPassword1" placeholder="Min. Stock">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Harga Beli</label>
                  <input type="number" name="buy" value="{{$dt->buy}}" class="form-control" id="exampleInputPassword1" placeholder="Harga Beli">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Harga Jual</label>
                  <input type="number" name="harga" value="{{$dt->harga}}" class="form-control" id="exampleInputPassword1" placeholder="Harga Jual">
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
  
     })
 </script>
  
 @endsection