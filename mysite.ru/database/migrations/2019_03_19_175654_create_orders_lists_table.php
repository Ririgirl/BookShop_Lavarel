<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kol_vo');
            $table->integer('id_order')->unsigned();
            $table->integer('id_book')->unsigned();
            $table->foreign('id_book')->references('id')->on('books');
            $table->foreign('id_order')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_lists');
    }
}
