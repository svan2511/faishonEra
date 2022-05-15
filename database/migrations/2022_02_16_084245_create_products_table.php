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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string("product_image");
            $table->unsignedBigInteger('product_cat_id');
            $table->unsignedBigInteger('product_sub_cat_id');
			$table->string("product_title");
			$table->string("product_brand");
			$table->string("pro_slug");
			$table->longText("shrt_desc");
			$table->text("full_desc");
			$table->text("tech_spec");
			$table->integer("pro_status");
            $table->integer("is_featured")->default(0);
            $table->integer("is_discounted")->default(0);
            $table->integer("tax_id")->nullable();
            $table->timestamps();
            $table->foreign('product_cat_id')->references('cat_id')->on('categories')->onDelete('cascade');
            $table->foreign('product_sub_cat_id')->references('subcat_id')->on('sub_categories')->onDelete('cascade');
        });
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
};
