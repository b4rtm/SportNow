<?php
include 'head.php';
include "navbar.php";

include_once('db/functions.php');

$facility_name = urldecode($_GET['facility_name']);
$facility = getFacilityByName($facility_name);
//    $product = getProductByName($productName);
//    $categories = getCategoriesByProductId($product["productId"]);
//    $sizes = getSizesByProductId($product["productId"]);
//    $producer = getProducerByProducerId($product["producerId"]);
//    $currentPage = "RUN 4 ALL | {$productName}";

$startDate = new DateTime('tomorrow'); // Data początkowa to jutro
$endDate = clone $startDate; // Kopia daty początkowej
$dates = array(); // Tworzenie pustej tablicy na daty

// Dodaj 6 dni do daty końcowej, aby uzyskać tydzień
$endDate->add(new DateInterval('P6D'));

// Pętla generująca listę dat i zapisująca je do tablicy
while ($startDate <= $endDate) {
    $dates[] = $startDate->format('Y-m-d'); // Dodawanie daty do tablicy
    $startDate->add(new DateInterval('P1D')); // Dodaj 1 dzień
}

$startHour = $facility["opening_hour"]; // Start hour
$endHour = $facility["closing_hour"]; // End hour

$interval = new DateInterval('PT1H'); // Step every 1 hour
$time = new DateTime("$startHour:00");

$times = array();

while ($time->format('H:i') < $endHour . ":00") {
    $times[] = $time->format('H:i');
    $time->add($interval);
}

// Display the array of hours and minutes
print_r($times);


?>

<div class="facility-page">
    <div class="facility">
        <p><?= $facility["facility_name"] ?></p>
        <img src="<?= $facility["image_path"] ?>" alt="zdjecie produktu""/>
        <table>
            <tr>
                <th>Data</th>
            </tr>
            <?php foreach ($dates as $data): ?>
                <tr>
                    <td><?= $data ?></td>
                    <?php foreach ($times as $time): ?>
                        <td class="hour"><?= $time ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>