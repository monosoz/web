<div class="iccon col-lg-10 col-lg-offset-1">
  <div class="card clearfix">
    <img class="mthumb" src={{"https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyCfq4C_gKmaC-onksNumXb9cWfY4omo3pE&center=28.5383277,77.1980605&zoom=12&size=200x200&maptype=roadmap&markers=color:red|" . $location->lat . "," . $location->lng}}>

    <span class="pname">{{$location->address}}</span>
  </div>
</div>