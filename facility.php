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
        <div style="display: flex">
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

        <div class=" hidden pop-window">
            <p>Zamówienie:</p>
            <p>Obiekt: <?= $facility["facility_name"]?></p>
            <p>Data: <span id="booked-date"></span></p>
            <p>Czas: <span id="start-time"></span> - <span id="end-time"></span></p>
            <?php
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

            } else {
                header("Location: login.php");
                exit();
            }?>
            <button id="pay-button" onclick="createReservation(<?= $facility['facility_id'] ?>,'<?= $facility['facility_name'] ?>', <?= $user_id?>)">opłać</button>
            <button id="close-window">zamknij</button>
        </div>


    <div class="second-row">
        <table>
            <tr>
                <th>Data</th>
            </tr>
            <?php
            $row = 1;
            foreach ($dates as $date):
                ?>
                <tr>
                    <td class="date"><?= $date ?></td>
                    <?php
                    $col = 1;
                    foreach ($times as $time):
                        $isReserved = checkReservation($date, $time);
                        $disabledAttribute  = $isReserved ? 'disabled' : ''
                        ?>
                        <td>
                            <button class="time-button <?= $isReserved ? 'reserved' : '' ?>" <?= $disabledAttribute?> data-row="<?= $row ?>" data-col="<?= $col ?>"><?= $time ?></button>
                        </td>
                        <?php
                        $col++;
                    endforeach;
                    ?>
                </tr>
                <?php
                $row++;
            endforeach;
            ?>
        </table>
        <div class="button-container">
            <button class="register-button" id="buy-button">Kup</button>
        </div>
    </div>
    </div>
    <script src="scripts/reservation.js"></script>
</div>
