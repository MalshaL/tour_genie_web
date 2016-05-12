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
                <ul class="resultList" style="list-style: none; padding-left: 0">
                    <li class="placeView">
                        <div id="photoContainer">
                            <img src="../resources/images/1.jpg">
                        </div>
                        <div id="infoContainer">
                            <div class="userRating">9</div>
                            <div class="placeName">
                                <h3><a href="">Shanghai Terrace</a></h3>
                            </div>
                            <div class="placeType">
                                <p><i>Restaurant</i></p>
                            </div>
                            <div class="placeLocation">
                                <p>Sri Jayawardenepura Kotte</p>
                            </div>
                            <div class="buttonOptions">
                                <a href="#" class="btn btn-default"><i class="fa fa-crosshairs"></i> Remove</a>
                            </div>
                        </div>
                    </li>
                    <li class="placeView">
                        <div id="photoContainer">
                            <img src="../resources/images/1.jpg">
                        </div>
                        <div id="infoContainer">
                            <div class="userRating">9</div>
                            <div class="placeName">
                                <h3><a href="">Shanghai Terrace</a></h3>
                            </div>
                            <div class="placeType">
                                <p><i>Restaurant</i></p>
                            </div>
                            <div class="placeLocation">
                                <p>Sri Jayawardenepura Kotte</p>
                            </div>
                            <div class="buttonOptions">
                                <a href="#" class="btn btn-default"><i class="fa fa-crosshairs"></i> Remove</a>
                            </div>
                        </div>
                    </li>
                    <li class="placeView">
                        <div id="photoContainer">
                            <img src="../resources/images/1.jpg">
                        </div>
                        <div id="infoContainer">
                            <div class="userRating">9</div>
                            <div class="placeName">
                                <h3><a href="">Shanghai Terrace</a></h3>
                            </div>
                            <div class="placeType">
                                <p><i>Restaurant</i></p>
                            </div>
                            <div class="placeLocation">
                                <p>Sri Jayawardenepura Kotte</p>
                            </div>
                            <div class="buttonOptions">
                                <a href="#" class="btn btn-default"><i class="fa fa-crosshairs"></i> Remove</a>
                            </div>
                        </div>
                    </li>
                </ul>
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