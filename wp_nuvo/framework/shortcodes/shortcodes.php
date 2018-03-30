<?php
$elements = array(
    'blogcolumns',
    'coverslider',
    'custombtn',
    'dropdown',
    'googlemapv3',
    'highlight',
    'icon',
    'introlist',
    'lists',
    'portfolio',
    'portfoliocarousel',
    'postcarousel',
    'pointcarousel',
    'menufood',
    'logo',
    'menu',
    'video',
	'twitter'
);
/*
 * Elements
 */
foreach ($elements as $element) {
    include_once ($element . '/' . $element . '.php');
}
/*
 * Woocommerce
 */
$wooshops = array(
    'shopcarousel'
);
if (class_exists('Woocommerce')) {
    foreach ($wooshops as $wooshop) {
        include ($wooshop . '/' . $wooshop . '.php');
    }
}
/*
 * Events Manager
 */
if (class_exists('EM_MS_Globals')) {
    include_once 'eventscarousel/eventscarousel.php';
    include_once 'eventcountdown/eventcountdown.php';
    include_once 'eventscalendar/eventscalendar.php';
}
/*
 * Booking Table
 */
if (class_exists('rtbInit')) {
    include_once 'bookingtable/bookingtable.php';
}