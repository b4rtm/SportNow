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
?>