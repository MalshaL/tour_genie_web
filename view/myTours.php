<!--/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 4/28/2016
 * Time: 12:24 PM
 */-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Genie | My Tours</title>
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
                <p style="margin-top: 10px; font-size: 16px; padding-left: 10px;"><b>My Tours</b></p>
            </div>
            <div id="resultView">
                <ul class="resultList" style="list-style: none; padding-left: 0">
                    <li class="placeView">
                        <div id="photoContainer">
                            <img src="../resources/images/1.jpg">
                        </div>
                        <div id="infoContainer">
                            <div class="placeName">
                                <h3><a href="">Tour Name</a></h3>
                            </div>
                            <div class="tourDescription">
                                <p><i>blah blah blah blah blah blah blah blah blah blah blah blah blah
                                        blah blah blah blah blah blah blah blah blah blah blah blah blah  </i></p>
                            </div>
                            <div class="tourPlaces">
                                <p>From loc1 to loc2</p>
                            </div>
                            <div class="tourDate">
                                <p>12 April 2016 to 20 April 2016</p>
                            </div>
                            <div class="buttonOptions">
                                <a href="#" class="btn btn-default"><i class="fa fa-bookmark-o"></i> See tour</a>
                                <a href="#" class="btn btn-default"><i class="fa fa-crosshairs"></i> Remove</a>
                            </div>
                        </div>
                    </li>
                    <li class="placeView">
                        <div id="photoContainer">
                            <img src="../resources/images/1.jpg">
                        </div>
                        <div id="infoContainer">
                            <div class="placeName">
                                <h3><a href="">Tour Name</a></h3>
                            </div>
                            <div class="tourDescription">
                                <p><i>blah blah blah blah blah blah blah blah blah blah blah blah blah
                                        blah blah blah blah blah blah blah blah blah blah blah blah blah  </i></p>
                            </div>
                            <div class="tourPlaces">
                                <p>From loc1 to loc2</p>
                            </div>
                            <div class="tourDate">
                                <p>12 April 2016 to 20 April 2016</p>
                            </div>
                            <div class="buttonOptions">
                                <a href="#" class="btn btn-default"><i class="fa fa-bookmark-o"></i> See tour</a>
                                <a href="#" class="btn btn-default"><i class="fa fa-crosshairs"></i> Remove</a>
                            </div>
                        </div>
                    </li>
                    <li class="placeView">
                        <div id="photoContainer">
                            <img src="../resources/images/1.jpg">
                        </div>
                        <div id="infoContainer">
                            <div class="placeName">
                                <h3><a href="">Tour Name</a></h3>
                            </div>
                            <div class="tourDescription">
                                <p><i>blah blah blah blah blah blah blah blah blah blah blah blah blah
                                        blah blah blah blah blah blah blah blah blah blah blah blah blah  </i></p>
                            </div>
                            <div class="tourPlaces">
                                <p>From loc1 to loc2</p>
                            </div>
                            <div class="tourDate">
                                <p>12 April 2016 to 20 April 2016</p>
                            </div>
                            <div class="buttonOptions">
                                <a href="#" class="btn btn-default"><i class="fa fa-bookmark-o"></i> See tour</a>
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