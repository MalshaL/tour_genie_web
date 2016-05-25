<!--/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 4/28/2016
 * Time: 12:23 PM
 */-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Genie | My Places</title>
    <?php include '../templates/css.php';
    error_reporting(E_ERROR);
    ?>

    <?php include '../model/data_access/SaveModel.php';
    include '../model/Entity/SavedPlace.php'; ?>
</head>

<body>
<header>
    <?php include '../templates/header.php';
    error_reporting(E_ERROR);
    ?>
</header>

<main>
    <div id="container">
        <div id="contentView">
            <div class="col-md-12" id="selector">
                <p style="margin-top: 10px; font-size: 16px; padding-left: 10px;"><b>My Places</b></p>
            </div>
            <div id="resultView">
                <ul class="resultList" id="resultListBox" style="list-style: none; padding-left: 0">

                </ul>
            </div>
        </div>
        <div id="myPlacesMapView">
            <div id="map"></div>
        </div>
    </div>
</main>

<?php include '../templates/js.php' ?>
<script src="../model/data_access/myPlaces.js"></script>
<script>document.onload = handlePlaces()</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQwtY14UCzaIsy6mz39GCXAN3E7a1NYtk&libraries=places&callback=initMap2&language=en" async defer></script>
</body>
</html>