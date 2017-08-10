<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('contacts', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('contact_name');
//            $table->string('phone_number1');
//            $table->string('phone_number2')->nullable();
//            $table->string('email_address')->nullable();
//            $table->integer('address_id')->unsigned()->index();
//            $table->foreign('address_id')->references('id')->on('addresses');
//            $table->integer('user_id')->unsigned()->index();
//            $table->foreign('user_id')->references('id')->on('users');
//            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('contacts');
    }
}
