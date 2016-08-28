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
                <div class="">
@if (!$cart->is('pending'))
@include('blocks.ordercard')
@endif
                </div>
                @endforeach
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@if($cart_status==11)
  @include('blocks.welcome')
@endif
@endsection

@section('scripts')
  @if($cart_status==11)
    <script type="text/javascript">
        $(window).load(function(){
            $('#wModal').modal('show');
        });
    </script>
  @endif
@endsection

@section('title')Orders: @endsection