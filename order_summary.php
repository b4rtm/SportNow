<?php
include 'head.php';
include "navbar.php";

include_once('db/db_functions.php');
include_once 'functions.php';

$facility_id = urldecode($_GET['facility_id']);
$facility = getFacilityById($facility_id);
$date = urldecode($_GET['date']);
$time = urldecode($_GET['time']);

echo $facility_id;
echo $date;
echo $time;
?>

<div class="order-summary-page">
    <div class="facility">
        <p><?= $facility["facility_name"] ?></p>
        <img src="<?= $facility["image_path"] ?>" alt="zdjecie produktu""/>
    </div>
</div>
