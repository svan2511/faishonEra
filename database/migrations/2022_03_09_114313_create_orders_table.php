<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('order_status');
            $table->string('used_coupon_code')->nullable();

            $table->string('transaction_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_id')->nullable();

            $table->string('payment_type');
            $table->integer('order_total_amount');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('placed_on')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
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
};
