@extends('layouts.app')

@section('content')
  @if (count($products) === 0)
    <p>No content on this blog yet. </p>
  @else
    @foreach ($products as $product)
    <div class="col-md-4 col-sm-6 iccon">
      <div class="itemcard clearfix">
        <img class="pthumb" src="data:image/jpeg;base64,{{base64_encode($product->image)}}">
        <h3>{{$product->name}}</h3>
        <p>{{$product->description}}</p>
        <button type="button" class="btn btn-primary">
        <i class="fa fa-inr"></i> 000</button>
      </div>
    </div>
    @endforeach
  @endif
@stop