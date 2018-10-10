<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('secret'),
            'role' => 'user',

        ]);
    }
}
