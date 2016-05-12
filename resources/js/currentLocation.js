/**
 * Created by MalshaL on 4/29/2016.
 */
var map;
var marker;
var pos;

function getSelectedVal() {
    $("#dropdownBox").find("li").click(function () {
        var type = this.id;
        var loc = document.getElementById("selectedLocation").innerHTML;
        document.location.href = 'searchResults.php?l=' + loc + '&t=' + type + '&lt=' + pos.lat + '&lg=' + pos.lng;
    });
}

/* geoLocation */
function initMap() {
    // Try HTML5 geolocation to get the current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
                pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: position.coords.latitude, lng: position.coords.longitude},
                    zoom: 14
                });
                marker = new google.maps.Marker({
                    map: map,
                    position: pos
                });
                var infowindow = new google.maps.InfoWindow();

                //use geocoding to get the address of current location
                var geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(pos.lat, pos.lng);
                geocoder.geocode({
                        'latLng': latlng
                    }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                var location = results[0];
                                var placeID;
                                /*if (location.types[0] == "premise" || location.types[0] == "point of interest") {*/
                                    placeID = location.place_id;
                                var service = new google.maps.places.PlacesService(map);
                                    service.getDetails({
                                            placeId: placeID
                                        }, function (place, stat) {
                                            if (stat == google.maps.places.PlacesServiceStatus.OK) {
                                                var name = place.name;
                                                var address = place.vicinity;
                                                var type = place.types[0];
                                                document.getElementById("selectedLocation").innerHTML = name;
                                                document.getElementById("placeTypeBox").innerHTML = type;
                                                document.getElementById("placeLocationBox").innerHTML = address;

                                                google.maps.event.addListener(marker, 'mouseover', function () {
                                                    infowindow.setContent('You\'re here:  <div><strong>' + place.name + '</strong><br>' +
                                                        place.vicinity + '</div>');
                                                    infowindow.open(map, this);
                                                });
                                                google.maps.event.addListener(marker, 'mouseout', function () {
                                                    infowindow.close();
                                                })

                                                /*if (place.photos != undefined) {
                                                    document.getElementById("locationPhotoBox").src = (place.photos[0].getUrl({
                                                        'maxWidth': 300,
                                                        'maxHeight': 300
                                                    }));
                                                }*/
                                                var service_url = 'https://kgsearch.googleapis.com/v1/entities:search';
                                                var params = {
                                                    'query': name,
                                                    'limit': 1,
                                                    'indent': true,
                                                    'key': 'AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk'
                                                };
                                                $.getJSON(service_url + '?callback=?', params, function (response) {
                                                    $.each(response.itemListElement, function (i, element) {
                                                        $('<div>', {text: element['result']['description']}).appendTo(document.getElementById("placeDescriptionBox"));
                                                    });
                                                });
                                            }
                                        }
                                    )

                            }
                            else {
                                alert("address not found");
                            }
                        }
                        else {
                            //document.getElementById("location").innerHTML="Geocoder failed due to: " + status;
                            //alert("Geocoder failed due to: " + status);
                        }
                    }
                );
            },
            function () {
                handleLocationError(true, map.getCenter());
            }
        )
        ;
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}
