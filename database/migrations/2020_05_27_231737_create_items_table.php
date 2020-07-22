<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->string('barcode');
            $table->string('name');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->unsignedInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('unit_id')->on('units')->onDelete('cascade');
            $table->string('price');
            $table->string('stock');
            $table->string('image');
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
        Schema::dropIfExists('items');
    }
}
