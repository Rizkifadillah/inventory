<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PurchaseOrderLine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_line', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchse_order')->unsigned();
            $table->integer('produk')->unsigned();
            $table->integer('buy');

            $table->foreign('purchse_order')
            ->references('id')->on('purchse_order')
            ->onDelete('cascade');

            $table->foreign('produk')
            ->references('id')->on('m_produk')
            ->onDelete('restrict');
            
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_order_line', function (Blueprint $table) {
            //
        });
    }
}
