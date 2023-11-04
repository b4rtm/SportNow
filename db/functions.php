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
