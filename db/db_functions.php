<?php

require_once("config.php");

function getFacilities(){
    global $conn;

    $sql = $conn->prepare("SELECT * FROM sportfacilities");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getAllCentres(){
    global $conn;
    $sql = "SELECT * FROM sportcentres";

    $result = $conn->query($sql);

    return $result;
}

function deleteFacilityById(int $facility_id){
    global $conn;
    $sql = $conn->prepare("DELETE FROM sportfacilities WHERE facility_id = :facility_id");
    $sql->bindParam(':facility_id', $facility_id);
    $sql->execute();
}

function getFacilityByName(string $facility_name){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sportfacilities WHERE facility_name = :name");
    $sql->bindParam(':name', $facility_name);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function getFavouriteFacilities(int $user_id){
    global $conn;

    $sql = $conn->prepare("SELECT * FROM sportfacilities JOIN favourites ON favourites.facility_id = sportfacilities.facility_id WHERE user_id = :user_id");
    $sql->bindParam(':user_id', $user_id);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getFacilitiesByCentreId(string $centre_id){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sportfacilities WHERE centre_id = :centre_id");
    $sql->bindParam(':centre_id', $centre_id);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getFacilitiesBySportId(string $sport_id){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sportfacilities WHERE sport_id = :sport_id");
    $sql->bindParam(':sport_id', $sport_id);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getFacilityById(int $facility_id){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sportfacilities WHERE facility_id = :facility_id");
    $sql->bindParam(':facility_id', $facility_id);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function getFacilitiesByPriceRange(int $min, int $max){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sportfacilities WHERE booking_price >= :min AND booking_price <= :max");
    $sql->bindParam(':min', $min);
    $sql->bindParam(':max', $max);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getCentreById(int $centre_id){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sportcentres WHERE centre_id = :centre_id");
    $sql->bindParam(':centre_id', $centre_id);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function getCentreByName(string $centre_name){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sportcentres WHERE centre_name = :name");
    $sql->bindParam(':name', $centre_name);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function deleteCentreById(int $centre_id){
    global $conn;
    $sql = $conn->prepare("DELETE FROM sportcentres WHERE centre_id = :centre_id");
    $sql->bindParam(':centre_id', $centre_id);
    $sql->execute();
}


function createReservation(String $date, String $start_time, String $end_time, int $facility_id, int $user_id, String $facility_name, String $image_path){
    global $conn;
    $sql = "INSERT INTO reservations (facility_id, user_id, date, start_time, end_time, facility_name, image_path) VALUES (:facility_id, :user_id, :date, :start_time, :end_time, :facility_name, :image_path)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':facility_id', $facility_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':start_time', $start_time);
    $stmt->bindParam(':end_time', $end_time);
    $stmt->bindParam(':facility_name', $facility_name);
    $stmt->bindParam(':image_path', $image_path);
    $stmt->execute();
}

function checkReservation($date, $time, $facility_id): bool
{
    global $conn;
    $query = "SELECT COUNT(*) FROM reservations WHERE date = :date AND start_time = :time AND facility_id =:facility_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':facility_id', $facility_id);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    return $count > 0;
}

function getReservationsByUserId(int $user_id){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM reservations WHERE user_id = :user_id");
    $sql->bindParam(':user_id', $user_id);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getAllReservations(){
    global $conn;
    $sql = "SELECT * FROM reservations";

    $result = $conn->query($sql);

    return $result;
}

function deleteReservationById(int $reservation_id){
    global $conn;
    $sql = $conn->prepare("DELETE FROM reservations WHERE reservation_id = :reservation_id");
    $sql->bindParam(':reservation_id', $reservation_id);
    $sql->execute();
}



function getUserById(int $user_id){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM users WHERE user_id = :user_id");
    $sql->bindParam(':user_id', $user_id);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    return $result;
}


function getAllUsers(){
    global $conn;
    $sql = "SELECT * FROM users";

    $result = $conn->query($sql);

    return $result;
}
function getUserDetailsById(int $user_id){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM userdetails WHERE user_id = :user_id");
    $sql->bindParam(':user_id', $user_id);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function getAllSports(){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sports");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getSportById(int $sport_id){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sports WHERE sport_id = :sport_id");
    $sql->bindParam(':sport_id', $sport_id);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function createOrGetSportId(string $sportName){
    global $conn;
    $stmt = $conn->prepare("SELECT sport_id FROM sports WHERE sport_name = :sport_name");
    $stmt->bindParam(':sport_name', $sportName);
    $stmt->execute();
    $existingSportId = $stmt->fetchColumn();

    if ($existingSportId) {
        return $existingSportId;
    } else {
        $stmt = $conn->prepare("INSERT INTO sports (sport_name) VALUES (:sport_name)");
        $stmt->bindParam(':sport_name', $sportName);
        $stmt->execute();

        return $conn->lastInsertId();
    }
}

function addToFavourite(int $facility_id, int $user_id){
    global $conn;
    $sql = "INSERT INTO favourites (facility_id, user_id) VALUES (:facility_id, :user_id)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':facility_id', $facility_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
}

function deleteFromFavourite(int $facility_id, int $user_id){
    global $conn;
    $sql = "DELETE FROM favourites WHERE user_id = :user_id AND facility_id = :facility_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':facility_id', $facility_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
}

function isFavourite(int $facility_id, int $user_id): bool
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM favourites WHERE user_id = :user_id AND facility_id = :facility_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':facility_id', $facility_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if($count > 0)
        return true;
    else
        return false;
}