<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_struk',115);
            $table->integer('produk')->unsigned();
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('grand_total');
            $table->timestamps();

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
        Schema::table('sales', function (Blueprint $table) {
            //
        });
    }
}
