
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
                                            var type = place.types[0].replace(/_/g, " ");
                                            type = type.charAt(0).toUpperCase()+type.slice(1);
                                            var searchQ = place.vicinity;
                                            document.getElementById("selectedLocation").innerHTML = name;
                                            document.getElementById("placeTypeBox").innerHTML = type;
                                            document.getElementById("placeLocationBox").innerHTML = address_main;
                                            document.getElementById("placeLat").innerHTML = pos.lat;
                                            document.getElementById("placeLong").innerHTML = pos.lng;
                                            document.getElementById("place_id").innerHTML = placeID;

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

                                            if (place.photos != undefined) {
                                                document.getElementById("locationPhotoBox").src = place.photos[0].getUrl({'maxWidth': 300, 'maxHeight': 300});
                                            }
                                            else {
                                                document.getElementById("locationPhotoBox").src = "https://maps.googleapis.com/maps/api/streetview?size=300x300&location=" + pos.lat + "," + pos.lng + "&heading=180&key=AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk";
                                            }

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
                            }
                            else {
                                alert("address not found");
                            }
                        }
                        else {

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

function saveCurrLoc(){
    var p_id = document.getElementById("place_id").innerHTML;
    var u_id = document.getElementById("u_id").innerHTML;
    var id = "saveBtn";
    var xmlhttp;
    if (window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    } else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if(xmlhttp.readyState==4 &&xmlhttp.status==200){
            document.getElementById(id).setAttribute("disabled","disabled");
        }
    };

    xmlhttp.open("GET","/TourGenie/controller/saveController.php?p_id="+p_id+"&u_id="+u_id, true);
    //xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function saveHistory(){
    var p_id = document.getElementById("place_id").innerHTML;
    var u_id = document.getElementById("u_id").innerHTML;
    var id = "checkinBtn";
    var date = new Date().toJSON().slice(0,10);
    var xmlhttp;
    if (window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    } else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if(xmlhttp.readyState==4 &&xmlhttp.status==200){
            document.getElementById(id).setAttribute("disabled","disabled");
        }
    };

    xmlhttp.open("GET","/TourGenie/controller/historyController.php?p_id="+p_id+"&u_id="+u_id+"&date="+date, true);
    //xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}
