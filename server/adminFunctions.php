<?php

require '../db/db_functions.php';
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['centre_id'])) {
    $centre_id = $_POST['centre_id'];

    deleteCentreById($centre_id);


    http_response_code(200);;
} else {
    // Nieprawidłowe żądanie
    http_response_code(400);
    echo 'Nieprawidłowe żądanie';
}
?>