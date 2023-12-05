<?php

require '../db/db_functions.php';
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['centre_id'])) {
    $centre_id = $_POST['centre_id'];

    deleteCentreById($centre_id);
    http_response_code(200);;
}
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['facility_id'])) {
    $facility_id = $_POST['facility_id'];

    deleteFacilityById($facility_id);
    http_response_code(200);;
}
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'])) {
    $reservation_id = $_POST['reservation_id'];

    deleteReservationById($reservation_id);
    http_response_code(200);;
}
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    deleteUserById($user_id);
    http_response_code(200);;
}
else {
    // Nieprawidłowe żądanie
    http_response_code(400);
    echo 'Nieprawidłowe żądanie';
}
?>