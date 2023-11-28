<?php

include 'head.php';
include "navbar.php";

?>
<div id="thanks-page">
    <h1>Rezerwacja obiektu się powiodła.</h1>
    <h2>Dziękujemy za złożenie rezerwacji</h2>
    <button onclick="redirectToHomePage()">Powrót do strony głównej</button>
</div>
<script>
    function redirectToHomePage() {
        window.location.href = 'index.php';
    }
</script>

<?php include_once('footer.php'); ?>
