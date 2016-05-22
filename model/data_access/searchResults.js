/**
 * Created by MalshaL on 5/1/2016.
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

function initMap2(){
    var pos;
    var loc = getUrlVars()["l"];
    loc = decodeURI(loc);
    var t = getUrlVars()["t"];
    document.getElementById("selectedType").innerHTML = t;
    document.getElementById("selectedLocation").innerHTML = loc;
    /*if(document.getElementById("selectedText").innerHTML.length>30){
        document.getElementById("selector").setAttribute("height","75px");
    }*/
    var type = getType(t);
    pos = {
        lat: getUrlVars()["lt"],
        lng: getUrlVars()["lg"]
    };

    map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(pos.lat, pos.lng),
        zoom: 16
    });
    var latlng = new google.maps.LatLng(pos.lat, pos.lng);
    //alert(pos.lng);
    infowindow = new google.maps.InfoWindow();
    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch({
        location: latlng,
        radius: 1500,
        //query: type,
        //rankBy: google.maps.places.RankBy.DISTANCE,
        type: type
    }, function (results, status) {
        document.getElementById("lat").innerHTML = pos.lat;
        document.getElementById("lng").innerHTML = pos.lng;
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            //alert("result"+results.length);
            if(results.length==0){
                var view1 = document.getElementById("contentView");
                var errorDiv1 = document.createElement("DIV");
                errorDiv1.appendChild(document.createTextNode("No results found to "+t+" near "+loc));
                view1.appendChild(errorDiv1);
            }
            else {
                var ul = document.getElementById("resultListBox");
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                    //alert('A');
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
                    if(!isNaN(rat)){
                        var thisRat = rat*2;
                        userRating.appendChild(document.createTextNode(thisRat.toString()));
                        userRating.setAttribute("style","visibility: visible");
                        infoDiv.appendChild(userRating);
                    }

                    var placeName = document.createElement("DIV");
                    placeName.setAttribute("class", "placeName");
                    var h3 = document.createElement("H3");
                    var link = document.createElement("A");                      //place name
                    link.setAttribute("href", "../view/detailedLocation.php?n="+results[i].name+"&id="+results[i].placeId);
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
                    /*btn.onclick = savePlace();*/
                    infoDiv.appendChild(btn);

                    newLi.appendChild(infoDiv);
                    ul.appendChild(newLi);
                }
            }

        }
        else{
            var view = document.getElementById("contentView");
            var errorDiv = document.createElement("DIV");
            errorDiv.appendChild(document.createTextNode("Error occurred while connecting to Google services"));
            view.appendChild(errorDiv);
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
    if(type=='visit'){ return 'park'}
    if(type=='fuel'){ return 'gas_station'}
}