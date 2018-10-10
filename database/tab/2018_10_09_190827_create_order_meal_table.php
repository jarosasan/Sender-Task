<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderMealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_meal', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meal_id');
            $table->unsignedInteger('order_id');
            $table->integer('quantity');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('meal_id')->references('id')->on('meals');
            $table->date('day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_meal', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['meal_id']);
        });
        Schema::dropIfExists('order_meal');
    }
}
