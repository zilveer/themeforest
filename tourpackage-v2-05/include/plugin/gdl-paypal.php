<?php

if( !function_exists('gdlr_paypal_form') ){
	function gdlr_paypal_form($atts){
		extract( shortcode_atts(array('user'=>'', 'paypal'=>'Yes',
			'action'=>'https://www.paypal.com/cgi-bin/webscr', 'currency_code'=>'USD',
			'button_color'=>'#ff7d43', 'button_border'=>'#b56e4e'), $atts) );
			
			$package_type = get_post_meta(get_the_ID(), 'package-type',true);
			if( $package_type == 'Last Minute' ){
				$price_string = get_post_meta(get_the_ID(), 'package-last-minute-widget-text',true);
			}else{	
				$price_string = get_post_meta(get_the_ID(), 'package-price',true);
			}

			preg_match('/[0-9|,]*(\.[0-9]+|[0-9]+)/', $price_string, $matches);
			$price = str_replace(',', '', $matches[0]);
			
			ob_start();
?>
<div class="gdlr-paypal-form-wrapper">
	<h3 class="gdlr-paypal-form-head"><?php echo __('You are booking for :','gdl_front_end') . ' <span>' . get_the_title() . '</span>'; ?></h3>
	<form class="gdlr-paypal-form" action="<?php echo $action; ?>" method="post" data-ajax="<?php echo AJAX_URL; ?>" >
		<div class="gdlr-paypal-fields">
			<div class="six columns"><span class="gdlr-head"><?php echo __('Name *', 'gdl_front_end'); ?></span>
				<input class="gdlr-require" type="text" name="gdlr-name">
			</div>
			<div class="six columns gdlr-right"><span class="gdlr-head"><?php echo __('Last Name *', 'gdl_front_end'); ?></span>
				<input class="gdlr-require" type="text" name="gdlr-last-name">
			</div>
			<div class="clear"></div>
			<div class="six columns"><span class="gdlr-head"><?php echo __('Email *', 'gdl_front_end'); ?></span>
				<input class="gdlr-require gdlr-email" type="text" name="gdlr-email">
			</div>
			<div class="six columns gdlr-right"><span class="gdlr-head"><?php echo __('Phone', 'gdl_front_end'); ?></span>
				<input type="text" name="gdlr-phone">
			</div>		
			<div class="clear"></div>
			<div class="six columns"><span class="gdlr-head"><?php echo __('Address', 'gdl_front_end'); ?></span>
				<textarea name="gdlr-address"></textarea>
			</div>
			<div class="six columns gdlr-right"><span class="gdlr-head"><?php echo __('Additional Note', 'gdl_front_end'); ?></span>
				<textarea name="gdlr-additional-note"></textarea>
			</div>		
			<div class="clear"></div>
			<div class="six columns"><span class="gdlr-head"><?php echo __('Amount', 'gdl_front_end'); ?></span>
				<div class="gdlr-combobox">
					<select name="quantity">
<?php 
	$avail_num = intval(get_post_meta(get_the_ID(), 'post-option-available-num',true));
	if($avail_num == -1 ){ $avail_num = 10; }
	
	for( $i=1; $i<= $avail_num; $i++ ){
		echo '<option value="' . $i . '">' . $i . '</option>';
	}
?>					
					</select>
				</div>
			</div>	
			<div class="six columns gdlr-right"><span class="gdlr-head"><?php echo __('Total Price', 'gdl_front_end'); ?></span>
				<input type="hidden" class="gdlr-price-one" value="<?php echo $price; ?>" >
				<input type="text" name="gdlr-total-price" class="gdlr-total-price" value="<?php echo $price; ?>" disabled >
			</div>	
			<div class="clear"></div>
		</div>
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="<?php echo $user; ?>">
		<input type="hidden" name="item_name" value="<?php echo get_the_title(); ?>">
		<input type="hidden" name="item_number" value="<?php echo get_the_ID(); ?>">
		<input type="hidden" name="amount" value="<?php echo $price; ?>">    
		<input type="hidden" name="return" value="<?php echo get_permalink(); ?>">
		<input type="hidden" name="no_shipping" value="0">
		<input type="hidden" name="no_note" value="1">
		<input type="hidden" name="currency_code" value="<?php echo $currency_code; ?>">
		<input type="hidden" name="lc" value="AU">
		<input type="hidden" name="bn" value="PP-BuyNowBF">
		<input type="hidden" class="gdlr-paypal-action" name="action" value="">
		<input type="hidden" name="security" value="<?php echo wp_create_nonce('gdlr-paypal-create-nonce'); ?>">
		<div class="gdlr-notice email-invalid" ><?php echo __('Invalid Email Address ', 'gdl_front_end'); ?></div>
		<div class="gdlr-notice require-field" ><?php echo __('Please fill all required fields', 'gdl_front_end'); ?></div>
		<div class="gdlr-notice alert-message" ></div>
		<div class="gdlr-paypal-loader" ></div>
		
		<input type="button" class="gdlr-button-mail" value="<?php _e('Book By E-Mail And We Will Contact You Back', 'gdl_front_end'); ?>" >
		<?php if( $paypal == 'Yes' ){ ?>
		<div class="gdlr-paypal-or">
			<span class="gdlr-or-text"><?php _e('OR', 'gdl_front_end'); ?></span>
		</div>
		<input type="button" class="gdlr-button-paypal" value="<?php _e('Check Out Via PayPal', 'gdl_front_end'); ?>" style="background: <?php echo $button_color; ?>; border-color: <?php echo $button_border; ?>;">
		<?php } ?>
		<div class="clear"></div>
	</form>
</div>
<?php	
		$ret = ob_get_contents();
		ob_end_clean();
		
		return $ret;
	}	
}

// ajax to send contact form
add_action( 'wp_ajax_send_contact_form_mail', 'gdlr_send_contact_form_mail' );
add_action( 'wp_ajax_nopriv_send_contact_form_mail', 'gdlr_send_contact_form_mail' );
if( !function_exists('gdlr_send_contact_form_mail') ){
	function gdlr_send_contact_form_mail(){
		$ret = array();
		if( false && !check_ajax_referer('gdlr-paypal-create-nonce', 'security', false) ){
			$ret['status'] = 'failed'; 
			$ret['message'] = __('Invalid Nonce', 'gdl_front_end');
		}else{
			$recipient = get_option(THEME_SHORT_NAME.'_package_recipient_name', 'ORGANIZATION_NAME');
		
			$headers  = 'From: ' . $recipient . ' <' . $_POST['business'] . '>' . "\r\n";
			$message  = __('Package Name :', 'gdl_front_end') . ' ' . $_POST['item_name'] . "\r\n";
			$message .= __('Name :', 'gdl_front_end') . ' ' . $_POST['gdlr-name'] . ' ' . $_POST['gdlr-last-name'] . "\r\n";
			$message .= __('Email :', 'gdl_front_end') . ' ' . $_POST['gdlr-email'] . "\r\n";
			$message .= __('Phone :', 'gdl_front_end') . ' ' . $_POST['gdlr-phone'] . "\r\n";
			$message .= __('Quantity :', 'gdl_front_end') . ' ' . $_POST['quantity'] . "\r\n";
			$message .= __('Total Price :', 'gdl_front_end') . ' ' . (intval($_POST['quantity']) * floatval($_POST['amount'])) . "\r\n";
			$message .= __('Address :', 'gdl_front_end') . ' ' . $_POST['gdlr-address'] . "\r\n";
			$message .= __('Additional Message :', 'gdl_front_end') . ' ' . $_POST['gdlr-additional-note'] . "\r\n";
	
			if( wp_mail($_POST['business'], __('New message from your site', 'gdl_front_end'), $message, $headers ) ){
				$ret['status'] = 'success'; 
				$ret['message'] = __('Your message was sent successfully.', 'gdl_front_end');
			}else{
				$ret['status'] = 'failed'; 
				$ret['message'] = __('Failed to send your message. Please try later or contact the administrator by another method.', 'gdl_front_end');
			}
		}
		die(json_encode($ret));		
	}
}

// ajax to save form data
add_action( 'wp_ajax_save_paypal_form', 'gdlr_save_paypal_form' );
add_action( 'wp_ajax_nopriv_save_paypal_form', 'gdlr_save_paypal_form' );
if( !function_exists('gdlr_save_paypal_form') ){
	function gdlr_save_paypal_form(){
		$ret = array();
		if( false && !check_ajax_referer('gdlr-paypal-create-nonce', 'security', false) ){
			$ret['status'] = 'failed'; 
			$ret['message'] = __('Invalid Nonce', 'gdl_front_end');
		}else{
			$record = get_option('gdlr_paypal',array());
			$item_id = sizeof($record); 

			$record[$item_id]['name'] = $_POST['gdlr-name'];
			$record[$item_id]['last-name'] = $_POST['gdlr-last-name'];
			$record[$item_id]['email'] = $_POST['gdlr-email'];
			$record[$item_id]['phone'] = $_POST['gdlr-phone'];
			$record[$item_id]['address'] = $_POST['gdlr-address'];
			$record[$item_id]['addition'] = $_POST['gdlr-additional-note'];
			$record[$item_id]['post-id'] = $_POST['item_number'];
			$record[$item_id]['quantity'] = $_POST['quantity'];
			
			$ret['status'] = 'success'; 
			$ret['message'] = __('Redirecting to paypal', 'gdl_front_end');
			$ret['item_number'] = $item_id;
			
			update_option('gdlr_paypal',$record);
		}
		die(json_encode($ret));
	}
}

if( isset($_GET['paypal']) ){
	// STEP 1: read POST data
	 
	// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
	// Instead, read raw POST data from the input stream. 
	$raw_post_data = file_get_contents('php://input');
	$raw_post_array = explode('&', $raw_post_data);
	$myPost = array();
	foreach ($raw_post_array as $keyval) {
	  $keyval = explode ('=', $keyval);
	  if (count($keyval) == 2)
		 $myPost[$keyval[0]] = urldecode($keyval[1]);
	}
	// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
	$req = 'cmd=_notify-validate';
	if(function_exists('get_magic_quotes_gpc')) {
	   $get_magic_quotes_exists = true;
	} 
	foreach ($myPost as $key => $value) {        
	   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
			$value = urlencode(stripslashes($value)); 
	   } else {
			$value = urlencode($value);
	   }
	   $req .= "&$key=$value";
	}
	 
	 
	// Step 2: POST IPN data back to PayPal to validate
	$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
	 
	if( !($res = curl_exec($ch)) ) {
		curl_close($ch);
		exit;
	}
	// update_option('gdlr_paypal', '1:' . $ret . ':2:' . curl_error($ch));
	// update_option('gdlr_paypal', $_POST);
	curl_close($ch);
	
	// inspect IPN validation result and act accordingly
	if( empty($res) || strcmp ($res, "VERIFIED") == 0 ) {
		$recipient = get_option(THEME_SHORT_NAME.'_package_recipient_name', 'ORGANIZATION_NAME');
	
		$record = get_option('gdlr_paypal', array());
		$num = $_POST['item_number'];
		$record[$num]['status'] = $_POST['payment_status'];
		$record[$num]['txn_id'] = $_POST['txn_id'];
		$record[$num]['amount'] = $_POST['mc_gross'] . ' ' . $_POST['mc_currency'];
		
		$item_name = $_POST['item_name'];

		if( $_POST['payment_status'] == 'Completed' ){
			// update the post value
			$temp_option = get_post_meta($record[$num]['post-id'], 'post-option-available-num', true);
			if(!empty($temp_option) && $temp_option != 'zero' && intval($temp_option) != -1 ){
				$seat_num = empty($record[$num]['quantity'])? 1: intval($record[$num]['quantity']);
				$temp_option = intval($temp_option) - $seat_num;
				if($temp_option == 0){ $temp_option = 'zero'; }
				update_post_meta($record[$num]['post-id'], 'post-option-available-num', $temp_option);
			}

			// send the mail
			$headers  = 'From: ' . $recipient . ' <' . $_POST['receiver_email'] . '>' . "\r\n";
			$message  = __('Thank you very much for your purchasing for', 'gdl_front_end') . ' ' . $_POST['item_name'] . "\r\n";
			$message .= __('Below is details of your purchasing.', 'gdl_front_end') . ' ' . $_POST['item_name'] . "\r\n";
			$message .= __('Name of Recipient :', 'gdl_front_end') . ' ' . $_POST['receiver_email'] . "\r\n";
			$message .= __('Name :', 'gdl_front_end') . ' ' . $record[$num]['name'] . ' ' . $record[$num]['last-name'] . "\r\n";
			$message .= __('Date :', 'gdl_front_end') . ' ' . $_POST['payment_date'] . "\r\n";
			$message .= __('Quantity :', 'gdl_front_end') . ' ' . $record[$num]['quantity'] . "\r\n";
			$message .= __('Amount :', 'gdl_front_end') . ' ' . $record[$num]['amount'] . "\r\n";
			$message .= __('Transaction ID :', 'gdl_front_end') . ' ' . $record[$num]['txn_id'] . "\r\n";
			$message .= __('Regards,', 'gdl_front_end') . ' ' . $recipient;
	
			if( wp_mail($record[$num]['email'], __('Thank you for your purchasing', 'gdl_front_end'), $message, $headers ) ){
				$record[$num]['mail_status'] = 'complete';
			}else{
				$record[$num]['mail_status'] = 'failed';
			}
			
			$headers  = 'From: ' . $recipient . "\r\n";
			$message  = __('Package Name :', 'gdl_front_end') . ' ' . $_POST['item_name'] . "\r\n";
			$message .= __('Name :', 'gdl_front_end') . ' ' . $record[$num]['name'] . ' ' . $record[$num]['last-name'] . "\r\n";
			$message .= __('Email :', 'gdl_front_end') . ' ' . $record[$num]['email'] . "\r\n";
			$message .= __('Phone :', 'gdl_front_end') . ' ' . $record[$num]['phone'] . "\r\n";
			$message .= __('Address :', 'gdl_front_end') . ' ' . $record[$num]['address'] . "\r\n";
			$message .= __('Additional Message :', 'gdl_front_end') . ' ' . $record[$num]['addition'] . "\r\n";
			$message .= __('Date :', 'gdl_front_end') . ' ' . $_POST['payment_date'] . "\r\n";
			$message .= __('Quantity :', 'gdl_front_end') . ' ' . $record[$num]['quantity'] . "\r\n";
			$message .= __('Amount :', 'gdl_front_end') . ' ' . $record[$num]['amount'] . "\r\n";
			$message .= __('Transaction ID :', 'gdl_front_end') . ' ' . $record[$num]['txn_id'];

			//$message .= "\r\n" . 'Package Price ' . get_post_meta($record[$num]['post-id'], 'package-price',true);
			//$message .= "\r\n" . 'Package Price Discount (If Any) ' . get_post_meta($record[$num]['post-id'], 'package-last-minute-widget-text', true);
			
			if( wp_mail($_POST['receiver_email'], __('You received new payment', 'gdl_front_end'), $message, $headers ) ){
				$record[$num]['notify_status'] = 'complete';
			}else{
				$record[$num]['notify_status'] = 'failed';
			}			
		}
		update_option('gdlr_paypal', $record);
	}else if( strcmp ($res, "INVALID") == 0 ){
		echo "The response from IPN was: " . $res;
	}
}else if( isset($_GET['paypal_print']) && is_user_logged_in() ){
	print_r(get_option('gdlr_paypal', array()));
	die();
}else if( isset($_GET['paypal_clear']) && is_user_logged_in() ){
	delete_option('gdlr_paypal');
	echo 'Option Deleted';
	die();
}
?>