@extends('layouts.opapp')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Feedbacks</div>
        <div class="panel-body">
            @if (count($feedbacks) === 0)
            <p>Nothing to show here!</p>
            @else

{{--*/ $opcal = new stdClass() /*--}}
{{--*/ $opcal->total = 0 /*--}}
{{--*/ $opcal->off = 0 /*--}}
{{--*/ $opcal->ocount = 0 /*--}}
{{--*/ $opcal->pcount = 0 /*--}}


                @foreach ($feedbacks->sortByDesc('updated_at') as $feedback)
<div>
    @if($feedback->user_id!=null)
            <p>Name: {{$feedback->user->name}} <a href="?u={{$feedback->user->id}}">({{$feedback->user->id}})</a></p>
            <p>Phone: {{$feedback->user->mobile_number}}</p>
            <p>Email: {{$feedback->user->email}}</p>
    @endif
Name: {{$feedback->name}}<br>
{{$feedback->created_at}}<br>
Comment: {{$feedback->comment}}<br>
</div>
<hr>
                @endforeach
<div style="padding: 31px; position: fixed; left: 0; right: 0; bottom: 0; background-color: #eee; z-index: 1;">
<span class="col-sm-3 col-xs-6">Total: {{ $opcal->total }}</span>
<span class="col-sm-3 col-xs-6">Discount: {{ $opcal->off }}</span>
<span class="col-sm-3 col-xs-6">Order Count: {{ $opcal->ocount }}</span>
<span class="col-sm-3 col-xs-6">Pizza Count: {{ $opcal->pcount }}</span>
</div>
            @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('stylesheet')
@endsection

@section('title')feedbacks: @endsection