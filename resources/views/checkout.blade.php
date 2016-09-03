@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Checkout</div>
        <div class="panel-body">
          <div>
            <p>Name: {{$user->name}} <!--a class="pull-right" href="#">edit</a--></p>
            <!--p>Mobile Number: {{$user->mobile_number}} <a class="pull-right" href="#">edit</a></p-->
            <p>Email: {{$user->email}} <!--a class="pull-right" href="#">edit</a--></p>
          </div>
          <hr>
          <div class="clearfix">
            @include('blocks.addketchup')
            <p>Cart Summary:</p>
            @include('blocks.cart')
          </div>
          <hr>
          <div>
            @if (count($user->locations) === 0)
            <p>Enter Delivery Address:</p>
            @else
            <div class="clearfix">
              <p>Select Delivery Address:</p>
                @foreach ($user->locations->sortByDesc('updated_at') as $location)
                <div class="addcard col-lg-10 col-lg-offset-1">
                  @include('blocks.addresscard')
                </div>
                @endforeach
            </div>
            @endif
            <hr>
            <div class="clearfix">
              <p>New Address:
              </p>
              <p>
        {!!$errors->first('name', '<span class="help-block">:message</span>')!!}
        {!!$errors->first('contact', '<span class="help-block">:message</span>')!!}
        {!!$errors->first('pincode', '<span class="help-block">:message</span>')!!}
        {!!$errors->first('address', '<span class="help-block">:message</span>')!!}
        {!!$errors->first('lat', '<span class="help-block">Please select your location on map.</span>')!!}
              </p>
              <form class="form-horizontal" method="POST" action="{{ url('/user/address') }}">
                {{ csrf_field() }}
                <div class="col-sm-6">
                @include('blocks.addressform')
                <div id="mapinput"></div>
<div class="col-md-6 col-md-offset-4">
  <button type="submit" class="btn btn-primary">
    <i class="fa fa-btn fa-user"></i> Add Address
  </button>
</div>
<div class="clearfix"></div>
                </div>
                <div class="col-sm-6">
                  <div id="new_map"></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{config('app.map_key')}}"></script>
    <script src="{{ url('map.js') }}"></script>
@endsection

@section('title')Checkout: @endsection