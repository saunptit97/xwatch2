<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('product')){
            Schema::create('product', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->double('price');
                $table->string('image');
                $table->string('description');
                $table->string('detail');
                $table->integer('quantity');
                $table->unsignedInteger('id_brand');
                $table->foreign('id_brand')->references('id')->on('brand');
                $table->unsignedInteger('id_cat');
                $table->foreign('id_cat')->references('id')->on('category');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
