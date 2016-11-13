@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Orders</div>
        <div class="panel-body">
          <div>
            @if (count($orders) === 0)
            <p>Nothing to show here!</p>
            @else
            <div class="clearfix">
                @foreach ($orders->sortByDesc('updated_at') as $cart)
                <div class="">
@if (!$cart->is('pending'))
@include('blocks.ordercard')
@endif
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
@if($cart_status>10)
  @include('blocks.welcome')
@endif

<div class="modal fade" id="paytm" tabindex="-1" role="dialog" aria-labelledby="paytm" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="custom-title">Pay using paytm</h4>
            </div>
              <img src="{{ url("img/paytmqrc.png") }}" style="max-width:100%;display: block;margin: auto;">
        </div>
    </div>
</div>


@endsection

@section('scripts')
  @if($cart_status>10)
    <script type="text/javascript">
        $(window).load(function(){
            $('#wModal').modal('show');
        });
    </script>
  @endif
@endsection

@section('title')Orders: @endsection