@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Account</div>
        <div class="panel-body">
          <div>
            Name: {{$user->name}}<br>
            Contact: {{$user->mobile_number}}<br>
            Email: {{$user->email}}<br>
            Password: {{"change"}}<br>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection