/**
 * Created by MalshaL on 5/1/2016.
 */

var map;
var infowindow;
var pos;

function getSelectedVal(){
    $("#dropdownBox").find("li").click(function() {
        var type = this.id;
        var loc = document.getElementById("selectedLocation").innerHTML;
        document.location.href = 'searchResults.php?l='+loc+'&t='+type+'&lt='+pos.lat+'&lg='+pos.lng;
    });
}

function getUrlVars() {
    var pairs = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
        function(m,key,value) {
            pairs[key] = value;
        });
    return pairs;
}

function initMap2(){
    var loc = getUrlVars()["l"];
    loc = decodeURI(loc);
    var t = getUrlVars()["t"];
    document.getElementById("selectedType").innerHTML = t;
    document.getElementById("selectedLocation").innerHTML = loc;
    if(document.getElementById("selectedText").innerHTML.length>30){
        document.getElementById("selector").setAttribute("height","75px");
    }
    var type = getType(t);
    pos = {
        lat: getUrlVars()["lt"],
        lng: getUrlVars()["lg"]
    };
    var latlng = new google.maps.LatLng(pos.lat, pos.lng);
    map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 16
    });
    //alert(pos.lng);
    infowindow = new google.maps.InfoWindow();
    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch({
        location: latlng,
        radius: 1000,
        //query: type,
        type: type
    }, function (results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            //alert("result"+results.length);
            var ul = document.getElementById("resultListBox");
            for (var i = 0; i < results.length; i++) {
                createMarker(results[i]);
                //alert('A');
                var newLi = document.createElement("LI");                    //new list item
                newLi.setAttribute("class", "placeView");

                var photoDiv = document.createElement("DIV");
                photoDiv.setAttribute("id", "photoContainer");

                var img = document.createElement("IMG");                    //photo

                if(results[i].photos!=undefined){
                    img.setAttribute("src", results[i].photos[0].getUrl({'maxWidth': 180, 'maxHeight': 180}));
                }
                photoDiv.appendChild(img);
                newLi.appendChild(photoDiv);

                var infoDiv = document.createElement("DIV");
                infoDiv.setAttribute("id", "infoContainer");

                var userRating = document.createElement("DIV");             //user rating
                userRating.setAttribute("class", "userRating");
                userRating.appendChild(document.createTextNode("9"));
                infoDiv.appendChild(userRating);

                var placeName = document.createElement("DIV");
                placeName.setAttribute("class", "placeName");
                var h3 = document.createElement("H3");
                var link = document.createElement("A");                      //place name
                link.setAttribute("href", results[i].name);
                link.appendChild(document.createTextNode(results[i].name));
                h3.appendChild(link);
                placeName.appendChild(h3);
                infoDiv.appendChild(placeName);

                var placeType = document.createElement("DIV");                 //place type
                placeType.setAttribute("class", "placeType");
                placeType.appendChild(document.createElement("P").appendChild(document.createTextNode(results[i].types[0])));
                infoDiv.appendChild(placeType);

                var placeLocation = document.createElement("DIV");               //place type
                placeLocation.setAttribute("class", "placeLocation");
                placeLocation.appendChild(document.createElement("P").appendChild(document.createTextNode(results[i].vicinity)));
                infoDiv.appendChild(placeLocation);

                var btn = document.createElement("BUTTON");        // button
                var t = document.createTextNode("Save");
                btn.appendChild(t);
                btn.onclick = savePlace();
                infoDiv.appendChild(btn);

                newLi.appendChild(infoDiv);
                ul.appendChild(newLi);
            }
        }
    });
}

function createMarker(place) {
    var placeLoc = place.geometry.location;
    var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
    });

    google.maps.event.addListener(marker, 'mouseover', function() {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
    });
    google.maps.event.addListener(marker, 'mouseout', function () {
        infowindow.close();
    })
}

function getType(type){
    if(type=='eat'){ return 'restaurant'}
    if(type=='stay'){ return 'lodging'}
    if(type=='shop'){ return 'store'}
    if(type=='visit'){ return 'amusement_park'}
    if(type=='fuel'){ return 'gas_station'}
}