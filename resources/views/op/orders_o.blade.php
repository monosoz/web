@extends('layouts.opapp')

@section('content')
<!--nav class="top-bar" id="top">
<div class="input-group">
    <span class="input-group-btn">
        <a href="?" class="btn btn-default tag-link"><strong style="color:#000;">all</strong></a>
        <a href="?os=in_process" class="btn btn-default tag-link"><strong style="color:#08b;">in_process</strong></a>
        <a href="?os=complete" class="btn btn-default tag-link"><strong style="color:#1c8;">complete</strong></a>
        <a href="?os=cancelled" class="btn btn-default tag-link"><strong style="color:#b11;">cancelled</strong></a>
    </span>
    <span class="form-control"></span>
</div>
</nav-->


<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Orders</div>
        <div class="panel-body">
            @if (count($orders) === 0)
            <p>Nothing to show here!</p>
            @else

{{--*/ $opcal = new stdClass() /*--}}
{{--*/ $opcal->total = 0 /*--}}
{{--*/ $opcal->off = 0 /*--}}
{{--*/ $opcal->ocount = 0 /*--}}
{{--*/ $opcal->pcount = 0 /*--}}


                @foreach ($orders->sortByDesc('created_at') as $cart)
<div style="position: relative;">
Id: {{$cart->id}}<br>
Order Id: {{$cart->order_id}}<br>
<strong style="position: absolute; top: 0; right: 0; padding: 5px 10px; background-color: rgba(239, 76, 28, 0.39)">Status: {{$cart->status->name}}<br></strong>
User: {{$cart->user->name}} <a href="?u={{$cart->user->id}}">({{$cart->user->id}})</a><br>
User Contact: {{$cart->user->mobile_number}}<br>
@if ($cart->is('pending'))
Pending
@else
Pincode: {{$cart->delivery_location->pincode}}<br>
Delivery Address: <strong style="color:#f00;">{{$cart->delivery_location->name}}, {{$cart->delivery_location->address}}</strong><br>
Comment: <strong style="color:#f00;">{{$cart->delivery_location->usercomment}}</strong><br>
Map:<a href="{{'https://www.google.co.in/maps/?q='.$cart->delivery_location->lat.','.$cart->delivery_location->lng}}">{{$cart->delivery_location->lat.','.$cart->delivery_location->lng}}</a><br>
Order Status: {{$cart->statusCode}}

        <form class="btn pull-right" action="" method="POST">
            {{ csrf_field() }}
<select class="btn" name="status">
  <option value=""></option>
  <option value="2">in_process</option>
  <option value="5">out_for_delivery</option>
  <option value="1">complete</option>
  <option value=""></option>
  <option value="3">cancel</option>
</select>
            <input type="hidden" name="order_id" value="{{$cart->id}}">
            <input type="hidden" name="user_id" value="{{$cart->user->id}}">
            <button type="submit" class="btn">
                <span class="fa fa-check" aria-hidden="true"></span>
            </button>
        </form>
<br>
Date: {{substr($cart->created_at, 0, 10)}}<br>
Time: {{substr($cart->created_at, -8, 5)}}<br>
Total: {{$cart->total}}<br>

{{--*/ $opcal->ocount++ /*--}}
{{--*/ $opcal->total += round($cart->total) /*--}}
{{--*/ $opcal->pcount += $cart->count /*--}}

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
{{--*/ $toff = 0 /*--}}
    @foreach ($cart->items as $item)
@if($item->price<0)
    {{--*/ $toff += $item->price * $item->quantity /*--}}
@elseif(substr($item->class, -5, 5)!='Addon')
    {{--*/ $q = $item->quantity /*--}}
    {{--*/ $ql = $q /*--}}

@for(; $q>-1; $q--)
    @if($item->rel->where('item_no', "$q")->count()!=0)
    <tr>
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
    </tr>
        {{--*/ $ql-- /*--}}
    @elseif($q==0&$ql>0)
    <tr>
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
@if($item->price<50)
{{--*/ $opcal->pcount-=$item->quantity /*--}}
@endif
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
    </tr>
    @endif
@endfor
@endif
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td>Subtotal: </td>
            <td><i class="fa fa-inr"></i><span> {{ $cart->totalPrice - $toff }}</span></td>
        </tr>
        <tr>
            <td>Vat:</td>
            <td><i class="fa fa-inr"></i><span> {{ $cart->totalTax }}</span></td>
        </tr>
        @if($toff != 0)
        <tr>
            <th>Discount:</th>
            <th><i class="fa fa-inr"></i><span> {{ $toff }}</span></th>
        </tr>
{{--*/ $opcal->off += $toff /*--}}
        @endif
        <tr>
            <th>Total:</th>
            <th><i class="fa fa-inr"></i><span> {{ number_format($cart->total, 0) }}</span></th>
        </tr>
    </tfoot>
</table>
<hr>
Contact us: support@monosoz.com<br>
www.monosoz.com<br>
@endif
</div>
<hr>
                @endforeach
<div style="padding: 31px; position: fixed; left: 0; right: 0; bottom: 0; background-color: #eee; z-index: 1;">
<span class="col-sm-3 col-xs-6">Total: {{ $opcal->total }} </span>
<span class="col-sm-3 col-xs-6">Discount: {{ $opcal->off }} </span>
<span class="col-sm-3 col-xs-6">Order Count: {{ $opcal->ocount }} </span>
<span class="col-sm-3 col-xs-6">Pizza Count: {{ $opcal->pcount }}</span>
</div>
            @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('stylesheet')
@endsection

@section('title')Orders: @endsection