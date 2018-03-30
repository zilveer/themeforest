<?php

$months = array(
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'Jun',
    'Jul',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec'
);

$weekday = array(
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday',
    'Sunday'
);

$id_months         = intval(strftime("%m", strtotime($date))) - 1;
$id_weekday        = intval(strftime("%u", strtotime($date))) - 1;
$trans_months      = htmlentities(utf8_decode($months[$id_months]));
$trans_weekday     = htmlentities(utf8_decode($weekday[$id_weekday]));
$month             = $trans_months;
$week              = $trans_weekday;