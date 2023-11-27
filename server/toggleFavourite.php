<?php
require_once '../db/db_functions.php';

// Przyjmij dane z parametru w adresie URL
if (isset($_GET['facilityId'])) {
    $facilityId = $_GET['facilityId'];

    // Sprawdź, czy sesja jest zainicjowana i czy istnieje użytkownik
    session_start();
    if (isset($_SESSION['user_id'])) {
        $isFavourite = isFavourite($facilityId, $_SESSION['user_id']);

        if ($isFavourite) {
            deleteFromFavourite($facilityId, $_SESSION['user_id']);
        } else {
            addToFavourite($facilityId, $_SESSION['user_id']);
        }

        // Przekieruj użytkownika z powrotem na poprzednią stronę
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// Jeżeli coś poszło nie tak, przekieruj użytkownika na stronę błędu
header('Location: error.php');
exit();
?>
