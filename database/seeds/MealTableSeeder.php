<?php

use Illuminate\Database\Seeder;

class MealTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 30; $i++) {
            DB::table('meals')->insert([
                'title' => $faker->name,
                'category_id' => rand(1, 5),
                'price' => rand(1, 8)
            ]);
        }
    }
}
