
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Genie</title>
    <?php include '../templates/css.php';
    error_reporting(E_ERROR);
    ?>
    <?php include '../templates/apis.php';
    include '../templates/autocomplete.php';
    error_reporting(E_ERROR);
    ?>


</head>

<body onload="initAutocomplete()" background="../resources/images/back2.jpg">
<header>
    <?php include '../templates/header.php';
    error_reporting(E_ERROR);
    ?>
</header>
<main>
    <div class="container"
         style="text-align: center; align-items: center; padding-top: 20%; font-size: 32px; color: #000;">
        <p> Look for places near you..</p>
        <a type="button" class="btn btn-default btn-lg" id="locationBtn" href="currentLocation.php"><b>Enable Location
                Services</b></a>

    </div>
</main>

<?php include '../templates/js.php' ?>
</body>
</html>
