<?php

use Illuminate\Database\Seeder;

class NV extends Seeder
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
                    'name' => 'Ketchup' ,
                    'description' => 'Tomato Ketchup'
            ],
            [
                    'name' => 'Ketchup' ,
                    'description' => 'Tomato Ketchup'
            ],
            [
                    'name' => 'Ketchup' ,
                    'description' => 'Tomato Ketchup'
            ],
        ]);
    }
}
