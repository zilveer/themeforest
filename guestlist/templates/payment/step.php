<?php

/*
 * Contains the last step before the final payment.
 * 
 * 
 */


$url_form = get_stylesheet_directory_uri().'/bebelCp2/bundles/bebelPaymentGatewaysBundle/templates/paypal_final.php'; 


// check for our data in the session

$userdata = maybe_unserialize($_SESSION[$prefix.'userdata']);
$paypaldata = maybe_unserialize($_SESSION[$prefix.'paypaldata']);

// if any of these arrays is empty, include error.php
if(empty($userdata) || empty($paypaldata))
{
    include 'error.php';
}else {

    $cancel_link = BebelUtils::addParameterToPermalink(get_permalink(), array('step' => 'cancel'));
    
    
?>
<form action="<?php echo $url_form ?>" method="post" id="event-subscribe-form" class="validate" >


    <h1><?php the_title(); ?></h1>
    <h4><?php _e('You are purchasing <b>1</b> ticket for this event.', $bSettings->getPrefix()) ?></h4>

    <div class="details">

        <h5><?php _e('Details: ', $bSettings->getPrefix()) ?></h5>
        <div class="left">
            <?php _e('First Name: ', $bSettings->getPrefix()) ?>
        </div>
        <div class="right">
            <?php echo $paypaldata['FIRSTNAME'] ?>
        </div>
        <div class="left">
            <?php _e('Last Name: ', $bSettings->getPrefix()) ?>
        </div>
        <div class="right">
            <?php echo $paypaldata['LASTNAME'] ?>
        </div>
        <div class="left">
            <?php _e('Email: ', $bSettings->getPrefix()) ?><br>
            <span class="small"><?php _e('For sign up', $bSettings->getPrefix()) ?></span>
        </div>
        <div class="right">
            <?php echo $userdata['email'] ?>
        </div>
        <div class="divider"></div>
        <div class="left">
            <?php _e('Price: ', $bSettings->getPrefix()) ?>
        </div>
        <div class="right">
            <?php echo $eventprice ?> <?php echo $paypaldata['CURRENCYCODE'] ?>
        </div>
        <div class="left">
            <?php _e('Email: ', $bSettings->getPrefix()) ?><br>
            <span class="small"><?php _e('For payment ', $bSettings->getPrefix()) ?></span>
        </div>
        <div class="right">
            <?php echo $paypaldata['EMAIL'] ?>
        </div>
        <div class="left">
            <?php _e('Payment Method: ', $bSettings->getPrefix()) ?>
        </div>
        <div class="right">
            <img src="https://www.paypalobjects.com/en_US/i/logo/PayPal_mark_60x38.gif" alt="<?php _e('paypal logo', $bSettings->getPrefix()) ?>">
        </div>
        <br class="clear" />

    </div>
    <br class="clear" />
    <p><?php _e('If you click on pay now the payment will be processed and you purchase this event ticket. This is the last possibility to cancel.', $bSettings->getPrefix()) ?></p>

    <a href="<?php echo $cancel_link ?>" class="cancel"><?php _e('Cancel', $bSettings->getPrefix()) ?></a>

    <input type="submit" class="submit" value="<?php _e('Pay now', $bSettings->getPrefix()) ?>" />




</form>

<?php 
}
?>