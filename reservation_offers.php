<?php

require 'db/functions.php';

$facilities = getFacilities();
$centres = getAllCentres();

//if ($result->num_rows > 0) {
//    echo "<h1>Rekordy z tabeli facilities:</h1>";
//    while ($row = $result->fetch_assoc()) {
//        echo "ID: " . $row["facility_id"] . "<br>";
//        echo "Nazwa: " . $row["facility_name"] . "<br>";
//        // Wyświetl inne kolumny, które chcesz wyświetlić
//    }
//} else {
//    echo "Brak rekordów w tabeli facilities.";
//}

include 'head.php';
include "navbar.php";

?>

<div class="offers_page">

    <div class="filter_panel">
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


    <div class="offers_container">
        <?php foreach ($facilities as $facility): ?>
            <div class="facility-item">
                <a href="facility.php?">
                <div class="field"><img src="<?= $facility['image_path']?>" alt="zdjęcie obiektu" class="facility-image"></div>
                <div class="field"><?= $facility['facility_name']; ?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

