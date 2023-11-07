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