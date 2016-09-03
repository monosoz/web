<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Order;
use App\Addon;

class InsOid extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (Order::all() as $order) {
            if ($order->order_id==null) {
                $order->timestamps = false;
                $oid=$order->id+1000;
                $order->order_id = 'OD1' . substr($order->created_at, 5, 2) . substr($order->created_at, 8, 2) . $oid;
                $order->save();
            }
        }
    }
}