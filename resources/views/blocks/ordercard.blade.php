Order Id: {{$order->id}}<br>
Total: {{$order->total}}<br>
Delivery Address:{{$order->delivery_location->name}}, {{$order->delivery_location->address}}<br>
Order Status: {{$order->statusCode}}<br>
{{$order->created_at}}<br>
<hr
