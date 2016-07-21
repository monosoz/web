	<div class="clearfix">
	<div class="add-text col-xs-6">
		<span class="add-field"><h>Name:</h></span><h>{{$location->name}}</h><br>
		<span class="add-field"><h>Contact:</h></span><h>{{$location->mobile_number}}</h><br>
		<span class="add-field"><h>Address:</h></span><h>{{$location->address}}</h><br>
		<span class="add-field"><h>Pincode:</h></span><h>{{$location->pincode}}</h><br>
		
	</div>
	<div class="add-map col-xs-6 col-sm-4">
	<img class="img-responsive pull-right" src={{"https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyCfq4C_gKmaC-onksNumXb9cWfY4omo3pE&center=28.5383277,77.1980605&zoom=11&size=200x200&maptype=roadmap&markers=color:red|" . $location->lat . "," . $location->lng}}>
	</div>
	<div class="add-options pull-down">
              <form class="btn" method="POST" action="{{ url('/checkout') }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input type="hidden" name="address_id" value="{{$location->id}}">
			<button>Sellect Address</button>
			</form>
			<form class="btn pull-right" action="{{ url('/user/address') }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <input type="hidden" name="address_id" value="{{$location->id}}">
			<button type="submit">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
			</button>
			</form>
			<form class="btn pull-right" action="{{ url('/user/address') }}" method="POST">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <input type="hidden" name="address_id" value="{{$location->id}}">
                <input type="hidden" name="requrl" value="/checkout">
			<button type="submit">
			<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			</button>
			</form>
		</div>
	</div>