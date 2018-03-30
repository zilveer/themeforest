<?php

/*
 * this file does some heavy work.
 * 
 * we have to check locally if:
 * 
 * - the post the data comes from exists
 * - check if all the fields are filled out and valid
 * 
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

if(!isset($valid_data['event_id'])) {
    die ('<ul class="error"><li>hacking attempt failed</li></ul>');
}


$event = new bebelEvents($valid_data['event_id']);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  $event->isAjaxCall();
}


$event->createQuery();

$query = $event->getQuery();

// post is invalid
if($query->post_count > 1)
{
    die ('<ul class="error"><li>hacking attempt failed</li></ul>');
}

$event->checkForFreeSlot();
if(!$event->isValid())
{
    $event->displayErrors(); // will be redirected to the error page (see templates/payment/error.php). errors are saved in session
}

// first of all, check for errors.
$required_values = array(
    'first_name' => 'string',
    'last_name' => 'string',
    'email' => 'email',
);

if($bSettings->get('events_terms_conditions_enable') == 'on') 
{
    $required_values['terms_read'] = 'checkbox';
}

$event->validateFields($required_values, $valid_data);


// some errors occured
if(!$event->isValid())
{
    $event->displayErrors();
}


// check for mailchimp support
if($bSettings->get('events_enable_mailchimp') == 'on' && $valid_data['send_newsletter'] == "true") 
{
    $event->manageMailchimp();
}


$event->putUserOnList();

if($event->isValid())
{
    $event->displaySuccess();
}else {
    $event->displayErrors();
}