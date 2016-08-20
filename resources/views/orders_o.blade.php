@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Orders</div>
        <div class="panel-body">
          <div>
            @if (count($orders) === 0)
            <p>Nothing to show here!</p>
            @else
            <div class="clearfix">
                @foreach ($orders->sortByDesc('updated_at') as $cart)
                @if($cart->statusCode!='complete')
<div>
Order Id: {{$cart->id}}<br>
@if ($cart->is('pending'))
Pinding
@else
Delivery Address:{{$cart->delivery_location->name}}, {{$cart->delivery_location->address}}<br>
Map:<a href="{{'https://www.google.co.in/maps/?q='.$cart->delivery_location->lat.','.$cart->delivery_location->lng}}">{{$cart->delivery_location->lat.','.$cart->delivery_location->lng}}</a><br>
Order Status: {{$cart->statusCode}}<br>
{{$cart->created_at}}<br>
Total: {{$cart->total}}<br>
<div style="text-align: center;">
<strong>monosoz</strong><br>
New Delhi - 110017<br>
TIN : 07987140098<br>
{{$cart->created_at}}<br>
------------------------------------
</div>
Name:{{$cart->delivery_location->name}}<br>
Mobile No:{{$cart->delivery_location->mobile_number}}<br>
Address:{{$cart->delivery_location->address}}<br>
<hr>
<table class="cart-table" style="width:100%; font-size:.8em;">
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
            {{ $item->displayName }}
            @elseif(substr($item->sku, 0, 4)==='FREE')
            Free Pizza
            @else
            Custom Pizzaa
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
            <td>Subtotal: </td>
            <td><i class="fa fa-inr"></i><span> {{ $cart->totalPrice }}</span></td>
        </tr>
        <tr>
            <td>Vat:</td>
            <td><i class="fa fa-inr"></i><span> {{ $cart->totalTax }}</span></td>
        </tr>
        <tr>
            <th>Total:</th>
            <th><i class="fa fa-inr"></i><span> {{ $cart->total }}</span></th>
        </tr>
    </tfoot>
</table></div>
<hr>
Contact us: support@monosoz.com<br>
www.monosoz.com<br>
</div>
@endif
<hr>
                @endif
                @endforeach
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection