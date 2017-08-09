<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('categories', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name',50)->unique();
//            $table->string('description', 255)->nullable();
//            $table->integer('brand_id')->unsigned()->index();
//            $table->foreign('brand_id')->references('id')->on('brands');
//            $table->integer('user_role_id')->unsigned()->index();
//            $table->foreign('user_role_id')->references('id')->on('user_roles');
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
        Schema::dropIfExists('categories');
    }
}
