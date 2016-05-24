<!--/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 4/21/2016
 * Time: 11:47 PM
 */-->
<?php
session_start();
if(isset($_SESSION["id"])){
    $user_id = $_SESSION["id"];
    $logged_in = $_SESSION["logged_in"];
}?>

<?php
include '../model/data_access/SignUpModel.php';
?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php"><!--<img src="../resources/images/genie.png">-->Tour Genie</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php
                $url = $_SERVER['REQUEST_URI'];
                if (isset($_SESSION["logged_in"])) {
                    echo '<li style="visibility: hidden" id="u_id">'.$_SESSION['id'].'</li>';
                    echo '<li><a href="myHistory.php">My History</a></li>';
                    echo '<li><a href="myPlaces.php">My Places</a></li>';
                    echo '<li><a href="myTours.php">My Tours</a></li>';
                    echo '<li><a href="../controller/Logout.php?url=' . $url . '">Log Out</a></li>';
                } else {
                    echo '<li style="visibility: hidden" id="u_id">null</li>';
                    echo '<li><a href="#" data-toggle="modal" data-target="#loginModal">Log In</a></li>';
                    echo '<li><a href="#" data-toggle="modal" data-target="#signupModal">Sign In</a></li>';
                } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="searchbar">
    <div class="container">
        <div class="row" style="padding-top: 10px;">
            <div class="col-md-10">
                <form class="form-horizontal" role="search">
                    <div class="col-md-3">
                        <p style="margin-top: 10px; font-size: 15px; font-weight: bold">Let Tour Genie guide you
                            to...</p>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group pac-container" style="margin-left: 0px">
                            <input type="text" id="autocomplete"/>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">Look for places to... <span
                                            class="caret"></span></button>
                                    <ul class="dropdown-menu" id="dropdownBox1">
                                        <li><a href="" style="font-size: 16px;" onclick="getSelectedValue()"><i
                                                    class="fa fa-cutlery fa-fw"
                                                    style="font-size:16px;color:blue;"></i>
                                                Eat</a></li>
                                        <li><a href="#" style="font-size: 16px;" onclick="getSelectedValue()"><i
                                                    class="fa fa-building fa-fw"
                                                    style="font-size:16px;color:blue;"></i>
                                                Stay</a></li>
                                        <li><a href="#" style="font-size: 16px;" onclick="getSelectedValue()"><i
                                                    class="fa fa-shopping-cart fa-fw"
                                                    style="font-size:16px;color:blue;"></i>
                                                Shop</a></li>
                                        <li><a href="#" style="font-size: 16px;" onclick="getSelectedValue()"><i
                                                    class="fa fa-binoculars fa-fw"
                                                    style="font-size:16px;color:blue;"></i>
                                                Visit</a></li>
                                        <li><a href="#" style="font-size: 16px;" onclick="getSelectedValue()"><i
                                                    class="fa fa-tint fa-fw"
                                                    style="font-size:16px;color:blue;"></i>
                                                Re-fuel</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
                            </div><!-- /input-group -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2">
                <a type="button" class="btn btn-default" id="locationBtn" href="currentLocation.php">See Current
                    Location</a>
            </div>
        </div>
    </div>
</div>

<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Log In</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="../controller/Logger.php?url=<?php echo $_SERVER["REQUEST_URI"] ?>">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="username" placeholder="Username or Email"
                               required>
                    </div>
                    <div class="form-group" style="margin-bottom: 30px;">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-default"
                            style="width: 100%; height:60px; background-color: #42c4d6; border-color: #42c4d6; font-weight: bold; font-size: 16px">
                        Log In
                    </button>
                </form>
                <?php
                if (isset($_GET["error"]) == '1') { ?>
                    <div id="errorBox">
                        <b>Error in logging in!</b>
                        <p>Login details are incorrect</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div id="signupModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sign Up</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="../controller/SignUp.php?url=<?php echo $_SERVER["REQUEST_URI"] ?>">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 30px;">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-default"
                            style="width: 100%; height:60px; background-color: #42c4d6; border-color: #42c4d6; font-weight: bold; font-size: 16px">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



