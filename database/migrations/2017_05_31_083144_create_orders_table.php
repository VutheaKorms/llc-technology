<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('orders', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('order_number')->unique();
//            $table->string('transaction_date');
//            $table->integer('customer_id')->unsigned()->index();
//            $table->integer('user_role_id')->unsigned()->index();
 //           $table->foreign('user_role_id')->references('id')->on('user_roles');
//            $table->float('total_amount');
//            $table->boolean('status')->default(true);
//            $table->timestamps();
//            $table->softDeletes();
//
//            $table->foreign('customer_id')->references('id')->on('customers');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
