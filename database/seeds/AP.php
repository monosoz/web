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
        $i = 1;

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
            $i++;
        }
    }
}
