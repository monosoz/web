@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
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
              <ol class="locations">
                @foreach ($user->locations as $location)
                <li>
                  @include('blocks.addresscard')
                </li>
                @endforeach
              </ol>
            </div>
            @endif
            <div>
              <p>New Address:
              </p>
              <div id="new_map"></div>
              <div id="message"></div>
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
    <script src="map.js"></script>
@endsection