/**
 * Created by MalshaL on 4/29/2016.
 */
var map;
var marker;


function getSelectedVal() {
    $("#dropdownBox").find("li").click(function () {
        var type = this.id;
        var loc = document.getElementById("selectedLocation").innerHTML;
        var lat = document.getElementById("placeLat").innerHTML;
        var lng = document.getElementById("placeLong").innerHTML;
        document.location.href = 'searchResults.php?l=' + loc + '&t=' + type + '&lt=' + lat + '&lg=' + lng;
    });
}

function initMap() {
    // Try HTML5 geolocation to get the current location latitude and longitude
    var pos;
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
                                var address_main = location.formatted_address;
                                var placeID;
                                //alert("address- "+address_main+" types- "+location.types[0]);
                                //  if (location.types[0] == "premise" || location.types[0] == "point of interest" || location.types[0] == "airport" || location.types[0] == "park") {
                                placeID = location.place_id;
                                var service = new google.maps.places.PlacesService(map);
                                service.getDetails({
                                        placeId: placeID
                                    }, function (place, stat) {
                                        if (stat == google.maps.places.PlacesServiceStatus.OK) {
                                            var name = place.name;
                                            var type = place.types[0];
                                            var searchQ = place.vicinity;
                                            document.getElementById("selectedLocation").innerHTML = name;
                                            document.getElementById("placeTypeBox").innerHTML = type;
                                            document.getElementById("placeLocationBox").innerHTML = address_main;
                                            document.getElementById("placeLat").innerHTML = pos.lat;
                                            document.getElementById("placeLong").innerHTML = pos.lng;

                                            var thisRating = place.rating;
                                            if (thisRating != undefined) {
                                                var box = document.getElementById("userRating");
                                                box.innerHTML = thisRating*2;
                                                box.setAttribute("style", "visibility: visible");
                                            }


                                            google.maps.event.addListener(marker, 'mouseover', function () {
                                                infowindow.setContent('You\'re here:  <div><strong>' + place.name + '</strong><br>' +
                                                    place.vicinity + '</div>');
                                                infowindow.open(map, this);
                                            });
                                            google.maps.event.addListener(marker, 'mouseout', function () {
                                                infowindow.close();
                                            });

                                            document.getElementById("locationPhotoBox").src = "https://maps.googleapis.com/maps/api/streetview?size=300x300&location=" + pos.lat + "," + pos.lng + "&heading=180&key=AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk";

                                            var service_url = 'https://kgsearch.googleapis.com/v1/entities:search';
                                            var params = {
                                                'query': searchQ,
                                                'limit': 1,
                                                'indent': true,
                                                'key': 'AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk'
                                            };
                                            $.getJSON(service_url + '?callback=?', params, function (response) {
                                                    $.each(response.itemListElement, function (i, element) {
                                                        if (document.getElementById("placeDescriptionBox").innerHTML == "") {
                                                            $('<div>', {text: element['result']['description']}).appendTo(document.getElementById("placeDescriptionBox"));
                                                        }
                                                    });
                                                }
                                            );
                                        }
                                    }
                                );
                                // }
                                /*else {
                                 var town;
                                 for (i = 0; i < 3; i++) {
                                 var comp = location.address_components[i];
                                 if (comp.types[0] == "locality") {
                                 town = comp.long_name;
                                 }
                                 }
                                 document.getElementById("selectedLocation").value = "jjjj";
                                 document.getElementById("placeTypeBox").value = "City";
                                 alert("----"+town+"----");

                                 google.maps.event.addListener(marker, 'mouseover', function () {
                                 infowindow.setContent('You\'re here:  <div><strong>' + town + '</strong></div>');
                                 infowindow.open(map, this);
                                 });
                                 google.maps.event.addListener(marker, 'mouseout', function () {
                                 infowindow.close();
                                 });


                                 /!*var obj;
                                 if (window.XMLHttpRequest) {
                                 obj = new XMLHttpRequest();
                                 } else if (window.ActiveXObject) {
                                 obj = new ActiveXObject("Microsoft.XMLHTTP");
                                 } else {
                                 alert("Browser Doesn't Support AJAX!");
                                 }

                                 if (town !== "undefined") {
                                 if (obj !== null) {
                                 obj.onreadystatechange = function () {
                                 if (obj.readyState < 4) {
                                 // progress
                                 } else if (obj.readyState === 4) {
                                 var res = obj.responseText;
                                 var opt1 = JSON.parse(res)[0].name;
                                 var opt2 = JSON.parse(res)[0].description;
                                 var opt3 = JSON.parse(res)[0].no_of_visitors;
                                 var opt4 = JSON.parse(res)[0].image;

                                 document.getElementById("placeDescriptionBox").value = opt2;
                                 document.getElementById("userRating").value = opt3;
                                 }
                                 }

                                 obj.open("GET", "../model/data_access/GetCity.php?town=" + encodeURIComponent(town), true);
                                 //obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                 obj.send();

                                 }
                                 }
                                 *!/
                                 }*/
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
                )
                ;
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
