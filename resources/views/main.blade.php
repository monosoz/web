@extends('layouts.app')

@section('content')
    <div class="container">
        @include('blocks.product')
    </div>

    <div class="alert alert-danger">Trial Run.</div>
    <!-- Collapsed Hamburger -->

    <div class="cart-btn" type="button" class="carticon" data-toggle="modal" data-target="#app-cart-modal">
      <i class="fa fa-shopping-cart fa-3x"aria-hidden="true"></i>
      <sup class="cart-status">{{ $cart->count }}</sup>
    </div>
    <div class="modal fade" id="app-cart-modal">
    <div class="cart panel panel-default modal-content">
      <div class="panel-heading">
        <button type="button" class="" data-dismiss="modal">&times;</button>
        &nbspCart
        <span class="pull-right">{{ $cart->count }} 
        @if($cart->count>1)
          Items 
        @else
          Item
        @endif
        &nbsp</span>
      </div>
      <div class="cart-body">
          @include('blocks.cart')
      </div>
      <div class="panel-footer">
        <a href="{{url('checkout')}}" class="btn">Checkout: <i class="fa fa-inr"></i>&nbsp{{ $cart->total }}</a>
        <form action="{{ url('cart/clear' ) }}" method="POST" class="pull-right">
            {{ csrf_field() }}
            <button type="submit" name="action" value="clear" class="btn">
              Clear Cart
            </buttonton>
        </form>
      </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('sc02.js') }}"></script>
@endsection