<?php

namespace App\Events;

use App\Order;

use Amsgames\LaravelShop\Events\OrderPlaced ;

class NotifyPurchase
{

    public $order;

    /**
     * Handle the event.
     *
     * @param  OrderPurchased $event
     * @return void
     */

    public function handle(OrderPlaced $event)
    {
        // The order ID
        //echo $event->id;

        // Get order model object
        $this->order = Order::find($event->id);

        // My code here...

  

}