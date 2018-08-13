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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 45);
            $table->string('subtitle', 100);
            $table->string('image_url', 250);
            $table->string('url', 250);
            $table->timestamps();
        });

        Schema::create('message_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('message_id');
            $table->integer('product_id');
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
        Schema::dropIfExists('message_product');
    }

}
