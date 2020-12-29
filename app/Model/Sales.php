<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';

    public function total_jumlah_bayar($dari,$sampai){
       return $this->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->sum('jumlah_bayar');

    }
    public function total_kembalian($dari,$sampai){
        return $this->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->sum('kembalian');
 
     }
     public function jumlah_grand_total($dari,$sampai){
        return $this->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->sum('grand_total');
     }

     public function lines(){
         return $this->hasMany('App\Model\Sales_line','sales');
     }
}
