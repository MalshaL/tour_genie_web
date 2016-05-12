<!--/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 4/28/2016
 * Time: 3:00 AM
 */-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Genie | Detailed Tour</title>
    <?php include '../templates/css.php';
    error_reporting(E_ERROR);
    ?>
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
                    <p style="margin-top: 10px; font-weight: bold; ">Tour Name</p>
            </div>
            <div id="resultView" class="singleplaceView">
                <div id="locationPhoto">
                    <img src="../resources/images/1.jpg">
                </div>
                <div id="locationInfo">
                    <div class="tourDate">
                        <p><i>12 April 2016</i> to <i>20 April 2016</i></p>
                    </div>
                    <div class="tourDescription">
                        <p>blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah
                            blah blah
                            blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah
                            blah blah
                            blah blah</p>
                    </div>
                    <div class="tourPlaces">
                        <ul>
                            <li>Shanghai Terrace</li>
                            <li>Shanghai Terrace</li>
                            <li>Shanghai Terrace</li>
                            <li>Shanghai Terrace</li>
                            <li>Shanghai Terrace</li>
                            <li>Shanghai Terrace</li>
                            <li>Shanghai Terrace</li>
                            <li>Shanghai Terrace</li>
                        </ul>
                    </div>
                    <div class="buttonOptions">
                        <a href="#" class="btn btn-default"><i class="fa fa-volume-up"></i> Delete tour</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="myPlacesMapView">
            <div id="map"></div>
        </div>
    </div>
</main>

<?php include '../templates/js.php' ?>
</body>
</html>