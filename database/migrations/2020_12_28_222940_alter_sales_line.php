<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSalesLine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_line', function (Blueprint $table) {
            $table->foreign('sales')
            ->references('id')->on('sales')
            ->onDelete('cascade');

            $table->foreign('produk')
            ->references('id')->on('m_produk')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_line', function (Blueprint $table) {
            //
        });
    }
}
