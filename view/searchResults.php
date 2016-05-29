
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Genie | Search Results</title>
    <?php include '../templates/css.php';
    error_reporting(E_ERROR);
    ?>
    <?php
    include '../templates/autocomplete.php';
    error_reporting(E_ERROR);
    ?>
    <?php include '../model/data_access/placesModel.php';
    include '../model/entity/savedPlace.php'; ?>
</head>

<body onload="initAutocomplete()">
<header>
    <?php include '../templates/header.php';
    error_reporting(E_ERROR);
    ?>
</header>

<main>
    <div id="container">
        <div id="contentView">
            <div class="col-md-12" id="selector">
                <div class="col-md-9">
                    <p style="margin-top: 10px" id="selectedText">Showing places to <b id="selectedType"></b> near <b id="selectedLocation"></b></p>
                </div>
                <div class="col-md-3" style="padding-left: 0px; padding-top: 15px">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Change category <span
                                    class="caret"></span></button>
                            <ul class="dropdown-menu" id="dropdownBox">
                                <li id="eat"><a href="#" onclick="getSelectedVal()"><i class="fa fa-cutlery fa-fw" style="color: #2f7ad6"></i> Eat</a></li>
                                <li id="stay"><a href="#" onclick="getSelectedVal()"><i class="fa fa-bed fa-fw" style="color: #2f7ad6"></i> Stay</a></li>
                                <li id="visit"><a href="#" onclick="getSelectedVal()"><i class="fa fa-camera fa-fw" style="color: #2f7ad6"></i> Sight-seeing</a></li>
                                <li id="fun"><a href="#" onclick="getSelectedVal()"><i class="fa fa-music fa-fw" style="color: #2f7ad6"></i> Entertain</a></li>
                                <li id="shop"><a href="#" onclick="getSelectedVal()"><i class="fa fa-shopping-cart fa-fw" style="color: #2f7ad6"></i> Shop</a></li>
                                <li id="money"><a href="#" onclick="getSelectedVal()"><i class="fa fa-usd fa-fw" style="color: #2f7ad6"></i> Bank</a></li>
                                <li id="fuel"><a href="#" onclick="getSelectedVal()"><i class="fa fa-automobile fa-fw" style="color: #2f7ad6"></i> Fuel & repair</a></li>
                                <li id="travel"><a href="#" onclick="getSelectedVal()"><i class="fa fa-subway fa-fw" style="color: #2f7ad6"></i> Travel</a></li>
                                <li id="health"><a href="#" onclick="getSelectedVal()"><i class="fa fa-medkit fa-fw" style="color: #dd463b"></i> Health</a></li>
                                <li id="emergency"><a href="#" onclick="getSelectedVal()"><i class="fa fa-ambulance fa-fw" style="color: #dd463b"></i> Emergency</a></li>
                            </ul>
                        </div><!-- /btn-group -->
                    </div>
                </div>
            </div>
            <div id="resultView">
                <ul class="resultList" style="list-style: none; padding-left: 0" id="resultListBox">

                </ul>
            </div>
            <div id="lat" style="visibility: hidden"></div>
            <div id="lng" style="visibility: hidden"></div>
        </div>
        <div id="myPlacesMapView">
            <div id="map"></div>
        </div>
    </div>
</main>
<?php include '../templates/js.php' ?>
<script src="../model/data_access/searchResults.js"></script>

<script>document.onload = initMap2()</script>

<script>function getSelectedVal() {
        $("#dropdownBox").find("li").click(function () {
            var type = this.id;
            var loc = document.getElementById("selectedLocation").innerHTML;
            var lat = document.getElementById("lat").innerHTML;
            var lng = document.getElementById("lng").innerHTML;

            document.location.href = 'searchResults.php?l=' + loc + '&t=' + type + '&lt=' + lat + '&lg=' + lng;
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP6BFWsxWoI9Ep8bHeo4bwlY0mfpRSesw&callback=initMap2" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk&libraries=places&callback=initMap2&language=en" async defer></script>
<script>
    document.onreadystatechange = function(){
        if(document.readyState === 'complete'){
            if (document.getElementById('resultListBox').getElementsByTagName('li').length == 0) {
                var newLi2 = document.createElement("LI");
                var errorDiv = document.createElement("DIV");               //place type
                errorDiv.setAttribute("class", "searchError");
                var error = "No results found. \nPlease try a different search.";
                errorDiv.appendChild(document.createElement("P").appendChild(document.createTextNode(error)));
                newLi2.appendChild(errorDiv);
                document.getElementById('resultListBox').appendChild(newLi2);
            }
        }
    }
</script>
</body>
</html>