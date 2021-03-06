function geoFindMe() {
  var output = document.getElementById("out");

  if (!navigator.geolocation){
    output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
    return;
  }

  function success(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;

    output.innerHTML = '<p>Latitude is ' + latitude + '° &nbspLongitude is ' + longitude + '°</p>';

    var img = new Image();
    img.src = "https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyCfq4C_gKmaC-onksNumXb9cWfY4omo3pE&center=" + latitude + "," + longitude + "&zoom=16&size=400x300&sensor=false";

    output.appendChild(img);
  };

  function error() {
    output.innerHTML = "Unable to retrieve your location";
  };

  output.innerHTML = "<p>Locating…</p>";

  navigator.geolocation.getCurrentPosition(success, error);
}

var map;
var monosoz_latlng = {lat: 28.5383277, lng: 77.1980605};
var markers = [];

function Reset(controlDiv, map) {
  controlDiv.style.padding = '8px';
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = 'rgb(255, 255, 255)';
  controlUI.style.border='1px solid';
  controlUI.style.cursor = 'pointer';
  controlUI.style.textAlign = 'center';
  controlUI.title = 'Reset';
  controlDiv.appendChild(controlUI);
  var controlText = document.createElement('div');
  controlText.style.fontFamily='Roboto, Arial,sans-serif';
  controlText.style.fontSize='11px';
  controlText.style.paddingLeft = '4px';
  controlText.style.paddingRight = '4px';
  controlText.innerHTML = '<b>Reset<b>'
  controlUI.appendChild(controlText);

  // Setup click-event listener: simply set the map to London
  google.maps.event.addDomListener(controlUI, 'click', function() {

    geolocate();
    map.setCenter(monosoz_latlng)
  });
}

function initMap() {

  map = new google.maps.Map(document.getElementById('new_map'), {
    zoom: 12,
    center: monosoz_latlng,
    draggableCursor: 'pointer',
    draggingCursor: 'move',
    streetViewControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  // Create a DIV to hold the control and call HomeControl()
  var resetDiv = document.createElement('div');
  var reset = new Reset(resetDiv, map);
  //  homeControlDiv.index = 1;
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(resetDiv);
  var image = 'img/map_store.png';
        var storeMarker = new google.maps.Marker({
          position: monosoz_latlng,
          map: map,
          icon: image
        });
  // This event listener will call addMarker() when the map is clicked.
  map.addListener('click', function(event) {
    reMarker(event.latLng);
  });

  // Adds a marker at user location.
  geolocate();
}

function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      clearMarkers();
      addMarker(geolocation);
    });
  }
}

function reCenter(){
  map.setCenter(monosoz_latlng);
  map.setZoom(12);
}

function reMarker(location) {
  clearMarkers();
  addMarker(location);
}

// Adds a marker to the map and push to the array.
function addMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markers.push(marker);
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
}

$(document).ready(function(e) {
  initMap();
  geoFindMe();
});