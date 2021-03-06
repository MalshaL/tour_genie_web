/**
 * Created by MalshaL on 5/1/2016.
 */

var map;
var infowindow;

function getUrlVars() {
    var pairs = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
        function (m, key, value) {
            pairs[key] = value;
        });
    return pairs;
}

function initMap2() {
    document.getElementById("resultListBox").innerHTML = "";
    var pos;
    var loc = getUrlVars()["l"];
    loc = decodeURI(loc);
    var t = getUrlVars()["t"];
    document.getElementById("selectedType").innerHTML = t;
    document.getElementById("selectedLocation").innerHTML = loc;
    var types = getType(t);
    pos = {
        lat: getUrlVars()["lt"],
        lng: getUrlVars()["lg"]
    };
    document.getElementById("lat").innerHTML = pos.lat;
    document.getElementById("lng").innerHTML = pos.lng;

    map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(pos.lat, pos.lng),
        zoom: 14
    });
    var latlng = new google.maps.LatLng(pos.lat, pos.lng);
    //alert(pos.lng);
    infowindow = new google.maps.InfoWindow();
    var ul = document.getElementById("resultListBox");
    var service = new google.maps.places.PlacesService(map);

    for (var j = 0; j < types.length; j++) {
        service.nearbySearch({
            location: latlng,
            radius: 1500,
            //query: type,
            //rankBy: google.maps.places.RankBy.DISTANCE,
            type: types[j]
        }, function (results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                //alert("result"+results.length);
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                    var p_id = results[i].place_id;
                    var newLi = document.createElement("LI");                    //new list item
                    newLi.setAttribute("class", "placeView");

                    var photoDiv = document.createElement("DIV");
                    photoDiv.setAttribute("id", "photoContainer");

                    var img = document.createElement("IMG");                    //photo
                    if (results[i].photos != undefined) {
                        img.setAttribute("src", results[i].photos[0].getUrl({'maxWidth': 180, 'maxHeight': 180}));
                    }
                    else {
                        var thisPos = results[i].geometry.location;
                        img.setAttribute("src", "https://maps.googleapis.com/maps/api/streetview?size=300x300&location=" + thisPos.lat() + "," + thisPos.lng() + "&key=AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk");
                    }
                    photoDiv.appendChild(img);
                    newLi.appendChild(photoDiv);

                    var infoDiv = document.createElement("DIV");
                    infoDiv.setAttribute("id", "infoContainer");

                    var userRating = document.createElement("DIV");             //user rating
                    userRating.setAttribute("class", "userRating");
                    var rat = results[i].rating;
                    if (!isNaN(rat)) {
                        var thisRat = rat * 2;
                        userRating.appendChild(document.createTextNode(thisRat.toString()));
                        userRating.setAttribute("style", "visibility: visible");
                        infoDiv.appendChild(userRating);
                    }

                    var placeName = document.createElement("DIV");
                    placeName.setAttribute("class", "placeName");
                    var h3 = document.createElement("H3");
                    var link = document.createElement("A");                      //place name
                    link.setAttribute("href", "../view/detailedLocation.php?n=" + results[i].name + "&id=" + p_id);
                    link.appendChild(document.createTextNode(results[i].name));
                    h3.appendChild(link);
                    placeName.appendChild(h3);
                    infoDiv.appendChild(placeName);

                    var placeType = document.createElement("DIV");                 //place type
                    placeType.setAttribute("class", "placeType");
                    var type = results[i].types[0].replace(/_/g, " ");
                    type = type.charAt(0).toUpperCase() + type.slice(1);
                    placeType.appendChild(document.createElement("P").appendChild(document.createTextNode(type)));
                    infoDiv.appendChild(placeType);

                    var placeLocation = document.createElement("DIV");               //place type
                    placeLocation.setAttribute("class", "placeLocation");
                    placeLocation.appendChild(document.createElement("P").appendChild(document.createTextNode(results[i].vicinity)));
                    infoDiv.appendChild(placeLocation);

                    var btnDiv = document.createElement("DIV");
                    btnDiv.setAttribute("class", "buttonOptions");
                    var btn = document.createElement("A");        // button
                    btn.setAttribute("class", "btn btn-default");
                    btn.setAttribute("id", "btn" + i);
                    var icon = document.createElement("I");
                    icon.setAttribute("class", "fa fa-bookmark");
                    btn.appendChild(icon);
                    var t = document.createTextNode(" Save");
                    btn.appendChild(t);
                    var u_id = document.getElementById("u_id").innerHTML;
                    if (u_id != 'null') {
                        btn.setAttribute("p_id", p_id);
                        btn.setAttribute("u_id", u_id);
                        btn.onclick = function () {
                            savePlace(this.getAttribute("p_id"), this.getAttribute("u_id"), this.getAttribute("id"));
                        }
                    }
                    else {
                        btn.setAttribute('disabled', 'disabled');
                    }
                    btnDiv.appendChild(btn);
                    infoDiv.appendChild(btnDiv);

                    newLi.appendChild(infoDiv);
                    ul.appendChild(newLi);
                }
            }
            else {

            }
        });
    }
}

function createMarker(place) {
    //var placeLoc = place.geometry.location;
    var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
    });

    google.maps.event.addListener(marker, 'mouseover', function () {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
    });
    google.maps.event.addListener(marker, 'mouseout', function () {
        infowindow.close();
    })
}

function getType(type) {
    if (type == 'eat') {
        return ['restaurant', 'meal_takeaway', 'meal_delivery','cafe']
    }
    if (type == 'stay') {
        return ['lodging']
    }
    if (type == 'visit') {
        return ['park', 'museum', 'aquarium', 'zoo', 'hindu_temple', 'mosque', 'church']
    }
    if (type == 'fun') {
        return ['art_gallery', 'movie_rental', 'night_club', 'movie_theater']
    }
    if (type == 'shop') {
        return ['shopping_mall', 'store', 'clothing_store', 'convenience_store', 'department_store']
    }
    if (type == 'money') {
        return ['atm', 'bank']
    }
    if (type == 'fuel') {
        return ['gas_station', 'car_repair', 'car_wash', 'car_rental']
    }
    if (type == 'travel') {
        return ['bus_station', 'train_station', 'transit_station', 'airport', 'subway_station']
    }
    if (type == 'health') {
        return ['doctor', 'hospital', 'pharmacy', 'dentist', 'spa', 'gym', 'hair_care']
    }
    if (type == 'emergency') {
        return ['police', 'fire_station']
    }
}

function savePlace(p_id, u_id, id) {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(id).setAttribute("disabled", "disabled");
        }
    };

    xmlhttp.open("GET", "/TourGenie/controller/saveController.php?p_id=" + p_id + "&u_id=" + u_id, true);
    //xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}