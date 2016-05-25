<!--/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 4/15/2016
 * Time: 7:16 AM
 */-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Genie</title>
    <?php include '../templates/css.php';
    error_reporting(E_ERROR);
    ?>
    <?php include '../templates/apis.php';
    error_reporting(E_ERROR);
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
                document.location.href = 'searchResults.php?l=' + mylocation + '&t=' + type + '&lt=' + pos.lat + '&lg=' + pos.lng;
            })
        }

        function getSelectedValue() {
            $("#dropdownBox1").find("li").click(function () {
                var type = this.id;
                document.location.href = 'searchResults.php?l=' + mylocation + '&t=' + type + '&lt=' + pos.lat + '&lg=' + pos.lng;
            });
        }
    </script>

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
