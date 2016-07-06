@extends('layouts.app')

@section('content')
<div>
  <div class="col-md-12">
    <div class="col-md-12 container">
      <div>
        @include('blocks.product')
      </div>
    </div>

    <!-- Collapsed Hamburger -->

    <div id="toTop" type="button" class="panel-collapse collapsed" data-toggle="collapse" data-target="#app-cart-collapse">

      <i class="fa fa-shopping-cart fa-3x"aria-hidden="true"></i>
    </div>
    <div class="cart panel panel-collapse panel-default" id="app-cart-collapse">
      <div class="panel-heading"> 
        Cart ({{ Auth::user()->name }})
        <span class="pull-right">Items: {{ $cart->count }}</span>
      </div>
      <div class="">
        <div>
          @include('blocks.cart')
        </div>
      </div>
      <div class="panel-footer pull-down">
        <a href="{{url('pay')}}">Pay: <i class="fa fa-inr"></i>&nbsp{{ $cart->total }}</a>
      </div>
    </div>
  </div>
</div>
@endsection