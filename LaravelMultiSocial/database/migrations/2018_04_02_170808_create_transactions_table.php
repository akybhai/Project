<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('booking_id');
            $table->integer('product_id');
            $table->integer('user_id');
        //    $table->integer('collect_user_id')->nullable();
            $table->string('collect_user_mob')->nullable();
            $table->string('collect_user_name')->nullable();
            $table->string('staff_incharge_collect_name')->nullable();
            $table->string('staff_incharge_return_name')->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('Full_Day')->default(1);
            $table->datetime('return_date')->nullable();
            $table->string('booking_reason')->nullable();
	    $table->string('society')->nullable();
            $table->string('booking_status');
            $table->string('comment')->nullable();
            $table->string('return_comment')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
