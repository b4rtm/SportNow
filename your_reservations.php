<?php

include 'head.php';
include "navbar.php";

include_once('db/db_functions.php');
include_once 'functions.php';

$reservations = getReservationsByUserId($_SESSION['user_id']);

?>

<div id="your-reservations-page">
    <?php
    // Wyświetl rezerwacje
    foreach ($reservations as $reservation) {
        echo '<div class="reservation">';
        echo '<p>Data: ' . $reservation['date'] . '</p>';
        echo '<p>Czas: ' . $reservation['start_time'] . '</p>';
        // Dodaj inne informacje o rezerwacji
        echo '</div>';
    }
    ?>
</div>