<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('products', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('product_code',50)->nullable();
//            $table->string('product_name',50);
//            $table->string('product_color', 50)->nullable();
//            $table->string('description', 255)->nullable();
//            $table->float('price')->default(0);
//            $table->string('type', 50)->nullable();
//            $table->integer('category_id')->unsigned()->index();
//            $table->integer('user_role_id')->unsigned()->index();
//            $table->foreign('user_role_id')->references('id')->on('user_roles');
//            $table->boolean('status')->default(true);
//            $table->timestamps();
//            $table->softDeletes();
//;
//            $table->foreign('category_id')->references('id')->on('categories');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
