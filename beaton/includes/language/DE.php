<?php

$months = array(
    'Jän',
    'Feb',
    'Mär',
    'Apr',
    'Mai',
    'Jun',
    'Jul',
    'Aug',
    'Sep',
    'Okt',
    'Nov',
    'Dez'
);

$weekday = array(
	'Montag',
    'Dienstag',
    'Mittwoch',
    'Donnerstag',
    'Freitag',
    'Sonnabend',
    'Sonntag'
);

$id_months         = intval(strftime("%m", strtotime($date))) - 1;
$id_weekday        = intval(strftime("%u", strtotime($date))) - 1;
$trans_months      = htmlentities(utf8_decode($months[$id_months]));
$trans_weekday     = htmlentities(utf8_decode($weekday[$id_weekday]));
$month             = $trans_months;
$week              = $trans_weekday;