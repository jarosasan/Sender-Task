<?php

use Illuminate\Database\Seeder;

class MealCategoryTadleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meal_categories')->insert([
            'title' => 'Soup',
        ]);
        DB::table('meal_categories')->insert([
            'title' => 'Main Dish',
        ]);
        DB::table('meal_categories')->insert([
            'title' => 'Salad',
        ]);
        DB::table('meal_categories')->insert([
            'title' => 'Side Dish',
        ]);
        DB::table('meal_categories')->insert([
            'title' => 'Add on',
        ]);
    }
}
