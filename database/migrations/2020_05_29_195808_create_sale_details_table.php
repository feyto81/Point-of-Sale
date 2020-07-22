<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->increments('detail_id');
            $table->string('sale_id')->nullable();
            $table->foreign('sale_id')->references('sale_id')->on('sales')->onDelete('cascade');
            $table->unsignedInteger('item_id')->nullable();
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->string('price');
            $table->string('qty');
            $table->string('discount_item');
            $table->string('total');
            $table->string('customer_name');
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
        Schema::dropIfExists('sale_details');
    }
}
