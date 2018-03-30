<?php

/*
 * this file does some less heavy work.
 * 
 * we have to check locally if:
 * 
 * - the post the data comes from exists
 * - check if all the fields are filled out and valid
 * 
 * submit form then.
 */

define('WP_USE_THEMES', false);
include_once '../../../../../wp-load.php';
include_once TEMPLATEPATH.'/functions.php';



foreach($_POST as $key => $value)
{
    $valid_data[esc_attr($key)] = esc_attr($value);
}


// first of all, check for errors.
$required_values = array(
    'name',
    'email',
    'message',
);

$errors = array();

foreach($required_values as $req)
{
    switch($req)
    {
        case 'name':
            if($valid_data[$req] == '')
            {
               $errors[] = _x("Please enter a valid name.", $bSettings->getPrefix()); 
            }
            break;
            
        case 'email':
            if($valid_data[$req] == '' || !is_email($valid_data[$req]))
            {
               $errors[] = _x("Please enter a valid email address.", $bSettings->getPrefix()); 
            }
            break;
        case 'message':
            if($valid_data[$req] === false)
            {
                $errors[] = _x("Please write us some text ;)", $bSettings->getPrefix()); 
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
    $return .= '<?ul>';

    die($return);

}



// send email
$mailer = new simpleContactMailer();
$mailer->setMessage($valid_data)->send();





$return = '<ul class="success"><li>';
$return .= _x('You have successfully sent a mail to our team. We will get back to you as soon as we can!', $bSettings->getPrefix());
$return .= '</li></ul>';


die($return);