<?php
include 'head.php';
include "navbar.php";

include_once('db/db_functions.php');
include_once 'functions.php';

$facility_id = urldecode($_GET['facility_id']);
$facility = getFacilityById($facility_id);
$centre = getCentreById($facility['centre_id']);

$dates = getDates();
$times= getTimes($facility);


?>

<div class="facility-page">
    <div class="facility-container">
        <div class="first-row">
            <img src="<?= $facility["image_path"] ?>" alt="zdjecie produktu""/>
            <div class="facility-desc">
                <h1><?= $facility["facility_name"] ?></h1>
                <p><?= $centre["centre_name"] ?></p>
                <p><?= $centre["postcode"] . " " . $centre["city"] . ", " . $centre["street"] . " " . $centre["property_no"]?></p>
                <p>Cena: <?= $facility["booking_price"] ?> zł</p>
                <p>Opis obiektu:</p>
                <p><?= $facility["description"] ?></p>
            </div>
        </div>

        <table>
            <tr>
                <th>Data</th>
            </tr>
            <?php foreach ($dates as $date): ?>
                <tr>
                    <td><?= $date ?></td>
                    <?php foreach ($times as $time): ?>
                        <td class="hour"><a href="order_summary.php?facility_id=<?= urlencode($facility["facility_id"]) ?>&date=<?= urlencode($date) ?>&time=<?= urlencode($time) ?>"><?= $time ?></a></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>