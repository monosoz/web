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
            DB::table('products')->insert([
                'name' => 'Comming Soon...' ,
                'description' => ''
            ]);

        foreach (Product::all() as $product) {
            $sku = 'PIZZA010';
            $price = 000;
            
            DB::table('variants')->insert([
                'product_id' => $product->id,
                'sku' => $sku.$i.'R',
                'price' => $price,
                'name' => $product->name.'-Regular',
            ]);
            DB::table('variants')->insert([
                'product_id' => $product->id,
                'sku' => $sku.$i.'M',
                'price' => $price,
                'name' => $product->name.'-Medium',
            ]);
            DB::table('variants')->insert([
                'product_id' => $product->id,
                'sku' => $sku.$i.'L',
                'price' => $price,
                'name' => $product->name.'-Large',
            ]);
            $i++;
            DB::table('product_tag')->insert([
                'product_id' => $product->id,
                'tag_id' => 1,
            ]);
        }
    }
}
