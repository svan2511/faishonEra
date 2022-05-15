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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id("subcat_id");
            $table->string('subcat_name');
            $table->string('subcat_slug');
            $table->unsignedBigInteger('parent_cat_id');
            $table->string('subcat_image');
            $table->integer('subcat_status')->default(1);
            $table->foreign('parent_cat_id')->references('cat_id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};
