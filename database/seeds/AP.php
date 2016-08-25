<?php

use Illuminate\Database\Seeder;
use App\Product;

class AP extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 5;
            DB::table('products')->insert([
                [
                    'id'            => '5',
                    'name' => 'Special Mushroom' ,
                    'description' => 'Mushroom, Chopped Onion, Tomato, Black Olive, Jalapeno.'
                ],
            	[
                    'id'            => '6',
                    'name' => 'Veggie Delux' ,
                    'description' => 'Babycorn, Capcisum, Chopped Onion, Golden Corn, Jalapeno.'
                ],
            	[
                    'id'            => '7',
                    'name' => 'Sweet Tango' ,
                    'description' => 'Babycorn, Onion Rings, Jalapeno, Tomato, Green Olive, Black Olive.'
                ],
            	[
                    'id'            => '8',
                    'name' => 'Veg Extravaganza' ,
                    'description' => 'Onion Rings, Capcisum, Tomato, Golden Corn, Black Olives, Jalapeno.'
                ],
            	[
                    'id'            => '9',
                    'name' => 'Olive Garden' ,
                    'description' => 'Green Olive, Black Olive, Babycorn, Chopped Onion, Paneer.'
                ],
            	[
                    'id'            => '10',
                    'name' => 'Corn Delux' ,
                    'description' => 'Caramelized Onion Sauce with Babycorn, Golden Corn, Capcisum, Mushroom, Tomato, Jalapeno.'
                ],
            ]);

        foreach (Product::all() as $product) {
            $sku = 'PIZZA010';
            $price = 159;
            if ($product->variants->count()==0) {
            DB::table('variants')->insert([
                [
                    'product_id' => $product->id,
                    'sku' => $sku.$i.'R',
                    'price' => $price,
                    'tax' => 0.125,
                    'name' => $product->name.'-Regular',
                    'type' => 'r',
                ],
                [
                    'product_id' => $product->id,
                    'sku' => $sku.$i.'M',
                    'price' => $price+70,
                    'tax' => 0.125,
                    'name' => $product->name.'-Medium',
                    'type' => 'm',
                ],
                [
                    'product_id' => $product->id,
                    'sku' => $sku.$i.'L',
                    'price' => $price+140,
                    'tax' => 0.125,
                    'name' => $product->name.'-Large',
                    'type' => 'l',
                ],
                ]);
                DB::table('product_tag')->insert([
                    'product_id' => $product->id,
                    'tag_id' => 1,
                ]);
            }
        }
    }
}
