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
                @foreach ($orders as $cart)
                <div class="">
                  @include('blocks.ordercard')
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
@endsection