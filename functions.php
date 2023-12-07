<?php

function getDates(): array
{
    $startDate = new DateTime('tomorrow');
    $endDate = clone $startDate;
    $dates = array();


    $endDate->add(new DateInterval('P6D'));


    while ($startDate <= $endDate) {
        $dates[] = $startDate->format('Y-m-d');
        $startDate->add(new DateInterval('P1D'));
    }
    return $dates;
}

function getTimes($facility): array
{
    $startHour = $facility["opening_hour"];
    $endHour = $facility["closing_hour"];

    $interval = new DateInterval('PT1H');
    $time = new DateTime("$startHour:00");

    $times = array();

    while ($time->format('H:i') < $endHour . ":00") {
        $times[] = $time->format('H:i');
        $time->add($interval);
    }
    return $times;
}

function compareFacilities($obj1, $obj2) {
    return $obj1['facility_id'] - $obj2['facility_id'];
}

function getMinMaxPriceRange($priceCategory) {
    if ($priceCategory == '1') {
        $min = 0;
        $max = 20;
    } elseif ($priceCategory == '2') {
        $min = 21;
        $max = 50;
    } elseif ($priceCategory == '3') {
        $min = 51;
        $max = 100;
    } elseif ($priceCategory == '4') {
        $min = 101;
        $max = 10000;
    } else {
        $min = 0;
        $max = 0;
    }

    return array('min' => $min, 'max' => $max);
}

function processString($input): string {
    $stripped_input = stripslashes($input);
    $trimmed_input = trim($stripped_input);
    $processed_input = htmlspecialchars($trimmed_input, ENT_QUOTES, 'UTF-8');

    return $processed_input;
}
?>