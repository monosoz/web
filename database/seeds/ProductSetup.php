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
		    		'name' 			=> 'cat1',
		    		'description'	=> '',
		    ],
		    [
		    		'id'			=> '21',
		    		'name' 			=> 'cat2',
		    		'description'	=> '',
		    ],
		    [
		    		'id'			=> '12',
		    		'name' 			=> 'cat3',
		    		'description'	=> '',
		    ],
		    [
		    		'id'			=> '22',
		    		'name' 			=> 'cat4',
		    		'description'	=> '',
		    ],
		    [
		    		'id'			=> '13',
		    		'name' 			=> 'cat5',
		    		'description'	=> '',
		    ],
		    [
		    		'id'			=> '23',
		    		'name' 			=> 'cat6',
		    		'description'	=> '',
		    ],
		]);
    }
}
