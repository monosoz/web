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
            <div class="add-text col-xs-6">
              <span class="add-field">Name:</span>{{$selectadd->name}}<br>
              <span class="add-field">Contact:</span>{{$selectadd->mobile_number}}<br>
              <span class="add-field">Address:</span>{{$selectadd->address}}<br>
              <span class="add-field">Pincode:</span>{{$selectadd->pincode}}<br>
            </div>
            <div class="clearfix"></div>
            <hr>
      <div  class="col-sm-11">
        <p>Select Payment Method</p>
      </div>
      <div class="row">
        <div class="col-xs-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li class="active"><a href="#cod" data-toggle="tab">COD</a></li>
            <li><a href="#PayTM" data-toggle="tab" style="padding: 10px 5px;">
              <img src="{{ url("img/paytm.png") }}" alt="paytm"></a></li>
            <li></li>
            <!--li><a href="#PayU" data-toggle="tab">PayU</a></li-->
          </ul>
        </div>

        <div class="col-xs-9">
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="cod">
            <h4>Cash on Delivery</h4>
            <div class="col-md-4">
              <span>Amount Payable: <i class="fa fa-inr"></i>&nbsp{{ $user->cart->total }}</span><br>
              <form class="btn pull-right" method="POST" action="{{ url('/checkout') }}">
                {{ csrf_field() }}
                <input type="hidden" name="total" value="{{ $user->cart->total }}">
                <button class="btn btn-success">Confirm</button>
              </form>
              </div>
            </div>
            <div class="tab-pane" id="PayTM">
            <div class="col-md-6 col-lg-6">
              <img src="{{ url("img/paytmqrc.png") }}" style="max-width:100%;">
            </div>
            <div class="col-md-4">
              <span>Amount Payable: <i class="fa fa-inr"></i>&nbsp{{ $user->cart->total }}</span><br>
              <form class="btn pull-right" method="POST" action="{{ url('/checkout') }}">
                {{ csrf_field() }}
                <input type="hidden" name="total" value="{{ $user->cart->total }}">
                <button class="btn btn-success">Confirm</button>
              </form>
              </div>
            </div>
            <div class="tab-pane" id="PayU">Comming soon</div>
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

@section('title')Checkout: @endsection