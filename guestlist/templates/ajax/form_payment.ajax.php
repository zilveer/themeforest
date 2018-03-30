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

$args = array(
    'p' => $valid_data['event_id'],
    'post_type' => 'any'
    
);
$query = new WP_Query($args);

// post is invalid
if($query->post_count > 1)
{
    die ('<ul class="error"><li>hacking attempt failed</li></ul>');
}

// setup post data for further manipulation
// needed ?!


$mc_signed = false;
$event_signed = false;
$messages = array();
$errors = array();

// first of all, check for errors.
$required_values = array(
    'first_name',
    'last_name',
    'email',
);

if($bSettings->get('events_terms_conditions_enable') == 'on') 
{
    $required_values[] = 'terms_read';
}

foreach($required_values as $req)
{
    switch($req)
    {
        case 'first_name':
        case 'last_name':
            if($valid_data[$req] == '')
            {
               $errors[] = _x("Please enter a valid first and last name.", $bSettings->getPrefix()); 
            }
            break;
            
        case 'email':
            if($valid_data[$req] == '' || !is_email($valid_data[$req]))
            {
               $errors[] = _x("Please enter a valid email address.", $bSettings->getPrefix()); 
            }
            break;
        case 'terms_read':
            if($valid_data[$req] === false)
            {
               $errors[] = _x("Please accept the terms and conditions.", $bSettings->getPrefix()); 
            }
            break;
    }
}

if(count($errors) > 0)
{
    $return = '<ul class="error">';
    foreach($errors as $message)
    {
        $return .= '<li>'.$message.'</li>';
    }
    $return .= '</ul>';

    die($return);

}

die("ok");