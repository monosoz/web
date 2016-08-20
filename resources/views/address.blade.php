@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Edit Address</div>
        <div class="panel-body">
          <div>
              <form class="form-horizontal" method="POST" action="{{ url('/user/address') }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input type="hidden" name="address_id" value="{{$location->id}}">
                <div class="col-sm-6"> <div class="form-group">
  <label for="name" class="col-md-4 control-label">Name*</label>
  <div class="col-md-6">
    <input id="name" type="text" class="form-control" name="name" value="{{$location->name}}">
  </div>
</div>
<div class="form-group">
  <label for="mobile_number" class="col-md-4 control-label">Contact*</label>
  <div class="col-md-6">
    <input id="mobile_number" type="tel" class="form-control" name="mobile" value="{{$location->mobile_number}}">
  </div>
</div>
<div class="form-group">
  <label for="pincode" class="col-md-4 control-label">Pincode*</label>
  <div class="col-md-6">
    <input id="pincode" type="text" class="form-control" name="pincode" value="{{$location->pincode}}">
  </div>
</div>
<div class="form-group">
  <label for="address" class="col-md-4 control-label">Address*</label>
  <div class="col-md-6">
    <textarea id="address" name="address" class="form-control">{{$location->address}}</textarea>
  </div>
</div>
<div class="form-group">
  <label for="comment" class="col-md-4 control-label">Comment</label>
  <div class="col-md-6">
    <input id="comment" type="text" class="form-control" name="comment" value="{{$location->comment}}">
  </div>
</div>
<input type="hidden" name="requrl" value="{{$requrl}}">
                <div id="mapinput"></div>
                </div>
                <div class="col-sm-6">
                  <div id="new_map"></div>
                </div>
<div class="col-md-6 col-md-offset-4">
  <button type="submit" class="btn btn-primary pull-right">
    <i class="fa fa-btn fa-user"></i> Save
  </button>
</div>
<p class="text-muted"><strong>*</strong> These fields are required.</p>
              </form>
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