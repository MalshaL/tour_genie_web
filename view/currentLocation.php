
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Genie | Current Location</title>
    <?php include '../templates/css.php';
    error_reporting(E_ERROR);
    ?>

    <script>
        var pos;
        var mylocation;
        function initAutocomplete(){
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function(){
                mylocation = autocomplete.getPlace().name;
                pos = autocomplete.getPlace().geometry.location;
            })
        }
    </script>
    <script>
        function getSelectedValue(){
            $("#dropdownBox1").find("li").click(function() {
                var type = this.id;
                if(mylocation!=undefined){
                    document.location.href = 'searchResults.php?l='+mylocation+'&t='+type+'&lt='+loc.lat+'&lg='+loc.lng;
                }
            });
        }
    </script>

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
                <div class="col-md-2">
                    <p style="margin-top: 10px; font-weight: bold; ">You are at:</p>
                </div>
                <div class="col-md-6">
                    <p style="padding-top: 10px;" id="nameBox"><b id="selectedLocation"></b></p>
                </div>
                <div class="col-md-2" style="padding-left: 65px;">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Look around me <span
                                    class="caret"></span></button>
                            <ul class="dropdown-menu" id="dropdownBox">
                                <li id="eat"><a href="#" onclick="getSelectedVal()"><i class="fa fa-cutlery fa-fw"></i> Eat</a></li>
                                <li id="stay"><a href="#" onclick="getSelectedVal()"><i class="fa fa-building fa-fw"></i> Stay</a></li>
                                <li id="shop"><a href="#" onclick="getSelectedVal()"><i class="fa fa-shopping-cart fa-fw"></i> Shop</a></li>
                                <li id="visit"><a href="#" onclick="getSelectedVal()"><i class="fa fa-binoculars fa-fw"></i> Visit</a></li>
                                <li id="fuel"><a href="#" onclick="getSelectedVal()"><i class="fa fa-tint fa-fw"></i> Re-fuel</a></li>
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
                    <div class="userRating" id="userRating"></div>
                    <div class="placeType" style="padding-top: 30px">
                        <p><i id="placeTypeBox"></i></p>
                    </div>
                    <div class="placeLocation">
                        <p id="placeLocationBox"></p>
                    </div>
                    <div class="buttonOptions">
                        <a href="#" class="btn btn-default"><i class="fa fa-check-circle"></i> Check in</a>
                        <a href="#" class="btn btn-default"><i class="fa fa-plus-circle"></i> Add to tour</a>
                        <a href="#" class="btn btn-default"><i class="fa fa-bookmark"></i> Save</a>
                    </div>
                    <div class="placeDescription">
                        <p id="placeDescriptionBox"></p>
                    </div>
                    <div id="placeLat" style="visibility: hidden"></div>
                    <div id="placeLong" style="visibility: hidden"></div>
                    <!--div class="buttonOptions">
                        <a href="#" class="btn btn-default"><i class="fa fa-volume-up"></i> Read aloud</a>
                    </div-->
                </div>
            </div>
        </div>
        <div id="myPlacesMapView">
            <div id="map"></div>
        </div>
    </div>
</main>

<?php include '../templates/js.php' ?>
<script src="../model/data_access/currentLocation.js"></script>
<script>document.onload = initMap()</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP6BFWsxWoI9Ep8bHeo4bwlY0mfpRSesw&callback=initMap" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk&libraries=places&callback=initMap&language=en" async defer></script>
</body>
</html>