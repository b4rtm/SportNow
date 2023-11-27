<?php

require 'db/db_functions.php';
require 'functions.php';

$facilities = getFacilities();

if(isset($_GET['sport'])){
    $sport_filter_facilities = getFacilitiesBySportId($_GET['sport']);
    $facilities = array_uintersect($sport_filter_facilities, $facilities, 'compareFacilities');
}

if(isset($_GET['centre'])){
    $centre_filter_facilities = getFacilitiesByCentreId($_GET['centre']);
    $facilities = array_uintersect($centre_filter_facilities, $facilities, 'compareFacilities');
}

if(isset($_GET['price'])){
    $priceRange = getMinMaxPriceRange($_GET['price']);
    $price_filter_facilities = getFacilitiesByPriceRange($priceRange['min'], $priceRange['max']);
    $facilities = array_uintersect($price_filter_facilities, $facilities, 'compareFacilities');
}

$centres = getAllCentres();
$sports = getAllSports();

$priceRanges = [
    '1' => '0zł-20zł',
    '2' => '21zł-50zł',
    '3' => '51zł-100zł',
    '4' => '101zł+',
];

include 'head.php';
include "navbar.php";
?>

<div class="offers-page">

    <div class="filter-panel">
        <button type="button" class="filter">Jednostka</button>
        <div class="content">
            <?php foreach ($centres as $centre): ?>
                <div class="item">
                    <label>
                        <?php
                        $isChecked = (isset($_GET['centre']) && $_GET['centre'] == $centre['centre_id']);
                        ?>
                        <input type="checkbox" <?= $isChecked ? 'checked' : ''; ?> onclick="toggleCheckbox(this, 'centre', '<?= $centre['centre_id']; ?>')">
                        <?= $centre['centre_name']; ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="filter">Sport</button>
        <div class="content">
            <?php foreach ($sports as $sport): ?>
                <div class="item">
                    <label>
                        <?php
                        $isChecked = (isset($_GET['sport']) && $_GET['sport'] == $sport['sport_id']);
                        ?>
                        <input type="checkbox" <?= $isChecked ? 'checked' : ''; ?> onclick="toggleCheckbox(this, 'sport', '<?= $sport['sport_id']; ?>')">
                        <?= $sport['sport_name']; ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="filter">Cena</button>
        <div class="content">
            <?php foreach ($priceRanges as $priceKey => $priceLabel): ?>
            <div class="item">
                <label>
                    <?php
                    $isChecked = (isset($_GET['price']) && $_GET['price'] == $priceKey);
                    ?>
                    <input type="checkbox" <?= $isChecked ? 'checked' : ''; ?> onclick="toggleCheckbox(this, 'price', '<?= $priceKey; ?>')">
                    <?= $priceLabel ?>
                </label>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="offers-container">
        <?php foreach ($facilities as $facility): ?>
                <a class="facility-item" href="facility.php?facility_id=<?= urlencode($facility["facility_id"]) ?>">
                    <?php $sport_centre = getCentreById($facility["centre_id"])?>
                    <div><img src="<?= $facility['image_path']?>" alt="zdjęcie obiektu" class="facility-image"></div>
                    <div><?= $facility['facility_name']; ?></div>
                    <div><?= $sport_centre['centre_name']; ?></div>
                    <button>Rezerwuj</button>
                </a>
        <?php endforeach; ?>
    </div>

    <script src="scripts/filter.js"></script>
</div>
<?php include_once('footer.php'); ?>