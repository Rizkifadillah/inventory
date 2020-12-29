<?php

namespace App\Model;

use App\Model\Purchase_order_line;
use Illuminate\Database\Eloquent\Model;

class Goods_receipt extends Model
{
    protected $table = 'goods_receipt';

    public function statuss(){
        return $this->belongsTo('App\Model\M_status','status');
    }
    public function purchase_orders(){
        return $this->belongsTo('App\Model\Purchase_order','purchse_order');
    }
    public function total_item(){
        $id_po= $this->purchse_order;
        $total = Purchase_order_line::where('purchse_order',$id_po)->count();
        return $total;
    }
}
