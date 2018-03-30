<?php
session_start();
/**
 * Form posting handler
 */
$pagePath = explode('/wp-content/', dirname(__FILE__));
include_once(str_replace('wp-content/' , '', $pagePath[0] . '/wp-load.php'));

/**
* Add transaction info to database 
*/

if ( isset($_GET['func']) && $_GET['func'] == 'addrow') {

    global $wpdb;

    $wpdb->query('CREATE TABLE IF NOT EXISTS `td_url` (
                      `main_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                      `url` TEXT NOT NULL 
                      ) ENGINE = MYISAM ;');

    $url = $_POST['url'];

    $url_information = array(
        'url' => $url
    ); 

    $insert_format_url = array('%s');
        
    $wpdb->insert('td_url', $url_information, $insert_format_url);



    $wpdb->query('CREATE TABLE IF NOT EXISTS `td_payments` (
            `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `token` TEXT NOT NULL,
            `name` TEXT NOT NULL,
            `email` TEXT NOT NULL,
            `phone` TEXT NOT NULL,
            `package` TEXT NOT NULL,
            `price` TEXT NOT NULL,
            `currency` TEXT NOT NULL,
            `payment_type` TEXT NOT NULL,
            `status` TEXT NOT NULL,
            `custom_id` TEXT NOT NULL,
            `transaction_id` TEXT NOT NULL,
            `sumary` TEXT NOT NULL,
            `created` INT( 4 ) UNSIGNED NOT NULL
    ) ENGINE = MYISAM ;');
    

    global $redux_demo, $package_price;

    // Get the credit card details submitted by the form
    $planTOKEN = "";
    if ( !is_user_logged_in() ) {
        $planEMAIL     = $_POST['paypal-payment-email'];
    } else {
        global $current_user, $user_id, $user_info;
        get_currentuserinfo();
        $user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.
        $user_email = get_the_author_meta('user_email', $user_id);
        $planEMAIL     = $user_email;
    }   
    $planID        = $_POST['paypal-payment-package'];
    $planPACKAGE = get_the_title( $planID );
    $package_price = get_post_meta($planID, 'package_price', true);

    if(empty($package_price) or $package_price == 0) {
        $package_price = __( 'Free', 'themesdojo' );
        $currency_symbol = "";
    } else {
        $currency_symbol = $redux_demo['currency-symbol'];
    }

    $planPRICE = $package_price;
    $planCURRENCY = $currency_symbol;
    $planTYPE = "PayPal";
    $planSTATUS = "in progress";
    $planCustomID = $_POST['PAYMENTREQUEST_0_CUSTOM'];

    $price_plan_information = array(
        'token' => $planTOKEN,
        'email' => $planEMAIL,
        'package_id' => $planID,
        'package_name' => $planPACKAGE,
        'price' => $planPRICE,
        'currency' => $planCURRENCY,
        'payment_type' => $planTYPE,
        'status' => $planSTATUS,
        'created' => time(),
        'custom_id' => $planCustomID
    ); 

    $insert_format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');
            
    $wpdb->insert('td_payments', $price_plan_information, $insert_format);

    $user = get_user_by( 'email', $planEMAIL );
    $user_id = $user->ID;

    update_user_meta( $user_id, "user_featured_listings_used_".$planCustomID, "0" );
    update_user_meta( $user_id, "user_regular_listings_used_".$planCustomID, "0" );

}

/**
* End function
*/



require THEME_DOCUMENT_ROOT .'/inc/payments/paypal/paypalapi.php';

if ( isset($_GET['func']) && $_GET['func'] == 'confirm' && isset($_GET['token']) && isset($_GET['PayerID']) ) {
    WPCAds_PayPalAPI::ConfirmExpressCheckout();
  
    if ( isset( $_SESSION['RETURN_URL'] ) ) {
        $url = $_SESSION['RETURN_URL'];
        unset($_SESSION['RETURN_URL']);
        header('Location: '.$url);
        exit;
    }
  
    if ( is_numeric(get_option('paypal_success_page')) && get_option('paypal_success_page') > 0 )
        header('Location: '.get_permalink(get_option('paypal_success_page')));
    else
        header('Location: '.home_url());
    exit;
}

if ( ! count($_POST) )
    trigger_error('Payment error code: #00001', E_USER_ERROR);

$allowed_func = array('start');
if ( count($_POST) && (! isset($_POST['func']) || ! in_array($_POST['func'], $allowed_func)) )
    trigger_error('Payment error code: #00002', E_USER_ERROR);
  
if ( count($_POST) && (! $package_price || ! is_numeric($package_price) || $package_price < 0) )
    trigger_error('Payment error code: #00003', E_USER_ERROR);
  
switch ( $_POST['func'] ) {
    case 'start':
        WPCAds_PayPalAPI::StartExpressCheckout();
        break;
}