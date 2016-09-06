<?php

use Illuminate\Database\Seeder;

class KU extends Seeder
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
                    'id' => 102,
                    'name' => 'Ketchup' ,
                    'description' => 'Tomato Ketchup'
            ],
        ]);

    	DB::table('variants')->insert([
    		[
		    		'product_id'			=> '102',
		    		'sku'			=> 'KETCHUP10201',
		    		'price'			=> '1',
		    		'name' 			=> 'Ketchup',
		    ],
        ]);
    }
}
