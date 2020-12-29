<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" >
    <title>Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >

    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="row">
     <div class="col-xs-12">
        <h3>
            <center>
            <b><i>{{ $dt->document_no}}</i></b>
            </center>
        </h3>
     </div>
    </div>
    <div class="row">
     <div class="col-xs-12">
       <table class="table">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>:</td>
                    <td>{{$ph->nama}}</td>

                    <th>Vendor</th>
                    <td>:</td>
                    <td>{{$dt->suppliers->nama}}</td>
                </tr>

                <tr>
                    <th>No Tlp</th>
                    <td>:</td>
                    <td>{{$ph->no_hp}}</td>

                    <th>Tlp Vendor</th>
                    <td>:</td>
                    <td>{{$dt->suppliers->no_telp}}</td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td>{{$ph->alamat}}</td>

                    <th>Alamat Vendor</th>
                    <td>:</td>
                    <td>{{$dt->suppliers->alamat}}</td>
                </tr>
                <tr>
                    <th>Document No</th>
                    <td>:</td>
                    <td>{{$dt->document_no}}</td>

                    <th>Status</th>
                    <td>:</td>
                    <td>{{$dt->statuss->nama}}</td>
                </tr>
            </tbody>
       </table>
     </div>
    </div>
    <hr>

    <div class="row">
     <div class="col-xs-12">
       <table class="table">
           <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Buy</th>
                    <th>Grand Total</th>
                </tr>
           </thead>
           <tbody>
                <?php
                    $tot_qty = 0;
                    $tot_buy= 0;
                    $tot_grand_total=0;
                ?>
                @foreach($dt->lines as $e => $ln)
                    <tr>
                        <td>{{ $e+1 }}</td>
                        <td>{{ $ln->produks->nama }}</td>
                        <td>{{$ln->qty }}</td>
                        <td>{{$ln->buy }}</td>
                        <td>{{$ln->grand_total }}</td>
                    </tr>

                    <?php
                    $tot_qty += $ln->qty;
                    $tot_buy += $ln->buy;
                    $tot_grand_total += $ln->grand_total;
                ?>
                @endforeach
           </tbody>
                <hr>
           <tfoot>
                <tr>
                    <th></th>
                    <th>
                        <b><i>Total</i></b>
                    </th>
                    <th>
                        <b><i>{{ $tot_qty}}</i></b>
                    </th>
                    <th>
                        <b><i>{{ $tot_buy}}</i></b>
                    </th>
                    <th>
                        <b><i>{{ $tot_grand_total}}</i></b>
                    </th>
                </tr>
           </tfoot>
       </table>
     </div>
    </div>

    <div class="row">
     <div class="col-xs-4">
        
        <br><br><br><br><br>
        <center>
            <p>Menyetujui</p>
            <br><br><br><br><br>
            ---------------
        </center>
        
     </div>
     <div class="col-xs-4">
        
        <br><br><br><br><br>
        <center>
            <p>Menerima</p>
            <br><br><br><br><br>
            ---------------
        </center>
        
     </div>
     <div class="col-xs-4">
        
        <br><br><br><br><br>
        <center>
            <p>Mengirim</p>
            <br><br><br><br><br>
            ---------------
        </center>
        
     </div>
    </div>
   
</body>
</html>