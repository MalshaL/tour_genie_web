<!--/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 4/28/2016
 * Time: 2:53 AM
 */-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Genie | Detailed Location</title>
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
                <div class="col-md-9">
                    <p style="margin-top: 10px; font-weight: bold; ">Location Name</p>
                </div>
                <div class="col-md-3" style="padding-left: 30px;">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">See around.. <span
                                    class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-cutlery"></i> Eat</a></li>
                                <li><a href="#"><i class="fa fa-building"></i> Stay</a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i> Shop</a></li>
                                <li><a href="#"><i class="fa fa-binoculars"></i> Visit</a></li>
                                <li><a href="#"><i class="fa fa-tint"></i> Re-fuel</a></li>
                            </ul>
                        </div><!-- /btn-group -->
                    </div>
                </div>
            </div>
            <div id="resultView" class="singleplaceView">
                <div id="locationPhoto">
                    <img src="../resources/images/1.jpg">
                </div>
                <div id="locationInfo">
                    <div class="userRating">9</div>
                    <div class="placeType">
                        <p><i>Restaurant</i></p>
                    </div>
                    <div class="placeLocation">
                        <p>Sri Jayawardenepura Kotte</p>
                    </div>
                    <div class="buttonOptions">
                        <a href="#" class="btn btn-default"><i class="fa fa-bookmark-o"></i> Save</a>
                    </div>
                    <div class="placeDescription">
                        <p>blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah
                            blah blah
                            blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah
                            blah blah
                            blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah
                            blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah
                            blah blah
                            blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah
                            blah blah
                            blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah
                            blah blah</p>
                    </div>
                    <div class="buttonOptions">
                        <a href="#" class="btn btn-default"><i class="fa fa-volume-up"></i> Read aloud</a>
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