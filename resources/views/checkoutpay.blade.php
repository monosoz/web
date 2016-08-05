@extends('layouts.app')

@section('stylesheet')
<link href="{{ url('st03.css') }}" rel="stylesheet">
@endsection

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
            <p>Delivery Address:</p>
            <div class="add-text col-xs-6">
              <span class="add-field"><h>Name:</h></span><h>{{$selectadd->name}}</h><br>
              <span class="add-field"><h>Contact:</h></span><h>{{$selectadd->mobile_number}}</h><br>
              <span class="add-field"><h>Address:</h></span><h>{{$selectadd->address}}</h><br>
              <span class="add-field"><h>Pincode:</h></span><h>{{$selectadd->pincode}}</h><br>
              
            </div>
            <div class="add-map col-xs-6 col-sm-4">
              <img class="img-responsive pull-right" src={{"https://maps.googleapis.com/maps/api/staticmap?key=" . config('app.map_key') . "&center=28.5383277,77.1980605&zoom=11&size=200x200&maptype=roadmap&markers=color:red|" . $selectadd->lat . "," . $selectadd->lng}}>
            </div>
            <div class="clearfix"></div>
            <hr>
             <div  class="col-sm-11">
        <p>Select Payment Method</p>
        <div class="col-xs-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li class="active"><a href="#cod" data-toggle="tab">COD</a></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <!--li><a href="#PayU" data-toggle="tab">PayU</a></li>
            <li><a href="#PayTM" data-toggle="tab">PayTM</a></li-->
          </ul>
        </div>

        <div class="col-xs-9">
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="cod">
            <h4>Cash on Delivery</h4>
            <div class="pull-down">
              <span>Amount Payable: <i class="fa fa-inr"></i>&nbsp{{ $user->cart->total }}</span><br>
              <form class="btn pull-right" method="POST" action="{{ url('/checkout') }}">
                {{ csrf_field() }}
                <input type="hidden" name="total" value="{{ $user->cart->total }}">
                <button>Confirm</button>
              </form>
              </div>
            </div>
            <div class="tab-pane" id="PayU">Comming soon</div>
            <div class="tab-pane" id="PayTM">Comming soon</div>
          </div>
        </div>

        <div class="clearfix"></div>

      </div>



          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection