<?php
/**
 * IPN For Paypal
 * @package by Theme Record
 * @auther: MattMao
*/
$current_url = dirname(__FILE__);
$wp_content_pos = strpos($current_url, 'wp-content');
$wp_content = substr($current_url, 0, $wp_content_pos);

require_once($wp_content . 'wp-load.php');
require_once('ipn-listener.php');

global $tr_config;
$current_currency = $tr_config['currency'];
$paypal_email = $tr_config['paypal_email'];
$paypal_sandbox = $tr_config['paypal_sandbox'];
$saler_send_email = $tr_config['saler_send_email'];
$saler_subject_text = $tr_config['saler_subject'];
$saler_message_text = $tr_config['saler_message'];
$buyer_subject_text = $tr_config['buyer_subject'];
$buyer_message_text = $tr_config['buyer_message'];


if($paypal_sandbox == 'yes')
{
	$enable_sandbox = true;
}
else
{
	$enable_sandbox = false;
}

/*
Here I am turning on PHP error logging to a file called "ipn_errors.log". Make
sure your web server has permissions to write to that file. In a production 
environment it is better to have that log file outside of the web root.
*/
ini_set('log_errors', true);
ini_set('error_log', FUNCTIONS_DIR.'/shop/ipn_errors.log');


// instantiate the IpnListener class
$listener = new IpnListener();


/*
When you are testing your IPN script you should be using a PayPal "Sandbox"
account: https://developer.paypal.com
When you are ready to go live change use_sandbox to false.
*/
$listener->use_sandbox = $enable_sandbox;


/*
The processIpn() method will encode the POST variables sent by PayPal and then
POST them back to the PayPal server. An exception will be thrown if there is 
a fatal error (cannot connect, your server is not configured properly, etc.).
Use a try/catch block to catch these fatal errors and log to the ipn_errors.log
file we setup at the top of this file.

The processIpn() method will send the raw data on 'php://input' to PayPal. You
can optionally pass the data to processIpn() yourself:
$verified = $listener->processIpn($my_post_data);
*/
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}



/*
The processIpn() method returned true if the IPN was "VERIFIED" and false if it
was "INVALID".

1. Check the $_POST['payment_status'] is "Completed"
2. Check that $_POST['txn_id'] has not been previously processed 
3. Check that $_POST['receiver_email'] is your Primary PayPal email 
4. Check that $_POST['payment_amount'] and $_POST['payment_currency']
*/
if ($verified) {

	/*
	 *Get the data
	*/
	$prefix = 'TR_';


	// You should validate against these values.
	$first_name 		= $_POST['first_name'];
	$last_name 		= $_POST['last_name'];
	$address_street 	= $_POST['address_street'];
	$address_city 	= $_POST['address_city'];
	$address_state 	= $_POST['address_state'];
	$address_country 	= $_POST['address_country'];
	$address_zip 	= $_POST['address_zip'];
	$payer_email 	= $_POST['payer_email'];
	$receiver_email = $_POST['receiver_email'];
	$payment_status = $_POST['payment_status'];
	$payment_amount = $_POST['mc_gross'];
	$payment_fee = $_POST['mc_shipping'];
	$payment_currency = $_POST['mc_currency'];
	$item_name = $_POST['item_name'];
	$item_number = $_POST['item_number'];
	$quantity = $_POST['quantity'];
	$txn_id 			= $_POST['txn_id'];
	$customer_note = $_POST['memo'];
	$order_title = 'Order &ndash; '.date('Y-m-d @ h:i A', strtotime($payment_date));


	//Read the item details
	$i=1;
	while (isset($_POST['item_number'.$i]))
	{
		$item_ID[$i]=$_POST['item_number'.$i];
		$item_name[$i]=urldecode($_POST['item_name'.$i]);
		$item_qty[$i]=$_POST['quantity'.$i];
		$item_fee[$i]=$_POST['mc_shipping'.$i];
		$item_cost[$i]=$_POST['mc_gross_'.$i];
		$i++;
	}
	$item_count = $i-1;


	//Item Purchased
	$item_purchased = '<tbody>';
	for ($j=1;$j<=$item_count;$j++) {
		$item_purchased .= '<tr>';
		$item_purchased .= '<td class="item-name">'.$item_name[$j].'</td>';
		$item_purchased .= '<td class="item-qty">'.$item_qty[$j].'</td>';
		$item_purchased .= '<td class="item-cost">'.price_currency_symbol($current_currency).number_format((($item_cost[$j]-$item_fee[$j])/$item_qty[$j]), 2).'</td>';
		$item_purchased .= '</tr>';
	}
	$item_purchased .= '</tbody>';


	if($payment_status == 'Completed' && 
		$current_currency == $payment_currency && 
		$paypal_email == $receiver_email && 
		get_order_txn_id($txn_id) == '0') 
	{

		//Add the order data
		$order_data = array(
			'post_status' => 'publish',
			'post_type' => 'shop_order',
			'post_author' => 1,
			'post_title' => $order_title,
			'post_content' => $customer_note,
		);

		$order_id = wp_insert_post($order_data);
		do_action('wpshop_new_order', $order_id);

		// Order status
		$order = new wpshop_order($order_id);
		$order->update_status('processing');

		//Update Meta
		update_post_meta($order_id, '_shipping_first_name', $first_name);
		update_post_meta($order_id, '_shipping_last_name', $last_name);
		update_post_meta($order_id, '_shipping_address', $address_street);
		update_post_meta($order_id, '_shipping_city', $address_city);
		update_post_meta($order_id, '_shipping_state', $address_state);
		update_post_meta($order_id, '_shipping_country', $address_country);
		update_post_meta($order_id, '_shipping_postcode', $address_zip);
		update_post_meta($order_id, '_payer_email', $payer_email);
		update_post_meta($order_id, '_payment_gross', $payment_amount);
		update_post_meta($order_id, '_payment_fee', $payment_fee);
		update_post_meta($order_id, '_txn_id', $txn_id);
		update_post_meta($order_id, '_item_purchased',  stripslashes($item_purchased));
	   
	    //Email settings
		$saler_email = $saler_send_email;
		$buyer_email = $payer_email;

		//Headers
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

		//Subject
		$saler_subject = $saler_subject_text;
		$buyer_subject = $buyer_subject_text;

		//Message
		$saler_message = '<html><head></head><body style=\"font-family:Arial,Helvetica,sans-serif;font-size:14px\">';
		$saler_message .= '<p>'.$saler_message_text.'</p>';
		$saler_message .= '<p>'.$first_name.' '.$last_name.'<br/>';
		$saler_message .= $address_street.'<br/>';
		$saler_message .= $address_city.'<br/>';
		$saler_message .= $address_state.'<br/>';
		$saler_message .= $address_country.'<br/>';
		$saler_message .= $address_zip.'</p>';
		$saler_message .= '<p>The details are below:</p>';
		$saler_message .= '<p>'.$item_purchased.'</p>';
		$saler_message .= '<p>Fee: '.price_currency_symbol($current_currency).number_format($payment_fee, 2).'</p>';
		$saler_message .= '<p>Total: '.price_currency_symbol($current_currency).number_format($payment_amount, 2).'</p>';
		$saler_message .= '</body></html>';

		$buyer_message = '<html><head></head><body style=\"font-family:Arial,Helvetica,sans-serif;font-size:14px\">';
		$buyer_message .= '<p>Dear '.$first_name.'</p>';
		$buyer_message .= '<p>'.$buyer_message_text.'</p>';
		$buyer_message .= '<p>'.$item_purchased.'</p>';
		$buyer_message .= '<p>Fee: '.price_currency_symbol($current_currency).number_format($payment_fee, 2).'</p>';
		$buyer_message .= '<p>Total: '.price_currency_symbol($current_currency).number_format($payment_amount, 2).'</p>';
		$buyer_message .= '</body></html>';
		
		wp_mail( $saler_email, $saler_subject, $saler_message, $headers );
		wp_mail( $buyer_email, $buyer_subject, $buyer_message, $headers );

		//wp_mail( $to, 'Verified IPN', $listener->getTextReport(), $headers );
	}
} 
else 
{  
	//wp_mail( $to, 'Invalid IPN', $listener->getTextReport(), $headers );
}


?> 
