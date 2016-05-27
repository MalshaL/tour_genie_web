<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Genie | Current Location</title>
    <?php include '../templates/css.php';
    error_reporting(E_ERROR);
    ?>
    <?php include '../model/data_access/tourModel.php';
    include '../model/entity/tour.php';
    include '../model/entity/tourStop.php';
    ?>

    <script>
        var pos;
        var mylocation;
        function initAutocomplete() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                mylocation = autocomplete.getPlace().name;
                pos = autocomplete.getPlace().geometry.location;
            })
        }

        function getSelectedValue() {
            $("#dropdownBox1").find("li").click(function () {
                var type = this.id;
                if (mylocation != undefined) {
                    document.location.href = 'searchResults.php?l=' + mylocation + '&t=' + type + '&lt=' + loc.lat + '&lg=' + loc.lng;
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
                                <li id="eat"><a href="#" onclick="getSelectedVal()"><i class="fa fa-cutlery fa-fw"></i>
                                        Eat</a></li>
                                <li id="stay"><a href="#" onclick="getSelectedVal()"><i
                                            class="fa fa-building fa-fw"></i> Stay</a></li>
                                <li id="shop"><a href="#" onclick="getSelectedVal()"><i
                                            class="fa fa-shopping-cart fa-fw"></i> Shop</a></li>
                                <li id="visit"><a href="#" onclick="getSelectedVal()"><i
                                            class="fa fa-binoculars fa-fw"></i> Visit</a></li>
                                <li id="fuel"><a href="#" onclick="getSelectedVal()"><i class="fa fa-tint fa-fw"></i>
                                        Re-fuel</a></li>
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
                    <div class="placeDescription">
                        <p id="placeDescriptionBox"></p>
                    </div>
                    <div class="buttonOptions">
                        <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="bottom"
                           title="Add to My History" id="checkinBtn" onclick="saveHistory()"><i
                                class="fa fa-check-circle"></i> Check in</a>
                        <a href="#" class="btn btn-default" id="tourBtn" data-toggle="modal" data-target="#tourModal"><i
                                class="fa fa-plus-circle"></i> Add to tour</a>
                        <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="bottom"
                           title="Add to My Places" id="saveBtn" onclick="saveCurrLoc()"><i class="fa fa-bookmark"></i>
                            Save</a>
                    </div>
                    <script>
                        var u_id = document.getElementById("u_id").innerHTML;
                        if (u_id == 'null') {
                            document.getElementById("saveBtn").setAttribute('disabled', 'disabled');
                            document.getElementById("tourBtn").setAttribute('disabled', 'disabled');
                            document.getElementById("checkinBtn").setAttribute('disabled', 'disabled');
                        }
                    </script>
                    <div id="placeLat" style="visibility: hidden"></div>
                    <div id="placeLong" style="visibility: hidden"></div>
                    <div id="place_id" style="visibility: hidden"></div>
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

<div id="tourModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add to Tour</h4>
            </div>
            <div class="modal-body">
                <h4>Select from your tours</h4>
                <ul>
                    <?php $tour_list = get_tour_list($_SESSION['id']);
                    if ($tour_list != null) {
                        $cnt = 0;
                        foreach ($tour_list as $item) { ?>
                            <li id="<?= $cnt ?>" onclick="setTour(<?= $cnt ?>, <?= $item->get_tour_id() ?>, <?= $item->get_last_stop_id() ?>)">
                                <a style="margin-right: 20px"><?= $item->get_tour_name() . " on " . $item->get_start_date() ?></a><span
                                    id="<?="span".$cnt ?>" style="margin-left: 20px; visibility: hidden" class="badge">Added to tour</span>
                            </li>
                            <?php
                            $cnt++;
                        }
                    }
                    ?>
                </ul>
                <button type="submit" class="btn btn-default" id="newTourBtn" href="#"
                        style="width:100%; height:40px; background-color: #42c4d6; border-color: #42c4d6; font-weight: bold; font-size: 16px">
                    Start New tour
                </button>
                <script>
                    function setTour(btnId, tour_id, last_stop_id) {
                        var p_id = document.getElementById("place_id").innerHTML;
                        var u_id = document.getElementById("u_id").innerHTML;
                        var id = "tourBtn";
                        var date = new Date().toJSON().slice(0,10);
                        var xmlhttp;
                        if (window.XMLHttpRequest) {
                            xmlhttp = new XMLHttpRequest();
                        } else {
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                document.getElementById(id).setAttribute("disabled", "disabled");
                                document.getElementById("newTourBtn").setAttribute("disabled", "disabled");
                                document.getElementById("span"+btnId).setAttribute("style", "visibility: visible");
                            }
                        };

                        xmlhttp.open("GET", "/TourGenie/controller/addToTourController.php?p_id=" + p_id + "&u_id=" + u_id + "&tour_id=" + tour_id + "&last_id=" + last_stop_id + "&date="+date, true);
                        //xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                        xmlhttp.send();
                    }
                </script>
            </div>
        </div>
    </div>
</div>

<?php include '../templates/js.php' ?>
<script src="../model/data_access/currentLocation.js"></script>
<script>document.onload = initMap()</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP6BFWsxWoI9Ep8bHeo4bwlY0mfpRSesw&callback=initMap" async
        defer></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk&libraries=places&callback=initMap&language=en"
    async defer></script>
</body>
</html>