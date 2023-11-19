<?php

require_once("config.php");

function getFacilities(){
    global $conn;
    $sql = "SELECT * FROM sportfacilities";

    $result = $conn->query($sql);

    return $result;
}

function getAllCentres(){
    global $conn;
    $sql = "SELECT * FROM sportcentres";

    $result = $conn->query($sql);

    return $result;
}

function getFacilityByName(string $facility_name){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sportfacilities WHERE facility_name = :name");
    $sql->bindParam(':name', $facility_name);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

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

function getCentreById(int $centre_id){
    global $conn;
    $sql = $conn->prepare("SELECT * FROM sportcentres WHERE centre_id = :centre_id");
    $sql->bindParam(':centre_id', $centre_id);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    return $result;
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