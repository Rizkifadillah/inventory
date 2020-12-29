
@extends('layouts.master')
 
 @section('content')
  
 <div class="row">
     <div class="col-md-12">
         <h4>{{ $title }}</h4>
         <div class="box box-warning">
             <div class="box-header">
                 <p>
                     <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                     <a href="{{ url('update-perusahaan')}}" class="btn btn-sm btn-flat btn-primary "><i class="fa fa-plus"></i> Back</a>
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
                

             <form role="form" method="post" action="{{url('update-perusahaan2')}}">
             @csrf
              <div class="box-body">


                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Perusahaan</label>
                  <input type="text" name="nama" value="{{$dt->nama}}" class="form-control" id="exampleInputEmail1" placeholder="Nama Produk">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Telphone</label>
                  <input type="number" value="{{$dt->no_hp}}" name="no_hp" class="form-control" id="exampleInputPassword1" placeholder="Kode">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat</label>
                  <input type="text" name="alamat" value="{{$dt->alamat}}" class="form-control" id="exampleInputPassword1" placeholder="Min. Stock">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input type="email" name="email" value="{{$dt->email}}" class="form-control" id="exampleInputPassword1" placeholder="Harga Beli">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Tahun Berdiri</label>
                  <input type="text"  value="{{date('y-M-d',strtotime($dt->created_at))}}" class="form-control" id="exampleInputPassword1" placeholder="Harga Jual">
                </div>

              </div>
              <!-- /.box-body -->
 
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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