<?php

require 'db/db_functions.php';

$facilities = getFacilities();
$centres = getAllCentres();

include 'head.php';
include "navbar.php";

?>

<div class="offers-page">

    <div class="filter-panel">
        <button type="button" class="filter">Jednostka</button>
        <div class="content">
            <?php foreach ($centres as $centre): ?>
                <div class="centre-item">
                    <button><?= $centre['centre_name']; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="filter">Sport</button>
        <div class="content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>


    <div class="offers-container">
        <?php foreach ($facilities as $facility): ?>
                <a class="facility-item" href="facility.php?facility_id=<?= urlencode($facility["facility_id"]) ?>">
                    <?php $sport_centre = getCentreById($facility["centre_id"])?>
                    <div><img src="<?= $facility['image_path']?>" alt="zdjęcie obiektu" class="facility-image"></div>
                    <div><?= $facility['facility_name']; ?></div>
                    <div><?= $sport_centre['centre_name']; ?></div>
                </a>
        <?php endforeach; ?>
    </div>
</div>
