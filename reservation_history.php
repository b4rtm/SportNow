<?php

include 'head.php';
include "navbar.php";

include_once('db/db_functions.php');
include_once 'functions.php';

$reservations = getReservationsByUserId($_SESSION['user_id']);

?>

<div id="your-reservations-page" xmlns="http://www.w3.org/1999/html">
    <h1>Witaj <?=  $_SESSION['name'] ?>!</h1>
    <h2 style="color: #aba9a9; margin-bottom: 45px;">Oto Twoje zamówienia:</h2>
    <?php if (empty($reservations)): ?>
        <p>Nie złożyłeś jeszcze żadnych rezerwacji</p>
    <?php else: ?>
        <?php foreach ($reservations as $reservation): ?>
            <h2><?= $reservation['facility_name']?></h2>
            <div class="reservation">
                <div class="info">
                    <p class="label">Data</p>
                    <p class="data"><?= $reservation['date']?></p>
                </div>
                <div class="info">
                    <p class="label">Czas trwania</p>
                    <p class="data"><?= substr($reservation['start_time'], 0, -3)?>-<?= substr($reservation['end_time'], 0, -3)?></p>
                </div>
                <div class="info">
                    <p class="label">Numer rezerwacji </p>
                    <p class="data"> <?= $reservation['reservation_id']?> </p>
                </div>
                <img src="<?= $reservation['image_path']?>" alt="facility image">
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php include_once('footer.php'); ?>