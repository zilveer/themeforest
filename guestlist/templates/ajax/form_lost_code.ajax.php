<?php

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

// first of all, check for errors.
$required_values = array(
    'email' => 'email',
);


$event->validateFields($required_values, $valid_data);

// some errors occured
if(!$event->isValid())
{
    $event->displayErrors();
}


$event->lostKey();

if($event->isValid())
{
    $event->displaySuccess();
}else {
    $event->displayErrors();
}