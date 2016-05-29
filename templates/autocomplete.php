<script>
    var pos;
    var mylocation;
    var type = "eat";

    function getSelectedValue() {
        $("#dropdownBox1").find("li").click(function () {
            type = this.id;
        });
    }

    function initAutocomplete() {
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            mylocation = autocomplete.getPlace().name;
            pos = autocomplete.getPlace().geometry.location;
            document.location.href = 'searchResults.php?l=' + mylocation + '&t=' + type + '&lt=' + pos.lat() + '&lg=' + pos.lng();
        })
    }
</script>