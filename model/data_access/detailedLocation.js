/**
 * Created by MalshaL on 5/22/2016.
 */

var map;
var infowindow;

function getUrlVars() {
    var pairs = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
        function(m,key,value) {
            pairs[key] = value;
        });
    return pairs;
}

function getSelectedVal() {
    $("#dropdownBox").find("li").click(function () {
        var type = this.id;
        var loc = document.getElementById("selectedLocation").innerHTML;
        var lat = document.getElementById("placeLat").innerHTML;
        var lng = document.getElementById("placeLong").innerHTML;
        document.location.href = 'searchResults.php?l=' + loc + '&t=' + type + '&lt=' + lat + '&lg=' + lng;
    });
}

function initMap3() {
    var loc = getUrlVars()["n"];
    loc = decodeURI(loc);
    var placeID = getUrlVars()["id"];
    document.getElementById("selectedLocation").innerHTML = loc;

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16
    });

    infowindow = new google.maps.InfoWindow();
    var service = new google.maps.places.PlacesService(map);
    service.getDetails({
            placeId: placeID
        }, function (place, stat) {
            if (stat == google.maps.places.PlacesServiceStatus.OK) {
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location
                });
                map.setCenter(place.geometry.location);

                //var name = place.name;
                var type = place.types[0].replace(/_/g, " ");
                type = type.charAt(0).toUpperCase()+type.slice(1);
                var searchQ = place.vicinity;
                var address_main = place.formatted_address;
                //document.getElementById("selectedLocation").innerHTML = name;
                document.getElementById("placeTypeBox").innerHTML = type;
                document.getElementById("placeLocationBox").innerHTML = address_main;
                document.getElementById("placeLat").innerHTML = place.geometry.location.lat();
                document.getElementById("placeLong").innerHTML = place.geometry.location.lng();
                document.getElementById("place_id").innerHTML = placeID;

                google.maps.event.addListener(marker, 'mouseover', function () {
                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
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
                    var thisPos = place.geometry.location;
                    document.getElementById("locationPhotoBox").src = "https://maps.googleapis.com/maps/api/streetview?size=300x300&location=" + thisPos.lat() + "," + thisPos.lng() + "&key=AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk";
                }

                var thisRating = place.rating;
                if (thisRating != undefined) {
                    var box = document.getElementById("userRating");
                    box.innerHTML = thisRating*2;
                    box.setAttribute("style", "visibility: visible");
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

function savePlace2(){
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

    xmlhttp.open("GET","/TourGenie/controller/SaveController.php?p_id="+p_id+"&u_id="+u_id, true);
    //xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}
