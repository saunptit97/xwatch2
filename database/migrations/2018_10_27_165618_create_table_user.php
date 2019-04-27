<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user')) {
            Schema::create('user', function (Blueprint $table) {
                $table->increments('id');
                $table->string('username');
                $table->string('password');
                $table->string('email');
                $table->string('address');
                $table->string('phone');
                $table->string('status');
                $table->string('image');
                $table->unsignedInteger('id_role');
                $table->foreign('id_role')->references('id')->on('role');
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
        Schema::dropIfExists('user');
    }
}
