function getPlaces() {
    var u_id = document.getElementById("u_id").innerHTML;
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert(xmlhttp.responseText);
            return xmlhttp.responseText;
        }
    };

    xmlhttp.open("GET", "/TourGenie/controller/getHistoryController.php?u_id=" + u_id, true);
    //xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function handleHistory() {
    var arr;

    var u_id = document.getElementById("u_id").innerHTML;
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert(xmlhttp.responseText);
            arr = xmlhttp.responseText;
            arr = arr.slice(99);
            var response = JSON.parse(arr);
            var i;
            if (response == undefined) {
                alert("ddddd");
            }
            else {
                alert("sssssssssssss");
                alert(response[0].place_id);
                var ul = document.getElementById("resultListBox");
                var pos = getLatLng();
                var position = new google.maps.LatLng(pos);
                map = new google.maps.Map(document.getElementById('map'), {
                    center: position,
                    zoom: 8
                });

                infowindow = new google.maps.InfoWindow();
                var service = new google.maps.places.PlacesService(map);

                for (i = 0; i < response.length; i++) {
                    var place_id = response[i].place_id;
                    var date = response[i].date;
                    var times = response[i].times_visited;
                    service.getDetails({
                            placeId: place_id
                        }, function (place, stat) {
                            if (stat == google.maps.places.PlacesServiceStatus.OK) {
                                createMarker(place);

                                var p_id = place.place_id;
                                var newLi = document.createElement("LI");                    //new list item
                                newLi.setAttribute("class", "placeView");

                                var photoDiv = document.createElement("DIV");
                                photoDiv.setAttribute("id", "photoContainer");

                                var img = document.createElement("IMG");                    //photo
                                if (place.photos != undefined) {
                                    img.setAttribute("src", place.photos[0].getUrl({
                                        'maxWidth': 180,
                                        'maxHeight': 180
                                    }));
                                }
                                else {
                                    var thisPos = place.geometry.location;
                                    img.setAttribute("src", "https://maps.googleapis.com/maps/api/streetview?size=300x300&location=" + thisPos.lat() + "," + thisPos.lng() + "&key=AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk");
                                }
                                photoDiv.appendChild(img);
                                newLi.appendChild(photoDiv);

                                var infoDiv = document.createElement("DIV");
                                infoDiv.setAttribute("id", "infoContainer");

                                var userRating = document.createElement("DIV");             //user rating
                                userRating.setAttribute("class", "userRating");
                                var rat = place.rating;
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
                                link.setAttribute("href", "../view/detailedLocation.php?n=" + place.name + "&id=" + p_id);
                                link.appendChild(document.createTextNode(place.name));
                                h3.appendChild(link);
                                placeName.appendChild(h3);
                                infoDiv.appendChild(placeName);

                                var placeType = document.createElement("DIV");                 //place type
                                placeType.setAttribute("class", "placeType");
                                var type = place.types[0].replace(/_/g, " ");
                                type = type.charAt(0).toUpperCase() + type.slice(1);
                                placeType.appendChild(document.createElement("P").appendChild(document.createTextNode(type)));
                                infoDiv.appendChild(placeType);

                                var placeLocation = document.createElement("DIV");               //place location
                                placeLocation.setAttribute("class", "placeLocation");
                                placeLocation.appendChild(document.createElement("P").appendChild(document.createTextNode(place.vicinity)));
                                infoDiv.appendChild(placeLocation);

                                var placeDate = document.createElement("DIV");               //place date
                                placeDate.setAttribute("class", "placeDate");
                                placeDate.appendChild(document.createElement("P").appendChild(document.createTextNode("Last visited on " + date)));
                                infoDiv.appendChild(placeDate);

                                var placeTimes = document.createElement("DIV");               //place date
                                placeTimes.setAttribute("class", "placeDate");
                                if (times == 1) {
                                    placeTimes.appendChild(document.createElement("P").appendChild(document.createTextNode("Been here " + times + " time")));
                                } else {
                                    placeTimes.appendChild(document.createElement("P").appendChild(document.createTextNode("Been here " + times + " times")));
                                }
                                infoDiv.appendChild(placeTimes);

                                var btnDiv1 = document.createElement("DIV");
                                btnDiv1.setAttribute("class", "buttonOptions");
                                var btn1 = document.createElement("A");        // button
                                btn1.setAttribute("class", "btn btn-default");
                                btn1.setAttribute("id", "btn" + i);
                                var icon1 = document.createElement("I");
                                icon1.setAttribute("class", "fa fa-crosshairs");
                                btn1.appendChild(icon1);
                                var t1 = document.createTextNode(" See Tour");
                                btn1.appendChild(t1);
                                var u_id = document.getElementById("u_id").innerHTML;
                                if (u_id != 'null') {
                                    btn1.setAttribute("p_id", p_id);
                                    btn1.setAttribute("u_id", u_id);
                                    btn1.onclick = function () {
                                        addToTour(this.getAttribute("p_id"), this.getAttribute("u_id"), this.getAttribute("id"));
                                    }
                                }
                                else {
                                    btn.setAttribute('disabled', 'disabled');
                                }
                                btnDiv1.appendChild(btn1);
                                infoDiv.appendChild(btnDiv1);

                                var btnDiv = document.createElement("DIV");
                                btnDiv.setAttribute("class", "buttonOptions");
                                var btn = document.createElement("A");        // button
                                btn.setAttribute("class", "btn btn-default");
                                btn.setAttribute("id", "btnR" + i);
                                var icon = document.createElement("I");
                                icon.setAttribute("class", "fa fa-crosshairs");
                                btn.appendChild(icon);
                                var t = document.createTextNode(" Remove");
                                btn.appendChild(t);
                                if (u_id != 'null') {
                                    btn.setAttribute("p_id", p_id);
                                    btn.setAttribute("u_id", u_id);
                                    btn.onclick = function () {
                                        removePlace(this.getAttribute("p_id"), this.getAttribute("u_id"), this.getAttribute("id"));
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
                    );
                }
            }
        }
    }
    ;

    xmlhttp.open("GET", "/TourGenie/controller/getHistoryController.php?u_id=" + u_id, true);
    //xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();

    //var response = JSON.parse(response1);


}

function createMarker(place) {
    var placeLoc = place.geometry.location;
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

function removePlace(p_id, u_id, id) {
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

    xmlhttp.open("GET", "/TourGenie/controller/removeHistoryController.php?p_id=" + p_id + "&u_id=" + u_id, true);
    //xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function seeTour() {
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

    xmlhttp.open("GET", "/TourGenie/controller/removePlacesController.php?p_id=" + p_id + "&u_id=" + u_id, true);
    //xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function getLatLng() {
    var pos;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            return position;
        });
    }
}