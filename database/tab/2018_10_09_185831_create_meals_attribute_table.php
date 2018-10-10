<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealsAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('meals', function (Blueprint $table) {
            $table->foreign('attribute_id')->references('id')->on('meals_attribute');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals_attribute');
    }
}
