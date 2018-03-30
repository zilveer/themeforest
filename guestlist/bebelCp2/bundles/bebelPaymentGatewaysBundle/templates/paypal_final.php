<?php

define('WP_USE_THEMES', false);
include_once '../../../../../../../wp-load.php';
include_once TEMPLATEPATH.'/functions.php';

$prefix = $bSettings->getPrefixUnderscored();

if(!isset($_SESSION[$prefix.'userdata']) || !isset($_SESSION[$prefix.'paypaldata']))
{
    $home = get_bloginfo('wpurl');
    header("Location: $home");
    
}else {
    
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
    
    $resArray = maybe_unserialize($_SESSION[$prefix.'paypaldata']);
       
    $paymentAmount = urlencode ($resArray['AMT']);
    $currCodeType = urlencode($resArray['CURRENCYCODE']);
    $payerID = urlencode($resArray['PayerID']);
    $serverName = urlencode($_SERVER['SERVER_NAME']);
    $token = $resArray['TOKEN'];

    
    $final = new bebelEventsPayPal();
    $final->setToken($token);
    $final->setCurrency($currCodeType);
    
    $final->setFromArray(array(
        'PAYERID' => $payerID,
        'IPADDRESS' => $serverName,
        'PAYMENTACTION' => 'SALE',
        'AMT' => $paymentAmount
    ));
        
    $finalRes = $final->hashCall('DoExpressCheckoutPayment');
    
    $_SESSION['purchased'] = maybe_serialize($finalRes);
    
    $query->the_post();
    $permalink = get_permalink(get_the_ID());
    
    
    $ack = strtoupper($resArray["ACK"]);
    if($ack != 'SUCCESS' && $ack != 'SUCCESSWITHWARNING')
    {
        
        // return to error page
        $return_link = BebelUtils::addParameterToPermalink($permalink, array('step' => 'error'));
        header("Location: $return_link");
    }else {
        
        
        // everything went fine, we can now insert the event and send emails and stuff.
        
        $event = new bebelEvents($event_id);
        $event->createQuery();
        $event->validateFields(array(), $userdata); // we already validated the data
        
        // check for mailchimp support
        if($bSettings->get('events_enable_mailchimp') == 'on' && $userdata['send_newsletter'] == "true") 
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
        
    }
    
    
}