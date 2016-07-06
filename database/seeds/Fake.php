<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Product;

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
        }
        foreach (Product::all() as $product) {
            $sku = $faker->numerify('PIZZA####');
            $price = $faker->numberBetween($min = 149, $max = 349);
            
            DB::table('variants')->insert([
                'product_id' => $product->id,
                'sku' => $sku.'M',
                'price' => $price,
                'name' => $product->name.'-Medium',
            ]);
            DB::table('variants')->insert([
                'product_id' => $product->id,
                'sku' => $sku.'L',
                'price' => $price+$faker->numberBetween($min = 100, $max = 200),
                'name' => $product->name.'-Large',
            ]);
            DB::table('product_tag')->insert([
                'product_id' => $product->id,
                'tag_id' => $faker->numberBetween($min = 1, $max = 2),
            ]);
            DB::table('product_tag')->insert([
                'product_id' => $product->id,
                'tag_id' => $faker->randomElement($array = array (11, 12, 13, 21, 22, 23)),
            ]);
        }
    }
}
