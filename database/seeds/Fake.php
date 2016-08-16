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
                'name' => 'Veg Fiesta' ,
                'description' => 'Chopped Onion, Capcisum, Tomato, Golden Corn, Black Olives.'
            ]);
            DB::table('products')->insert([
                'name' => 'Margherita' ,
                'description' => 'Too Much Cheese!'
            ]);
            DB::table('products')->insert([
                'name' => 'Butter Onion Blast' ,
                'description' => 'Butter, Onion, Onion, Onion.'
            ]);
            DB::table('products')->insert([
                'name' => 'Earthy Delight' ,
                'description' => 'Mushroom, Paneer, Golden Corn, Onion Rings.'
            ]);

        
        $i = 1;
        foreach (Product::all() as $product) {
            $sku = 'PIZZA010';
            $price = 159;
            
            DB::table('variants')->insert([
                'product_id' => $product->id,
                'sku' => $sku.$i.'R',
                'price' => $price,
                'name' => $product->name.'-Regular',
                'type' => 'r',
            ]);
            DB::table('variants')->insert([
                'product_id' => $product->id,
                'sku' => $sku.$i.'M',
                'price' => $price+70,
                'name' => $product->name.'-Medium',
                'type' => 'm',
            ]);
            DB::table('variants')->insert([
                'product_id' => $product->id,
                'sku' => $sku.$i.'L',
                'price' => $price+140,
                'name' => $product->name.'-Large',
                'type' => 'l',
            ]);
            $i++;
            DB::table('product_tag')->insert([
                'product_id' => $product->id,
                'tag_id' => 1,
            ]);
        }
    }
}
