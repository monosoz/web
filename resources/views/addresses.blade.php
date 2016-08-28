@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">User</div>
        <div class="panel-body">
          <div>
            <p>Name: {{$user->name}} <a class="pull-right" href="#">edit</a></p>
            <p>Mobile Number: {{$user->mobile_number}} <a class="pull-right" href="#">edit</a></p>
            <p>Email: {{$user->email}} <a class="pull-right" href="#">edit</a></p>
          </div>
          <hr>
          <div>
            @if (count($user->locations) === 0)
            <p>No Address saved.</p>
            @else
            <div class="clearfix">
              <p>Select Default Address:</p>
                @foreach ($user->locations->sortByDesc('updated_at') as $location)
                <div class="addcard col-lg-10 col-lg-offset-1">
                  @include('blocks.addresscard')
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

@section('scripts')
    <script src="{{ url('map.js') }}"></script>
@endsection