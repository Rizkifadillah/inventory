<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sales_line extends Model
{
    protected $table = 'sales_line';

    public function produks(){
        return $this->belongsTo('App\Model\M_produk','produk');
    }

    public function total_qty(){
        return $this->sum('qty');
     }
}
