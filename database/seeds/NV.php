<?php

use Illuminate\Database\Seeder;

class NV extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                    'id' => 31,
                    'name' => 'Chicken Overload' ,
                    'description' => 'Caramelized Onion Sauce 
Chunky Chicken, Chicken Keema, Golden Corn, Onion Rings'
            ],
            [
                    'id' => 32,
                    'name' => 'Meaty Beat' ,
                    'description' => 'Indian Masala Sauce 
Chunky Chicken, Chicken Salami, Chicken Keema, Chopped Onion'
            ],
            [
                    'id' => 33,
                    'name' => 'Chicken Mushroom' ,
                    'description' => 'Chunky Chicken, Mushroom, Chopped Onion'
            ],
            [
                    'id' => 34,
                    'name' => 'Chicken n Cheese' ,
                    'description' => 'Chicken Salami, Extra Cheese, Chopped Onion, Jalapeno'
            ],
        ]);
        $i = 31;
        foreach (\App\Product::all() as $product) {
            $sku = 'PIZZA01';
            $price = 189;
            if ($product->variants->count()==0) {
            DB::table('variants')->insert([
                [
                    'product_id' => $product->id,
                    'sku' => $sku.$i.'R',
                    'price' => $price,
                    'tax' => $price * 0.125,
                    'name' => $product->name.'-Regular',
                    'type' => 'r',
                ],
                [
                    'product_id' => $product->id,
                    'sku' => $sku.$i.'M',
                    'price' => $price+80,
                    'tax' => ($price+80) * 0.125,
                    'name' => $product->name.'-Medium',
                    'type' => 'm',
                ],
                [
                    'product_id' => $product->id,
                    'sku' => $sku.$i++.'L',
                    'price' => $price+150,
                    'tax' => ($price+150) * 0.125,
                    'name' => $product->name.'-Large',
                    'type' => 'l',
                ],
                ]);
                DB::table('product_tag')->insert([
                    'product_id' => $product->id,
                    'tag_id' => 2,
                ]);
            }
        }
    }
}
