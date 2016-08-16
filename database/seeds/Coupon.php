<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Coupon extends Seeder
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
            DB::table('coupons')->insert([
                'code' => 'FREEDOM'.strtoupper(substr($faker->unique()->md5, $faker->randomDigitNotNull, 5)),
                'name' => 'free pizza' ,
            ]);
        }
    }
}
