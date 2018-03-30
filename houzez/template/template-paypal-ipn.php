<?php
/**
 * Template Name: Paypal IPN ( Recurring Payment )
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 11/09/16
 * Time: 3:30 PM
 */
/* -----------------------------------------------------------------------------------------------------------
*  Process Messages from Paypal IPN
 *
 * Reference Links:
 * https://developer.paypal.com/docs/classic/ipn/ht_ipn/
 * https://github.com/paypal/ipn-code-samples/blob/master/paypal_ipn.php
-------------------------------------------------------------------------------------------------------------*/
$token = '';
define('DEBUG',0);

$headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n".
    'Reply-To: noreply@'.$_SERVER['HTTP_HOST']. "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$houzezPost = array();

foreach ($raw_post_array as $keyval) {
    $keyval = explode ('=', $keyval);
    if (count($keyval) == 2)
        $houzezPost[$keyval[0]] = urldecode($keyval[1]);
}


/*
 * Read the post from PayPal system and add 'cmd'
 * ----------------------------------------------------*/
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
}

foreach ( $houzezPost as $key => $value ) {
    if( $get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1 ) {
        $value = urlencode(stripslashes($value));
    } else {
        $value = urlencode($value);
    }
    $req .= "&$key=$value";
}


/*
 * Step 2: POST IPN data back to PayPal to validate
 * ----------------------------------------------------*/
$paypal_api_status  =   esc_html( houzez_option('paypal_api') );
if( $paypal_api_status == 'live' ) {
    $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
} else {
    $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
}



$ch = curl_init($paypal_url);
if ($ch == FALSE) {
    return FALSE;
}

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

if(DEBUG == true) {
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}


/*
 * Set TCP timeout to 30 seconds
 * ----------------------------------------------------*/
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

$res = curl_exec($ch);

if ( curl_errno($ch) != 0 ) // cURL error
{
    if( DEBUG == true ) {
        //error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
    }
    curl_close($ch);
    exit;

} else {
    // Log the entire HTTP response if debug is switched on.
    if( DEBUG == true ) {
        // Split response headers and payload
        list($headers, $res) = explode("\r\n\r\n", $res, 2);
    }
    curl_close($ch);
}


/*
 * Inspect IPN validation result and act accordingly
 * ----------------------------------------------------*/
if (strcmp ($res, "VERIFIED") == 0) {

    $allowed_html          =  array();
    $paymentMethod         = 'Paypal';
    $payment_status        =  wp_kses ( esc_html( $_POST['payment_status'] ),$allowed_html );
    $txn_id                =  wp_kses ( esc_html ($_POST['txn_id']),$allowed_html );
    $txn_type              =  wp_kses ( esc_html($_POST['txn_type']),$allowed_html );
    $paypal_receiving_email =  esc_html( houzez_option('paypal_receiving_email') );
    $receiver_email        =  wp_kses ( esc_html($_POST['receiver_email']),$allowed_html );
    $payer_id              =  wp_kses ( esc_html($_POST['payer_id']),$allowed_html );

    $payer_email           =  wp_kses ( esc_html($_POST['payer_email']) ,$allowed_html);
    $amount                =  wp_kses ( esc_html($_POST['amount']),$allowed_html );
    $recurring_payment_id  =  wp_kses ( esc_html($_POST['recurring_payment_id']),$allowed_html );

    $user_id               =  houzez_retrive_user_by_profile( $recurring_payment_id );
    $pack_id               =  get_user_meta( $user_id, 'package_id',true );
    $price                 =  get_post_meta( $pack_id, 'fave_package_price', true );


    $houzez_mail = '';
    foreach ( $_POST as $key => $value ) {
        $key          = sanitize_key( $key );
        $value        = wp_kses(esc_html( $value), $allowed_html );
        $houzez_mail .= '['.$key.']='.$value.'</br>';
    }


    if( $payment_status == 'Completed' ) {

        if( $receiver_email != $paypal_rec_email) {
            exit();
        }

        // Payment already processd
        if( houzez_retrive_invoice_by_taxid( $txn_id ) ) {
            exit();
        }

        // No User Exist
        if( $user_id == 0 ) {
            exit();
        }

        // Received payment diffrent than pack value
        if( $amount != $price){
            exit();
        }

        houzez_save_user_packages_record($userID);
        houzez_update_membership_package($userID, $pack_id);

        $invoiceID = houzez_generate_invoice( 'package', 'recurring', $pack_id, $date, $userID, 0, 0, $txn_id, $paymentMethod );
        update_post_meta( $invoiceID, 'invoice_payment_status', 1 );

        $args  =array(
            'recurring_package_name' => get_the_title($pack_id),
            'merchant'               => 'Paypal'
        );
        houzez_email_type( $receiver_email, 'recurring_payment', $args );


    } else {
        // payment not completed
        if( $txn_type != 'recurring_payment_profile_created' ) {
            //houzez_downgrade_to_free($user_id);
        }
    }

} else if ( strcmp ($res, "INVALID") == 0 ) {
    exit('invalid');
}