@extends('layouts.app')

@section('content')
<nav class="top-bar" id="top">
        <div class="">
            <a href="{{ url('/feedback') }}" class="input-group">
            <strong class="form-control btn-default">We would love to hear from you.</strong>
            <span class="input-group-btn">
            <span class="btn btn-primary">
            <span class="xxs-h">Feedback&nbsp</span>
            <i class="fa fa-arrow-right" aria-hidden="true"></i></span></span>
            </a>
        </div>
</nav>
<div class="input-group">
    <span class="input-group-btn">
        <a href="#veg" class="btn btn-default tag-link"><strong style="color:#1c8;">Veg</strong></a>
        <a href="#nveg" class="btn btn-default tag-link"><strong style="color:#b11;">Non-Veg</strong></a>
        <a href="#bev" class="btn btn-default tag-link"><strong style="color:#08b;">Beverages</strong></a>
    </span>
    <span class="form-control"></span>
    <!--a href="#top" class="input-group-btn">
      <span class="btn btn-primary"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
    </a-->
</div>
    <div class="container">
        @include('blocks.product')
    </div>

    <div class="alert" style="pointer-events: none;"> BETA </div>
    <!-- Collapsed Hamburger -->

    <div class="cart-btn clickable" type="button" class="carticon" data-toggle="modal" data-target="#app-cart-modal">
      <i class="fa fa-shopping-cart fa-3x"aria-hidden="true"></i>
      <sup class="cart-status">{{ $cart->count }}</sup>
    </div>
    <div class="modal fade" id="app-cart-modal">
    <div class="cart panel panel-default modal-content">
      <div class="panel-heading">
        <button type="button" class="" data-dismiss="modal">&times;</button>
        &nbspCart
        <span class=""> 
        @if($cart->count>0)
          ({{ $cart->count }})
        @endif
        &nbsp</span>
        <form action="{{ url('cart/clear' ) }}" method="POST" class="pull-right">
            {{ csrf_field() }}
            <button type="submit" name="action" value="clear" class="">Clear Cart</button>
        </form>
      </div>
      <div class="cart-body">
          @include('blocks.cart')
      </div>
      <div class="panel-footer">
      <div class="row-10">
        <form action="{{ url('cart/applycoupon' ) }}" method="POST" class="pull-right input-group col-xs-6">
          {{ csrf_field() }}
          <input type="text"  name="code" placeholder="Apply Coupon" class="form-control">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
          </span>
        </form>
        <a href="{{url('checkout')}}" class="input-group col-xs-6"">
            <span class="form-control btn-default">Checkout</span>
            <span class="input-group-btn">
            <span class="btn btn-primary"><i class="fa fa-inr"></i>&nbsp{{ number_format($cart->total, 0) }}</span></span>
        </a>
        {!!$errors->first('code', '<span class="help-block pull-right">:message</span>')!!}
        @if (Session::has('couponMessage'))
            <span class="help-block pull-right">{{ Session::get('couponMessage') }}</span>
        @endif
      </div>
</div>
      </div>
    </div>



@if($cart_status==3)
  @include('blocks.feedbacksaved')
@elseif($cart_status==4)
  @include('blocks.messagesaved')
@elseif(!env('OPEN') && $cart_status==0)
  @include('blocks.welcome')
@elseif($cart_status==5)
  @include('blocks.welcome')
@endif
@endsection
@section('scripts')
  @if($cart_status==1)
    <script type="text/javascript">
        $(window).load(function(){
            $('#app-cart-modal').modal('show');
        });
    </script>
  @elseif($cart_status==3)
    <script type="text/javascript">
        $(window).load(function(){
            $('#fModal').modal('show');
        });
    </script>
  @elseif($cart_status==4)
    <script type="text/javascript">
        $(window).load(function(){
            $('#mModal').modal('show');
        });
    </script>
  @elseif(!env('OPEN') && $cart_status==0)
    <script type="text/javascript">
        $(window).load(function(){
            $('#wModal').modal('show');
        });
    </script>
  @elseif($cart_status==5)
    <script type="text/javascript">
        $(window).load(function(){
            $('#wModal').modal('show');
        });
    </script>
  @endif
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
    <script src="{{ url('sc02.js') }}"></script>

@endsection