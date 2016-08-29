<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Variant;
use App\Addon;

class InsTax extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (Variant::all() as $variant) {
            if ($variant->product_id<100) {
                $variant->tax = $variant->price * 0.125;
                $variant->save();
            }
        }
        foreach (Addon::all() as $variant) {
                $variant->tax = $variant->price * 0.125;
                $variant->save();
        }
    }
}
