<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id('attr_id');
            $table->string("attr_image");
            $table->string("sku_number");
			$table->string("reg_price");
			$table->string("disc_price");
			$table->integer("qty");
			$table->unsignedBigInteger('product_id');
			$table->unsignedBigInteger('color_id');
			$table->unsignedBigInteger('size_id');
            $table->timestamps();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('color_id')->references('color_id')->on('colors')->onDelete('cascade');
			$table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
};
