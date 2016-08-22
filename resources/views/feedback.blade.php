@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Feedback</div>
        <div class="panel-body">
          <div>
            <p>Name: {{$user->name}}</p>
            <p>Phone: {{$user->mobile_number}}</p>
            <p>Email: {{$user->email}}</p>
          </div>
          <hr>
          <div>
            <div class="clearfix">
<form id="contact-form" method="post" action="{{ url('/feedback') }}" role="form">
{{ csrf_field() }}
    <div class="messages"></div>

    <div class="controls">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Comment *</label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Write your comment." rows="4" required="required" data-error="Please,leave us a message."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-success btn-send" value="Send message">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted"><strong>*</strong> These fields are required.</p>
            </div>
        </div>
    </div>

</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection