<?php

use Illuminate\Database\Seeder;

class ProductSetup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();

    	DB::table('tags')->insert([
		    [
		    		'id'			=> '1',
		    		'name' 			=> 'veg',
		    		'description'	=> '',
		    ],
		    [
		    		'id'			=> '2',
		    		'name' 			=> 'non-veg',
		    		'description'	=> '',
		    ],
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

        DB::table('addons')->delete();

    	DB::table('addons')->insert([
		    [
		    		'id'			=> '1',
		    		'sku'			=> 'EXTRACHEESE',
		    		'price'			=> '40',
		    		'name' 			=> 'Extra Cheese',
		    ],
		    [
		    		'id'			=> '3',
		    		'sku'			=> 'REGULARBASE',
		    		'price'			=> '0',
		    		'name' 			=> 'Regular',
		    ],
		    [
		    		'id'			=> '4',
		    		'sku'			=> 'THINCRUST',
		    		'price'			=> '0',
		    		'name' 			=> 'Thin Crust',
		    ],
		    [
		    		'id'			=> '5',
		    		'sku'			=> 'DOUBLEDOUGH',
		    		'price'			=> '0',
		    		'name' 			=> 'Double Dough',
		    ],
		    [
		    		'id'			=> '11',
		    		'sku'			=> 'BABYCORN',
		    		'price'			=> '15',
		    		'name' 			=> 'Babycorn',
		    ],
		    [
		    		'id'			=> '12',
		    		'sku'			=> 'BLACKOLIVE',
		    		'price'			=> '15',
		    		'name' 			=> 'Black Olive',
		    ],
		    [
		    		'id'			=> '13',
		    		'sku'			=> 'CAPSICUM',
		    		'price'			=> '15',
		    		'name' 			=> 'Capsicum',
		    ],
		    [
		    		'id'			=> '14',
		    		'sku'			=> 'GOLDENCORN',
		    		'price'			=> '15',
		    		'name' 			=> 'Golden Corn',
		    ],
		    [
		    		'id'			=> '15',
		    		'sku'			=> 'GREENOLIVE',
		    		'price'			=> '15',
		    		'name' 			=> 'Green Olive',
		    ],
		    [
		    		'id'			=> '16',
		    		'sku'			=> 'JALAPENO',
		    		'price'			=> '15',
		    		'name' 			=> 'Jalapeno',
		    ],
		    [
		    		'id'			=> '17',
		    		'sku'			=> 'MUSHROOM',
		    		'price'			=> '15',
		    		'name' 			=> 'Mushroom',
		    ],
		    [
		    		'id'			=> '18',
		    		'sku'			=> 'ONION',
		    		'price'			=> '15',
		    		'name' 			=> 'Onion',
		    ],
		    [
		    		'id'			=> '19',
		    		'sku'			=> 'PANEER',
		    		'price'			=> '15',
		    		'name' 			=> 'Paneer',
		    ],
		    [
		    		'id'			=> '20',
		    		'sku'			=> 'TOMATO',
		    		'price'			=> '15',
		    		'name' 			=> 'Tomato',
		    ],
		    [
		    		'id'			=> '31',
		    		'sku'			=> 'BARBEQUECHICKEN',
		    		'price'			=> '30',
		    		'name' 			=> 'Barbeque Chicken',
		    ],
		    [
		    		'id'			=> '32',
		    		'sku'			=> 'CHUNKYCHICKEN',
		    		'price'			=> '30',
		    		'name' 			=> 'Chunky Chicken',
		    ],
		    [
		    		'id'			=> '33',
		    		'sku'			=> 'KEEMACHICKEN',
		    		'price'			=> '30',
		    		'name' 			=> 'Keema Chicken',
		    ],
		    [
		    		'id'			=> '34',
		    		'sku'			=> 'SALAMICHICKEN',
		    		'price'			=> '30',
		    		'name' 			=> 'Salami Chicken',
		    ],
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

        foreach (range(11,20) as $index) {
        DB::table('addon_tag')->insert([
                'addon_id' => $index,
                'tag_id' => '1',
        ]);
        }

        foreach (range(31,34) as $index) {
        DB::table('addon_tag')->insert([
                'addon_id' => $index,
                'tag_id' => '2',
        ]);
        }

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
