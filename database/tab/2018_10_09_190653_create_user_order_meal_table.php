<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrderMealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_order_meal', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meal_id');
            $table->unsignedInteger('user_order_id');
            $table->date('day');
            $table->foreign('user_order_id')->references('id')->on('user_order');
            $table->foreign('meal_id')->references('id')->on('meals');
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
            $table->dropForeign(['user_order_id']);
            $table->dropForeign(['meal_id']);
        });
        Schema::dropIfExists('user_order_meal');
    }
}
