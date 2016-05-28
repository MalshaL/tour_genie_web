
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
            <div class="col-md-12" id="selectorSearch">
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
</body>
</html>