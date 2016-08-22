@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-10 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">
<h4>CONTACT US</h4>
		</div>
        <div class="panel-body">

<div class="clearfix">
<form id="contact-form" method="post" action="{{ url('/contactus') }}" role="form">
{{ csrf_field() }}
    <div class="messages"></div>

    <div class="controls">

        @if (Auth::guest())
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">Name *</label>
                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your name *" required="required" data-error="Name is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">Email *</label>
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">Phone *</label>
                    <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                	<span>Name: {{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                	<span>Email: {{ Auth::user()->email }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                	<span>Phone: {{ Auth::user()->mobile_number }}</span>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Message *</label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Your message." rows="4" required="required" data-error="Please,leave us a message."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-success btn-send pull-right" value="Send message">
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

@endsection