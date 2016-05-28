<?php
if ($_GET["error"]==1) {
    echo "<script>
            $(window).load(function () {
                $('#loginModal').modal('show');
            });
        </script>";
} ?>

<?php
if (($_GET["emailError"]==1)) {
    echo "<script>
            $(window).load(function () {
                $('#signupModal').modal('show');
            });
        </script>";
} ?>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<!-- jQuery -->
<script src="../resources/js/jquery.js"></script>
<script src="../resources/js/jquery-2.2.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../resources/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="../resources/js/classie.js"></script>
<script src="../resources/js/cbpAnimatedHeader.js"></script>

<!-- Contact Form JavaScript -->
<script src="../resources/js/jqBootstrapValidation.js"></script>
<script src="../resources/js/contact_me.js"></script>

<!--autocomplete-->



