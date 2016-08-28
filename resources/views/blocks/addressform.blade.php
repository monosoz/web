<div class="form-group">
	<label for="name" class="col-md-4 control-label">Name*</label>
	<div class="col-md-6">
		<input id="name" type="text" required="required" class="form-control" name="name" value="{{$user->name}}">
	</div>
</div>
<div class="form-group">
	<label for="mobile_number" class="col-md-4 control-label">Contact*</label>
	<div class="col-md-6">
		<input id="mobile_number" type="tel" required="required" class="form-control" name="contact" value="{{$user->mobile_number}}">
	</div>
</div>
<div class="form-group">
	<label for="pincode" class="col-md-4 control-label">Pincode*</label>
	<div class="col-md-6">
		<input id="pincode" type="text" required="required" class="form-control" name="pincode" value="{{ old('pincode') }}">
	</div>
</div>
<div class="form-group">
	<label for="address" class="col-md-4 control-label">Address*</label>
	<div class="col-md-6">
		<textarea id="address" name="address" required="required" class="form-control">{{ old('address') }}</textarea>
	</div>
</div>
<div class="form-group">
	<label for="comment" class="col-md-4 control-label">Comment</label>
	<div class="col-md-6">
		<input id="comment" type="text" value="{{ old('comment') }}" class="form-control" name="comment">
	</div>
</div>