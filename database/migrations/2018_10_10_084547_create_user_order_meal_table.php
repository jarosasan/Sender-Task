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
            $table->unsignedInteger('order_id');
            $table->integer('quantity')->default(1);
            $table->string('weekday');
            $table->foreign('meal_id')->references('id')->on('meals');
            $table->foreign('order_id')->references('id')->on('user_order');
            $table->date('date');
            $table->index('weekday');
            $table->index('date');
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
        Schema::dropIfExists('user_order_meal');
    }
}
