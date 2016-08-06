@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="col-ls-12">
        @include('blocks.product')
      </div>
    </div>

    <!-- Collapsed Hamburger -->

    <div id="toTop" type="button" class="carticon" data-toggle="modal" data-target="#app-cart-modal">

      <i class="fa fa-shopping-cart fa-3x"aria-hidden="true"></i>
    </div>
    <div class="modal fade" id="app-cart-modal">
    <div class="cart panel panel-default modal-content">
      <div class="panel-heading">
        <button type="button" class="" data-dismiss="modal">&times;</button>
        &nbspCart ({{ $cart->id }})
        <span class="pull-right">Items: {{ $cart->count }}</span>
      </div>
      <div>
          @include('blocks.cart')
      </div>
      <div class="panel-footer">
        <a href="{{url('checkout')}}">Checkout: <i class="fa fa-inr"></i>&nbsp{{ $cart->total }}</a>
      </div>
    </div>
    </div>
@endsection