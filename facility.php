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
        <a onclick="toggleFavorite(<?= $facility['facility_id']; ?>)">
            <?php $isFavourite = isFavourite($facility['facility_id'], $_SESSION['user_id']); ?>
            <svg id="heartIcon" viewBox="0 0 24 24" width="3.5em" height="3.5em" fill=<?php echo $isFavourite ? 'red' : 'white';?>  ><title>Dodaj do ulubionych</title><path d="M17.488 1.11h-.146a6.552 6.552 0 0 0-5.35 2.81A6.57 6.57 0 0 0 6.62 1.116 6.406 6.406 0 0 0 .09 7.428c0 7.672 11.028 15.028 11.497 15.338a.745.745 0 0 0 .826 0c.47-.31 11.496-7.666 11.496-15.351a6.432 6.432 0 0 0-6.42-6.306zM12 21.228C10.018 19.83 1.59 13.525 1.59 7.442c.05-2.68 2.246-4.826 4.934-4.826h.088c2.058-.005 3.93 1.251 4.684 3.155.226.572 1.168.572 1.394 0 .755-1.907 2.677-3.17 4.69-3.16h.02c2.7-.069 4.96 2.118 5.01 4.817 0 6.089-8.429 12.401-10.41 13.8z"></path></svg>
        </a>

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
            <button id="pay-button" onclick="createReservation(<?= $facility['facility_id'] ?>,'<?= $facility['facility_name'] ?>', '<?= $facility['image_path'] ?>', <?= $user_id?>)">opłać</button>
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
                        $isReserved = checkReservation($date, $time, $facility_id);
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
