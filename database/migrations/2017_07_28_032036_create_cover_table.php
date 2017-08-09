<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('covers', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name')->nullable();
//            $table->string('size')->nullable();
//            $table->string('type')->nullable();
//            $table->string('thumb_path')->nullable();
//            $table->string('path')->nullable();
//            $table->boolean('status')->default(true);
//            $table->integer('user_role_id')->unsigned()->index();
//            $table->foreign('user_role_id')->references('id')->on('user_roles');
//            $table->timestamps();
//
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covers');
    }
}
