<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase_order extends Model
{
    protected $table = 'purchse_order';

    public function suppliers(){
        return $this->belongsTo('App\Model\M_supplier','supplier');
    }

    public function statuss(){
        return $this->belongsTo('App\Model\M_status','status');
    }

    public function lines(){
        return $this->hasMany('App\Model\Purchase_order_line','purchse_order');
    }

    public function grand_total(){
        $po = $this->id;

        $total = Purchase_order_line::where('purchse_order',$po)->sum('grand_total');
        return $total;
    }
}
