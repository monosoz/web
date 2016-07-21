@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Checkout</div>
        <div class="panel-body">
          <div>
            <p>Name: {{$user->name}} <a class="pull-right" href="#">edit</a></p>
            <p>Mobile Number: {{$user->mobile_number}} <a class="pull-right" href="#">edit</a></p>
            <p>Email: {{$user->email}} <a class="pull-right" href="#">edit</a></p>
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
            <div>
              <p>New Address:
              </p>
              <form class="form-horizontal" method="POST" action="/user/address">
                {{ csrf_field() }}
                <div class="col-sm-6">                @include('blocks.addressform')
                <div id="mapinput"></div>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfq4C_gKmaC-onksNumXb9cWfY4omo3pE"></script>
    <script src="{{ url('map.js') }}"></script>
@endsection