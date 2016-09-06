<?php

use Illuminate\Database\Seeder;

class SC extends Seeder
{

  public function run()
  {

    DB::table('order_status')->insert([
            [
                    'code'              => 'confirmed',
                    'name'              => 'Confirmed',
                    'description' => 'Order confirmed.',
            ],
        ]);

  }
}