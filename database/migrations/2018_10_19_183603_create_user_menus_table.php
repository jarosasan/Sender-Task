<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meal_plan_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('user_id');
            $table->date('date');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('meal_plan_id')->references('id')->on('meal_plans');
            $table->foreign('order_id')->references('id')->on('user_orders');
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
        Schema::create('user_orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['meal_plan_id']);
            $table->dropForeign(['order_id']);
        });
        Schema::dropIfExists('user_menus');
    }
}
