<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_bill', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_bill');
            $table->foreign('id_bill')->references('id')->on('bill');
            $table->unsignedInteger('id_p');
            $table->foreign('id_p')->references('id')->on('product');
            $table->integer('quantity');
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
        Schema::dropIfExists('detail_bill');
    }
}
