<?php
session_start();

require '../db/db_functions.php';
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['facility_id'])) {
    $facilityId = $_POST['facility_id'];
    $userId = $_SESSION['user_id'];

    $isFavourite = isFavourite($facilityId, $_SESSION['user_id']);

    if ($isFavourite) {
        deleteFromFavourite($facilityId, $_SESSION['user_id']);
    } else {
        addToFavourite($facilityId, $_SESSION['user_id']);
    }

    header('Content-Type: application/json');
    echo json_encode(['isFavourite' => $isFavourite]);
} else {
    http_response_code(400);
    echo 'Nieprawidłowe żądanie';
}
?>