<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockouts', function (Blueprint $table) {
            $table->increments('stockout_id');
            $table->unsignedInteger('item_id')->nullable();
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->enum('type', ['in', 'out']);
            $table->string('detail');
            $table->unsignedInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers')->onDelete('cascade');
            $table->integer('qty');
            $table->date('date');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('stockouts');
    }
}
