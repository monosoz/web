<div class="form-group">
	<label for="name" class="col-md-4 control-label">Name</label>
	<div class="col-md-6">
		<input id="name" type="text" class="form-control" name="name" value="{{$user->name}}">
	</div>
</div>
<div class="form-group">
	<label for="mobile_number" class="col-md-4 control-label">Contact</label>
	<div class="col-md-6">
		<input id="mobile_number" type="tel" class="form-control" name="mobile" value="{{$user->mobile_number}}">
	</div>
</div>
<div class="form-group">
	<label for="pincode" class="col-md-4 control-label">Pincode</label>
	<div class="col-md-6">
		<input id="pincode" type="text" class="form-control" name="pincode" value="110017">
	</div>
</div>
<div class="form-group">
	<label for="address" class="col-md-4 control-label">Address</label>
	<div class="col-md-6">
		<textarea id="address" name="address" class="form-control">New Delhi</textarea>
	</div>
</div>
<div class="form-group">
	<label for="comment" class="col-md-4 control-label">Comment</label>
	<div class="col-md-6">
		<input id="comment" type="text" class="form-control" name="comment">
	</div>
</div>
<div class="col-md-6 col-md-offset-4">
	<button type="submit" class="btn btn-primary">
		<i class="fa fa-btn fa-user"></i> Add Address
	</button>
</div>