<?php

include_once('../db/db_functions.php');
// server-script.php

// Sprawdź, czy żądanie jest typu POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobierz dane z żądania
    $data = json_decode(file_get_contents('php://input'), true);

    // Przygotuj dane do dodania do bazy danych
//    $facilityId = $data['facilityId'];
//    $date = $data['date'];
//    $time = $data['start_time'];


    try {
        createReservation($data['date'], $data['start_time'], $data['end_time'], $data['facility_id'], $data['user_id'], $data['facility_name']);
        echo json_encode(['status' => 'success', 'message' => 'Rezerwacja dodana pomyślnie']);
    } catch (PDOException $e) {
        // Błąd w przypadku problemów z bazą danych
        http_response_code(500); // Internal Server Error
        echo json_encode(['status' => 'error', 'message' => 'Wystąpił błąd z bazą danych']);
    }
} else {
    // Zwróć błąd, jeśli żądanie nie jest typu POST
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Metoda niedozwolona']);
}
