<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('brands', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name', 50)->unique();
//            $table->string('description', 255)->nullable();
//            $table->integer('user_id')->unsigned()->index();
//            $table->foreign('user_id')->references('id')->on('users');
//            $table->boolean('status')->default(true);
//            $table->timestamps();
//            $table->softDeletes();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('brands');
    }
}
