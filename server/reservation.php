<?php
include_once('../db/db_functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    try {
        createReservation($data['date'], $data['start_time'], $data['end_time'], $data['facility_id'], $data['user_id'], $data['facility_name'], $data['image_path']);
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

