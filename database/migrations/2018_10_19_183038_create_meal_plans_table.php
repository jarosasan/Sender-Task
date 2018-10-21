<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meal_id');
            $table->string('size')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('hot')->nullable();
            $table->integer('cold')->nullable();
            $table->string('type')->nullable();
            $table->unsignedInteger('addon_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->string('weekday');
            $table->date('date');
            $table->foreign('meal_id')->references('id')->on('meals');
            $table->foreign('category_id')->references('id')->on('meal_categories');
            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::create('meal_plans', function (Blueprint $table) {
            $table->dropForeign(['meal_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['order_id']);
        });
        Schema::dropIfExists('meal_plans');
    }
}
