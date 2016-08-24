<?php

use Illuminate\Database\Seeder;

class CD extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('variants')->insert([
    		[
		    		'product_id'			=> '101',
		    		'sku'			=> 'COKE051051',
		    		'price'			=> '35',
		    		'name' 			=> 'Coke',
		    ],
        	[
		    		'product_id'			=> '101',
		    		'sku'			=> 'FANTA051052',
		    		'price'			=> '35',
		    		'name' 			=> 'Fanta',
		    ],
        	[
		    		'product_id'			=> '101',
		    		'sku'			=> 'LIMCA051053',
		    		'price'			=> '35',
		    		'name' 			=> 'Limca',
		    ],/*
        	[
		    		'product_id'			=> '101',
		    		'sku'			=> '____051054',
		    		'price'			=> '35',
		    		'name' 			=> '',
		    ],*/
        ]);

        DB::table('product_tag')->insert([
                'product_id' => 101,
                'tag_id' => '51',
        ]);
    }
}
