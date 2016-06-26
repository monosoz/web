<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Fake extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('products')->insert([
                'name' => $faker->word,
                'description' => $faker->sentence,
            ]);
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'mobile_number' => $faker->numerify('##########'),
                'password' => bcrypt('secret'),
            ]);
        }
    }
}
