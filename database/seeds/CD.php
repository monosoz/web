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

    	Schema::table('variants', function($table)
        {
            $table->decimal('tax', 20, 2)->default(0)->after('price');
        });

		DB::table('products')->insert([
    		[
		    		'id'			=> '101',
		    		'name' 			=> 'COld Drink',
		    ],
        ]);
    	DB::table('variants')->insert([
    		[
		    		'product_id'			=> '101',
		    		'sku'			=> 'COKE051101',
		    		'price'			=> '35',
		    		'name' 			=> 'Coke',
		    ],
        	[
		    		'product_id'			=> '101',
		    		'sku'			=> 'FANTA051101',
		    		'price'			=> '35',
		    		'name' 			=> 'Fanta',
		    ],
        	[
		    		'product_id'			=> '101',
		    		'sku'			=> 'SPRITE051101',
		    		'price'			=> '35',
		    		'name' 			=> 'Sprite',
		    ],
        ]);

        DB::table('product_tag')->insert([
                'product_id' => 101,
                'tag_id' => '51',
        ]);
    }
}
