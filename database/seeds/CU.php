<?php

use Illuminate\Database\Seeder;

class CU extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('tags')->insert([
            [
		    		'id'			=> '11',
		    		'name' 			=> 'Base',
		    		'description'	=> '',
		    ],
		    [
		    		'id'			=> '12',
		    		'name' 			=> 'Sauce',
		    		'description'	=> '',
		    ],
		    [
		    		'id'			=> '51',
		    		'name' 			=> 'Beverages',
		    		'description'	=> '',
		    ],
		]);
    	DB::table('addons')->insert([
            [
		    		'id'			=> '41',
		    		'sku'			=> 'SAUCE01241',
		    		'price'			=> '0',
		    		'name' 			=> 'Standard Tomato Sauce',
		    ],
        	[
		    		'id'			=> '42',
		    		'sku'			=> 'SAUCE01242',
		    		'price'			=> '0',
		    		'name' 			=> 'Indian Masala Sauce',
		    ],
        	[
		    		'id'			=> '43',
		    		'sku'			=> 'SAUCE01243',
		    		'price'			=> '0',
		    		'name' 			=> 'Caramelized Onion Sauce',
		    ],
        ]);

        foreach (range(3,5) as $index) {
        DB::table('addon_tag')->insert([
                'addon_id' => $index,
                'tag_id' => '11',
        ]);
        }

        foreach (range(41,43) as $index) {
        DB::table('addon_tag')->insert([
                'addon_id' => $index,
                'tag_id' => '12',
        ]);
        }
    }
}
