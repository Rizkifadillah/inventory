<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase_order_line extends Model
{
    protected $table = 'purchase_order_line';
    public $timestamps = false;

    public function produks(){
        return $this->belongsTo('App\Model\M_produk','produk');
    }
    public function sum_buy(){
        return $this->where('purchse_order',$this->purchse_order)->sum('buy');
    }
    public function sum_qty(){
        return $this->where('purchse_order',$this->purchse_order)->sum('qty');
    }
    public function sum_grand_total(){
        return $this->where('purchse_order',$this->purchse_order)->sum('grand_total');
    }
}
