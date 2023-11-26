<?php

require 'db/db_functions.php';


$facilities = getFacilities();


function compareFacilities($obj1, $obj2) {
    return $obj1['facility_id'] - $obj2['facility_id'];
}


if(isset($_GET['sport'])){
    $sport_filter_facilities = getFacilitiesBySportId($_GET['sport']);
    $facilities = array_uintersect($sport_filter_facilities, $facilities, 'compareFacilities');
}


if(isset($_GET['centre'])){
    $centre_filter_facilities = getFacilitiesByCentreId($_GET['centre']);
    $facilities = array_uintersect($centre_filter_facilities, $facilities, 'compareFacilities');

}

if(isset($_GET['price'])){
    if ($_GET['price'] == '1'){
        $min = 0;
        $max = 20;
    }
    elseif ($_GET['price'] == '2'){
        $min = 21;
        $max = 50;
    }
    elseif ($_GET['price'] == '3'){
        $min = 51;
        $max = 100;
    }
    elseif ($_GET['price'] == '4'){
        $min = 101;
        $max = 10000;
    }
    $price_filter_facilities = getFacilitiesByPriceRange($min, $max);
    $facilities = array_uintersect($price_filter_facilities, $facilities, 'compareFacilities');

}

$centres = getAllCentres();
$sports = getAllSports();




include 'head.php';
include "navbar.php";

?>

<div class="offers-page">

    <div class="filter-panel">
        <button type="button" class="filter">Jednostka</button>
        <div class="content">
            <?php foreach ($centres as $centre): ?>
                <div class="centre-item">
                    <a href="#" onclick="changeFilter('centre', '<?= $centre['centre_id']; ?>')"><?= $centre['centre_name']; ?></a>
                </div>
            <?php endforeach; ?>
            <a class="clear-filtering" href="#" onclick="changeFilter('centre', 'delete')">Wyczyść filtr</a>
        </div>
        <button type="button" class="filter">Sport</button>
        <div class="content">
            <?php foreach ($sports as $sport): ?>
                <div class="sport-item">
                    <a href="#" onclick="changeFilter('sport', '<?= $sport['sport_id'] ?>')"><?= $sport['sport_name']?></a>
                </div>
            <?php endforeach; ?>
            <a class="clear-filtering" href="#" onclick="changeFilter('sport', 'delete')">Wyczyść filtr</a>
        </div>
        <button type="button" class="filter">Cena</button>
        <div class="content">
            <div class="price-item">
                <a href="#" onclick="changeFilter('price', '1')">0zł-20zł</a>
            </div>
            <div class="price-item">
                <a href="#" onclick="changeFilter('price', '2')">21zł-50zł</a>
            </div>
            <div class="price-item">
                <a href="#" onclick="changeFilter('price', '3')">51zł-100zł</a>
            </div>
            <div class="price-item">
                <a href="#" onclick="changeFilter('price', '4')">101zł+</a>
            </div>
            <a class="clear-filtering" href="#" onclick="changeFilter('price', 'delete')">Wyczyść filtr</a>
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
