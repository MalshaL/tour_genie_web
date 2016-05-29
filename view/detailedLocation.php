
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Genie | Detailed Location</title>
    <?php include '../templates/css.php';
    error_reporting(E_ERROR);
    ?>
    <?php
    include '../templates/autocomplete.php';
    error_reporting(E_ERROR);
    ?>
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
                    <p style="margin-top: 10px; font-weight: bold; " id="selectedLocation"></p>
                </div>
                <div class="col-md-3" style="padding-left: 30px;">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">See around.. <span
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
            <div id="resultView" class="singleplaceView">
                <div id="locationPhoto" class="locationPhoto">
                    <img id="locationPhotoBox">
                </div>
                <div id="locationInfo">
                    <div class="userRating"></div>
                    <div class="placeType" style="padding-top: 30px">
                        <p><i id="placeTypeBox"></i></p>
                    </div>
                    <div class="placeLocation">
                        <p id="placeLocationBox"></p>
                    </div>
                    <div class="buttonOptions">
                        <a href="#" class="btn btn-default" onclick="savePlace()" id="saveBtn"><i
                                class="fa fa-bookmark"></i> Save</a>
                    </div>
                    <script>
                        var u_id = document.getElementById("u_id").innerHTML;
                        if (u_id == 'null') {
                            document.getElementById("saveBtn").setAttribute('disabled', 'disabled');
                        }
                    </script>
                    <div class="placeDescription">
                        <p id="placeDescriptionBox"></p>
                    </div>
                    <!--div class="buttonOptions">
                        <a href="#" class="btn btn-default"><i class="fa fa-volume-up"></i> Read aloud</a>
                    </div-->
                    <div id="placeLat" style="visibility: hidden"></div>
                    <div id="placeLong" style="visibility: hidden"></div>
                    <div id="place_id" style="visibility: hidden"></div>
                </div>
            </div>
        </div>
        <div id="myPlacesMapView">
            <div id="map"></div>
        </div>
    </div>
</main>

<?php include '../templates/js.php' ?>
<script src="../model/data_access/detailedLocation.js"></script>
<script>document.onload = initMap3()</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk&libraries=places&callback=initMap3&language=en"
    async defer></script>
</body>
</html>