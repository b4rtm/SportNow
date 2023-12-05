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


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

} else {
    $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}
?>

<div class="facility-page">

    <div class="facility-container">
        <div style="display: flex">
            <img src="<?= $facility["image_path"] ?>" alt="zdjecie produktu""/>
            <div class="facility-desc">
                <h1><?= $facility["facility_name"] ?></h1>
                <p><?= $centre["centre_name"] ?></p>
                <p><?= $centre["city"] . ", " . $centre["street"] . " " . $centre["property_no"]?></p>
                <p>Cena: <?= $facility["booking_price"] ?> zł</p>
                <p>Opis obiektu:</p>
                <p><?= $facility["description"] ?></p>
            </div>
        </div>
        <a onclick="toggleFavorite(<?= $facility['facility_id']; ?>)">
            <?php $isFavourite = isFavourite($facility['facility_id'], $_SESSION['user_id']); ?>
            <svg id="heartIcon" style="cursor: pointer" viewBox="0 0 24 24" width="3.5em" height="3.5em" fill=<?php echo $isFavourite ? 'red' : 'white';?>  ><title>Dodaj do ulubionych</title><path d="M16.794 3.75c1.324 0 2.568.516 3.504 1.451a4.96 4.96 0 010 7.008L12 20.508l-8.299-8.299a4.96 4.96 0 010-7.007A4.923 4.923 0 017.205 3.75c1.324 0 2.568.516 3.504 1.451l.76.76.531.531.53-.531.76-.76a4.926 4.926 0 013.504-1.451"></path></svg>
        </a>

        <div class=" hidden pop-window">
            <h2 style="text-align: center">Zamówienie</h2>
            <p>Obiekt: <?= $facility["facility_name"]?></p>
            <p>Data: <span id="booked-date"></span></p>
            <p>Czas: <span id="start-time"></span> - <span id="end-time"></span></p>
            <div>
                <button id="pay-button" onclick="createReservation(<?= $facility['facility_id'] ?>,'<?= $facility['facility_name'] ?>', '<?= $facility['image_path'] ?>', <?= $user_id?>)">opłać</button>
                <button id="close-window">zamknij</button>
            </div>
        </div>


        <div style="display: flex;">
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
                                <button class="time-button <?= $isReserved ? 'reserved' : '' ?>" <?= $disabledAttribute?> ><?= $time ?></button>
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
                <button id="buy-button">Kup</button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="scripts/reservation.js"></script>
</div>
<?php include_once('footer.php'); ?>