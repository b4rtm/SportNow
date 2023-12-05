<?php

require 'db/db_functions.php';
require 'functions.php';

if (!isset($_SESSION)) {
    session_start();
}
$facilities = getFavouriteFacilities($_SESSION['user_id']);


include 'head.php';
include "navbar.php";
?>

<div id="favourites-page" style="flex-direction: column">
    <div class="favourites-container"></div>
    <h1 style="color: white">Ulubione</h1>
    <div class="offers-container" style="margin-left: 10%;">
        <?php if (empty($facilities)): ?>
            <h2 >Brak dostępnych obiektów.</h2>
        <?php else: ?>
            <?php foreach ($facilities as $facility): ?>
                <a class="facility-item" href="facility.php?facility_id=<?= urlencode($facility["facility_id"]) ?>">
                    <?php $sport_centre = getCentreById($facility["centre_id"])?>
                    <div><img src="<?= $facility['image_path']?>" alt="zdjęcie obiektu" class="facility-image"></div>
                    <div><?= $facility['facility_name']; ?></div>
                    <div><?= $sport_centre['centre_name']; ?></div>
                    <button>Rezerwuj</button>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php include_once('footer.php'); ?>