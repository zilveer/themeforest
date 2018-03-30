<?php

$months = array(
    'Gen',
    'Feb',
    'Mar',
    'Apr',
    'Mag',
    'Giu',
    'Lug',
    'Ago',
    'Set',
    'Ott',
    'Nov',
    'Dic'
);

$weekday = array(
    'Lunedì',
    'Martedì',
    'Mercoledì',
    'Giovedì',
    'Venerdì',
    'Sabato',
    'Domenica'
);

$id_months         = intval(strftime("%m", strtotime($date))) - 1;
$id_weekday        = intval(strftime("%u", strtotime($date))) - 1;
$trans_months      = htmlentities(utf8_decode($months[$id_months]));
$trans_weekday     = htmlentities(utf8_decode($weekday[$id_weekday]));
$month             = $trans_months;
$week              = $trans_weekday;