<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('Cart_Id');
            $table->integer('Cart_Expiry_Time');
            $table->integer('Product_Id');
            $table->integer('User_Id');
            $table->dateTime('Start_Date');
            $table->dateTime('End_Date');
            $table->integer('Full_Day')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
