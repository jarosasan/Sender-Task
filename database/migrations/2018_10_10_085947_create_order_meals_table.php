<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_meals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meal_id');
            $table->unsignedInteger('order_id');
            $table->integer('quantity');
            $table->string('weekday');
            $table->date('date');
            $table->foreign('meal_id')->references('id')->on('meals');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->index('weekday');
            $table->index('date');


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
        Schema::table('user_order_meal', function (Blueprint $table) {
            $table->dropForeign(['meal_id']);
            $table->dropForeign(['order_id']);
            $table->dropIndex('weekday');
            $table->dropIndex('date');
        });
        Schema::dropIfExists('order_meals');
    }
}
