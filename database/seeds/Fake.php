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
        $i = 1;
            DB::table('products')->insert([
                [
                    'name' => 'Veg Fiesta' ,
                    'description' => 'Indian Masala Sauce, Chopped Onion, Capcisum, Tomato, Golden Corn, Black Olives.'
                ],
            	[
                    'name' => 'Margherita' ,
                    'description' => 'Too Much Cheese!'
                ],
            	[
                    'name' => 'Butter Onion Blast' ,
                    'description' => 'Butter, Onion, Onion, Onion.'
                ],
            	[
                    'name' => 'Earthy Delight' ,
                    'description' => 'Mushroom, Paneer, Golden Corn, Onion Rings.'
                ],
            	[
                    'name' => 'Special Mushroom' ,
                    'description' => 'Caramelized Onion Sauce, Mushroom, Chopped Onion, Tomato, Black Olive, Jalapeno.'
                ],
            	[
                    'name' => 'Veggie Deluxe' ,
                    'description' => 'Babycorn, Capcisum, Chopped Onion, Golden Corn, Mushroom.'
                ],
            	[
                    'name' => 'Sweet Tango' ,
                    'description' => 'Babycorn, Onion Rings, Jalapeno, Tomato, Green Olive, Black Olive.'
                ],
            	[
                    'name' => 'Veg Extravaganza' ,
                    'description' => 'Onion Rings, Capcisum, Tomato, Golden Corn, Black Olives, Jalapeno.'
                ],
            	[
                    'name' => 'Olive Garden' ,
                    'description' => 'Green Olive, Black Olive, Babycorn, Chopped Onion, Paneer.'
                ],
            	[
                    'name' => 'Corn Deluxe' ,
                    'description' => 'Caramelized Onion Sauce, Babycorn, Golden Corn, Capcisum, Mushroom, Tomato, Jalapeno.'
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
                    'tax' => $price * 0.125,
                    'name' => $product->name.'-Regular',
                    'type' => 'r',
                ],
                [
                    'product_id' => $product->id,
                    'sku' => $sku.$i.'M',
                    'price' => $price+70,
                    'tax' => ($price+70) * 0.125,
                    'name' => $product->name.'-Medium',
                    'type' => 'm',
                ],
                [
                    'product_id' => $product->id,
                    'sku' => $sku.$i.'L',
                    'price' => $price+140,
                    'tax' => ($price+140) * 0.125,
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
