<?php

define('WP_USE_THEMES', false);
include_once '../../../../../../../wp-load.php';
include_once TEMPLATEPATH.'/functions.php';

$prefix = $bSettings->getPrefixUnderscored();

if(!isset($_GET['token']))
{
    
    foreach($_POST as $key => $value)
    {
        $valid_data[esc_attr($key)] = esc_attr($value);
    }
    
    // clean up the session to not interfere with anything we want to do.
    foreach($_SESSION as $key => $value)
    {
        unset($_SESSION[$key]);
    }

    if(!isset($valid_data['event_id'])) {
        die ('<ul class="error"><li>hacking attempt failed</li></ul>');
    }

    // we will have to save the event id in the session or we cannot debug anymore.
    $_SESSION['event_id'] = $valid_data['event_id'];
    
    
    // create new bebelEvents object
    $event = new bebelEvents($valid_data['event_id']);
    $event->createQuery();
    $query = $event->getQuery();
    
    // post is invalid
    if($query->post_count > 1)
    {
        die ('<ul class="error"><li>hacking attempt failed</li></ul>');
    }

    // check for a free slot
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
        $event->displayErrors(); // will be redirected to the error page (see templates/payment/error.php). errors are saved in session
    }
    
    
    // save the user's data in the session, cause as of now we will redirect to the error page with validated data
    $_SESSION[$prefix.'userdata']  = maybe_serialize($valid_data);
    
    
    // check if user is already on the list
    $event->checkForSignUp();
    if(!$event->isValid())
    {
        $event->displayErrors(); // will be redirected to the error page (see templates/payment/error.php). errors are saved in session
    }

    
    $query->the_post();
    $permalink = get_permalink();
    $permalink = BebelUtils::addParameterToPermalink($permalink, array('step' => 'error'));
    
    // create new paypal object and fill it with the necessary data.
    $paypal = new bebelEventsPayPal();
    $paypal->setReturnUrl()->setCancelUrl($permalink);
    $paypal->setEvent($query);
    $paypal->setValidatedData($valid_data);
    $paypal->gatherData();
    $resArray = $paypal->hashCall("SetExpressCheckout");
    
    
    
    
    $ack = strtoupper($resArray["ACK"]);
    
    if($ack=="SUCCESS"){
        
        $payPalURL = $paypal->getPaypalUrl().$resArray["TOKEN"];
        header("Location: ".$payPalURL);
    } else  {
        
        header("Location: $permalink");
        
    }
}else {
    
    // we've to a positive answer from paypal.
    // now all we need to do is to send the user to the last confirmation step
    
    $userdata = maybe_unserialize($_SESSION[$prefix.'userdata']);
    $event_id = esc_attr($userdata['event_id']);
    
    $args = array(
        'p' => $event_id,
        'post_type' => 'any'

    );
    $query = new WP_Query($args);
    
    // post is invalid
    if($query->post_count > 1)
    {
        die ('<ul class="error"><li>hacking attempt failed</li></ul>');
    }
    
    // get the token from the url
    $token = esc_attr($_GET['token']);
    
    
    $paypal = new bebelEventsPayPal();
    $paypal->setToken($token);
    $resArray = $paypal->hashCall('GetExpressCheckoutDetails');
    
    // save payerid in same array
    $resArray['PayerID'] = esc_attr($_GET['PayerID']);
    
    // set up redirection link
    $query->the_post();
    $permalink = get_permalink(get_the_ID());
    
    
    
    // check if paypal send us an ok and redirect to the site of our choice
    $ack = strtoupper($resArray["ACK"]);
    
    if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING')
    {
        // no problem, continue
        $_SESSION[$prefix.'userdata']   = maybe_serialize($userdata);
        $_SESSION[$prefix.'paypaldata'] = maybe_serialize($resArray);
        
        $return_link = BebelUtils::addParameterToPermalink($permalink, array('step' => 'process'));
        header("Location: $return_link");
        
        
    }else {
       
        // return to error page
        $return_link = BebelUtils::addParameterToPermalink($permalink, array('step' => 'error'));
        header("Location: $return_link");
    }
    
    
    
    
}