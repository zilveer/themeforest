<?php

/*
 * this file does some heavy work.
 *
 * 
 * then, check if
 * 
 * - mailchimp is activated
 * -- which lists are used for this specific event
 * -- if mc is available
 * -- if the list we want to use (still) exists
 * 
 * then
 * - add users to mailchimp list
 * - check for errors
 * 
 * 
 * then, finally we can do this:
 *
 * - add users to local database 
 * - send an email
 * - send a success message to the frontend
 * - be happy and drink a beer.
 * 
 * 
 * 
 */

define('WP_USE_THEMES', false);
include_once '../../../../../wp-load.php';
include_once TEMPLATEPATH.'/functions.php';




foreach($_POST as $key => $value)
{
    $valid_data[esc_attr($key)] = esc_attr($value);
}

// add newsletter to array
$valid_data['send_newsletter'] = "true";


$event = new bebelEvents(0);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  $event->isAjaxCall();
}


$event->createQuery();

$query = $event->getQuery();


// first of all, check for errors.
$required_values = array(
    'first_name' => 'string',
    'last_name' => 'string',
    'email' => 'email',
);

$event->validateFields($required_values, $valid_data);

// some errors occured
if(!$event->isValid())
{
    $event->displayErrors();
}


// check for mailchimp support
if($bSettings->get('events_enable_mailchimp') == 'on') 
{
    $event->manageMailchimp();
}


$event->putUserOnList(true);

if($event->isValid())
{
    $event->displaySuccess();
}else {
    $event->displayErrors();
}