<?php

$months = array(
    'Jan',
    'Fév',
    'Mar',
    'Avr',
    'Mai',
    'Jun',
    'Jul',
    'Aou',
    'Sep',
    'Oct',
    'Nov',
    'Déc'
);

$weekday = array(
    'Lundi',
    'Mardi',
    'Mercredi',
    'Jeudi',
    'Vendredi',
    'Samedi',
    'Dimanche'
);

$id_months         = intval(strftime("%m", strtotime($date))) - 1;
$id_weekday        = intval(strftime("%u", strtotime($date))) - 1;
$trans_months      = htmlentities(utf8_decode($months[$id_months]));
$trans_weekday     = htmlentities(utf8_decode($weekday[$id_weekday]));
$month             = $trans_months;
$week              = $trans_weekday;