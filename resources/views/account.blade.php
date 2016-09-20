@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Account</div>
        <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
            <div class="row"><div class="col-xs-4 col-sm-2"><h3>Name: </h3></div><div class="col-xs-8 col-sm-10" style="min-width:{{strlen($user->name)+1}}em;float:right;"><h3>{{$user->name}}</h3></div></div>
            <div class="row"><div class="col-xs-4 col-sm-2"><h3>Contact: </h3></div><div class="col-xs-8 col-sm-10"><h3>{{$user->mobile_number}}</h3></div></div>
            <div class="row"><div class="col-xs-4 col-sm-2"><h3>Email: </h3></div><div class="col-xs-8 col-sm-10" style="min-width:{{strlen($user->email)+1}}em;float:right;"><h3>{{$user->email}}</h3></div></div>
            <div class="row"><div class="col-xs-4 col-sm-2"></div><div class="col-xs-8 col-sm-10" style="min-width: 16em;"><a href="{{ url('/password/change') }}"><h3 style="color:#337ab7;">Change Password</h3></a></div></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('title'){{$user->name}}: @endsection