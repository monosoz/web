<div>
<div style="position: relative;">
<form class="req-call" method="post" action="{{ url('/contactus') }}" role="form" style="position: absolute; top: -5px; right: -10px;">
{{ csrf_field() }}
                <input type="hidden" name="order_id" value="{{$cart->order_id}}"></input>
                <input type="hidden" name="message" value="Callback Request: {{$cart->delivery_location->mobile_number}}"></input>
                <input type="submit" class="btn btn-success btn-send" value="Request Callback">

</form>
<span class="xxs-h">Order Id:</span>{{$cart->order_id}}<br>
<strong style="position: absolute; bottom: 2px; right: -9px; padding: 4px 10px; background-color: rgba(239, 76, 28, 0.39)">Status: {{$cart->status->name}}<br></strong>
Total: {{ number_format($cart->total, 0) }}<br>
@if (!$cart->is('pending')) 
Delivery Address: {{$cart->delivery_location->name}}, {{$cart->delivery_location->address}}<br>
@endif
Date: {{substr($cart->created_at, 0, 10)}}<br>
Time: {{substr($cart->created_at, -8)}}<br>
</div>
@include('blocks.cartb')
<hr>
@if(false)
<div class=""><table class="cart-table table table-hover">
    <tbody>
    @foreach ($cart->items as $item)
@if(substr($item->class, -5, 5)!='Addon')
    {{--*/ $q = $item->quantity /*--}}
    {{--*/ $ql = $q /*--}}

    <tr>
@for(; $q>-1; $q--)
    @if($item->rel->where('item_no', "$q")->count()!=0)
        <td><span>
            @if(substr($item->class, 0, 4)==='App\\')
            {{ $item->displayName }}z
            @elseif(substr($item->sku, 0, 4)==='FREE')
            Free Pizza
            @else
            Custom Pizza
                @if(substr($item->sku, -1)==='R')
                -Regular
                @elseif(substr($item->sku, -1)==='M')
                -Medium
                @elseif(substr($item->sku, -1)==='L')
                -Large
                @endif
            @endif
        </span></td>
        <td><i class="fa fa-inr"></i><span> {{ $item->price + 0 }}</span>
            <!--form action="{{ url('cart/'.$item->sku) }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" name="action" value="add" class="btn-link">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                </button>
                <span> - 1</span>
                <button type="submit" name="action" value="rm" class="btn-link">
                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                </button>
            </form-->
        </td>
    <tr>
        <td>
        <ul style="list-style: none;">
            @foreach ($item->rel->where('item_no', "$q") as $rel)
            <li>
                <span>{{ $rel->child->name }}</span>
            </li>
            @endforeach
        </ul>
        </td>
        <td>
        <ul style="list-style-type: none;">
            @foreach ($item->rel->where('item_no', "$q") as $rel)
            <li>
                <span>{{ $rel->child->price }}</span>
            </li>
            @endforeach
        </ul>
        </td>
    </tr>
        {{--*/ $ql-- /*--}}
    @elseif($q==0&$ql>0)
        <td><span>
            @if(substr($item->class, 0, 4)==='App\\')
            {{ $item->displayName }}
            @elseif(substr($item->sku, 0, 4)==='FREE')
            Free Pizza
            @else
            Custom Pizza
                @if(substr($item->sku, -1)==='R')
                -Regular
                @elseif(substr($item->sku, -1)==='M')
                -Medium
                @elseif(substr($item->sku, -1)==='L')
                -Large
                @endif
            @endif
        </span></td>
        <td><i class="fa fa-inr"></i><span> {{ $item->price + 0 }}</span>
            <!--form action="{{ url('cart/'.$item->sku) }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" name="action" value="add" class="btn-link">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                </button-->
                @if($ql>1)
                <span style="padding-left:10px;">x {{$ql}} </span>
                @endif
                <!--button type="submit" name="action" value="rm" class="btn-link">
                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                </button>
            </form-->
        </td>
    @endif
    </tr>
@endfor
@endif
    @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td>Subtotal:</td>
            <td><i class="fa fa-inr"></i><span> {{ $cart->totalPrice }}</span></td>
        </tr>
        <tr>
            <td>Vat:</td>
            <td><i class="fa fa-inr"></i><span> {{ $cart->totalTax }}</span></td>
        </tr>
        <tr>
            <th>Total:</th>
            <th><i class="fa fa-inr"></i><span> {{ number_format($cart->total, 0) }}</span></th>
        </tr>
    </tfoot>
</table></div>
@endif
</div>