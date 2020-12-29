<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class M_produk extends Model
{
    protected $table = 'm_produk';

    public function supplier_r(){
        return $this->belongsTo('App\Model\M_supplier','supplier','id');
    }
}
