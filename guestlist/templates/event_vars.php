<?php

$startdate  = strtotime(BebelUtils::getCustomMeta('event_registration_start', '', get_the_ID()));
$enddate    = strtotime(BebelUtils::getCustomMeta('event_registration_end', '', get_the_ID()));

$eventdate  = strtotime(BebelUtils::getCustomMeta('event_date', '', get_the_ID()));

$eventprice = BebelUtils::getCustomMeta('event_price', '', get_the_ID());
$eventcurrency = BebelUtils::getCustomMeta('event_currency', '', get_the_ID());


$eventlocation = BebelUtils::getCustomMeta('event_location', '', get_the_ID());
$subtitle   = BebelUtils::getCustomMeta('event_subtitle', '', get_the_ID());

$button_text  = BebelUtils::getCustomMeta('event_button_text', '', get_the_ID());


$formtitle   = BebelUtils::getCustomMeta('event_formtitle', '', get_the_ID());
if($formtitle == '')
{
    $formtitle = $bSettings->get('events_default_formtitle');
}

// check if there are slots left
$has_free_slots = bebelEventsUtils::checkForFreeSlot(get_the_id());
