<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealForPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_for_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meal_id');
            $table->unsignedInteger('plan_id');
            $table->string('weekday');
            $table->foreign('meal_id')->references('id')->on('meals');
            $table->foreign('plan_id')->references('id')->on('meals_plan');
            $table->date('created_at');
            $table->index('weekday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meal_for_plan', function (Blueprint $table) {
            $table->dropForeign(['meal_id']);
            $table->dropForeign(['plan_id']);
            $table->dropIndex('weekday');
        });
        Schema::dropIfExists('meal_for_plan');
    }
}
