<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchse_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier')->unsigned();
            $table->integer('produk')->unsigned();
            $table->integer('buy')->unsigned();
            $table->integer('qty');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchse_order', function (Blueprint $table) {
            //
        });
    }
}
