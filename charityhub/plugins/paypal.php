<?php

if( !function_exists('gdlr_paypal_form') ){
	function gdlr_paypal_form($atts){
		extract( shortcode_atts(array('user'=>'', 
			'action'=>'https://www.paypal.com/cgi-bin/webscr',
			'val_1'=>'10', 'val_2'=>'20', 'val_3'=>'30', 
			'currency_format'=>'$NUMBER', 'currency_code'=>'USD',
			'stripe_receiver_email'=> '',
			'stripe_secret_key'=> '', 'stripe_publishable_key'=>'', 'stripe_currency_code'=>''), $atts) );
			
			$payment_method = array();
			if( !empty($user) ){
				$payment_method[] = 'paypal';
			}
			if( !empty($stripe_receiver_email) && !empty($stripe_secret_key) && !empty($stripe_publishable_key) && !empty($stripe_currency_code) ){
				$payment_method[] = 'stripe';
			}
			
			ob_start();
?>
<div class="gdlr-paypal-form-wrapper">
	<h3 class="gdlr-paypal-form-head"><?php echo __('You are donating to :','gdlr_translate') . ' <span>' . get_the_title() . '</span>'; ?></h3>
	<form class="gdlr-paypal-form" action="<?php echo $action; ?>" method="post" data-ajax="<?php echo AJAX_URL; ?>" >
		<div class="gdlr-paypal-amount-wrapper">
			<span class="gdlr-head"><?php echo __('How much would you like to donate?', 'gdlr_translate'); ?></span>
			<a class="gdlr-amount-button active" data-val="<?php echo $val_1; ?>"><?php echo gdlr_cause_money_format($val_1, 0, $currency_format); ?></a>
			<a class="gdlr-amount-button" data-val="<?php echo $val_2; ?>"><?php echo gdlr_cause_money_format($val_2, 0, $currency_format); ?></a>
			<a class="gdlr-amount-button" data-val="<?php echo $val_3; ?>"><?php echo gdlr_cause_money_format($val_3, 0, $currency_format); ?></a>
			<input type="text" class="custom-amount" data-default="<?php echo __('Or Your Amount', 'gdlr_translate') . '(' . $currency_code . ')'; ?>" />
			<div class="clear"></div>
			
			<!-- recurring-1 -->
			<?php if( in_array('paypal', $payment_method) ){ ?>
			<div class="gdlr-recurring-payment-wrapper">
				<span class="gdlr-head"><?php echo __('Would you like to make regular donations?', 'gdlr_translate'); ?></span>
				<span class="gdlr-subhead"><?php echo __('I would like to make ', 'gdlr_translate'); ?></span>
				<select name="t3" class="gdlr-recurring-option" >
					<option value="0"><?php _e('a one time', 'gdlr_translate'); ?></option>
					<option value="W"><?php _e('weekly', 'gdlr_translate'); ?></option>
					<option value="M"><?php _e('monthly', 'gdlr_translate'); ?></option>
					<option value="Y"><?php _e('yearly', 'gdlr_translate'); ?></option>
				</select>
				<span class="gdlr-subhead" ><?php echo __(' donation(s)', 'gdlr_translate'); ?></span>
				<input type="hidden" name="p3" value="1" />
				<div class="gdlr-recurring-time-wrapper">
					<span class="gdlr-subhead" ><?php echo __('How many times would you like this to recur? (including this payment)*', 'gdlr_translate'); ?></span>
					<select name="srt" class="gdlr-recurring-option">
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
				</div>
			</div>
			<?php } ?>
			<!-- recurring-2 -->	
			
		</div>
		<div class="gdlr-paypal-fields">
			<div class="six columns"><span class="gdlr-head"><?php echo __('Name *', 'gdlr_translate'); ?></span>
				<input class="gdlr-require" type="text" name="gdlr-name">
			</div>
			<div class="six columns"><span class="gdlr-head"><?php echo __('Last Name *', 'gdlr_translate'); ?></span>
				<input class="gdlr-require" type="text" name="gdlr-last-name">
			</div>
			<div class="clear"></div>
			<div class="six columns"><span class="gdlr-head"><?php echo __('Email *', 'gdlr_translate'); ?></span>
				<input class="gdlr-require gdlr-email" type="text" name="gdlr-email">
			</div>
			<div class="six columns"><span class="gdlr-head"><?php echo __('Phone', 'gdlr_translate'); ?></span>
				<input type="text" name="gdlr-phone">
			</div>		
			<div class="clear"></div>
			<div class="six columns"><span class="gdlr-head"><?php echo __('Address', 'gdlr_translate'); ?></span>
				<textarea name="gdlr-address"></textarea>
			</div>
			<div class="six columns"><span class="gdlr-head"><?php echo __('Additional Note', 'gdlr_translate'); ?></span>
				<textarea name="gdlr-additional-note"></textarea>
			</div>		
			<div class="clear"></div>
		</div>
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="<?php echo $user; ?>">
		<input type="hidden" name="item_name" value="<?php echo get_the_title(); ?>">
		<input type="hidden" name="item_number" value="<?php echo get_the_ID(); ?>">
		<input type="hidden" name="amount" value="<?php echo $val_1; ?>">    
		<input type="hidden" name="return" value="<?php echo get_permalink(); ?>">
		<input type="hidden" name="notify_url" value="<?php echo esc_url(add_query_arg(array('paypal'=>''), home_url('/'))); ?>">
		
		<!-- recurring-1 -->
		<?php if( in_array('paypal', $payment_method) ){ ?>
		<input type="hidden" name="a3" value="<?php echo $val_1; ?>">
		<input type="hidden" name="amount" value="<?php echo $val_1; ?>">
		<input type="hidden" name="src" value="1">
		<input type="hidden" name="sra" value="1">
		<?php } ?>
		<!-- recurring-2 -->

		<?php 
			if( sizeOf($payment_method) > 1 ){
				echo '<div class="gdlr-payment-method" >';
				foreach($payment_method as $key => $method){
					echo '<img ' . ($key==0? 'class="gdlr-active"': '') . ' src="' . get_template_directory_uri() . "/images/{$method}.png\" alt=\"{$method}\" />";
				}
				echo '<input type="hidden" name="payment-method" value="' . $payment_method[0] . '" />';
				echo '</div>';
			}else{
				echo '<input type="hidden" name="payment-method" value="' . $payment_method[0] . '" />';
			}
		?>
		
		<input type="hidden" name="no_shipping" value="0">
		<input type="hidden" name="no_note" value="1">
		<input type="hidden" name="currency_code" value="<?php echo $currency_code; ?>">
		<input type="hidden" name="lc" value="AU">
		<input type="hidden" name="bn" value="PP-BuyNowBF">
		<input type="hidden" name="action" value="save_paypal_form">
		<input type="hidden" name="security" value="<?php echo wp_create_nonce('gdlr-paypal-create-nonce'); ?>">
		<div class="gdlr-notice email-invalid" ><?php echo __('Invalid Email Address ', 'gdlr_translate'); ?></div>
		<div class="gdlr-notice require-field" ><?php echo __('Please fill all required fields', 'gdlr_translate'); ?></div>
		<div class="gdlr-notice alert-message" ></div>
		<div class="gdlr-paypal-loader" ></div>
		<input type="submit" value="donate" >
	</form>
</div>

<!-- recurring-1 -->
<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.gdlr-payment-method img').click(function(){
			$(this).addClass('gdlr-active').siblings().removeClass('gdlr-active');
			$(this).siblings('input[name="payment-method"]').val($(this).attr('alt'));
			
			if( $(this).attr('alt') == 'paypal' ){
				$(this).closest('.gdlr-payment-method').siblings('.gdlr-paypal-amount-wrapper').children('.gdlr-recurring-payment-wrapper').slideDown(200);
			}else{
				
				$(this).closest('.gdlr-payment-method').siblings('.gdlr-paypal-amount-wrapper').children('.gdlr-recurring-payment-wrapper').slideUp(200);
			}
		});
		
		$('select[name="t3"]').change(function(){
			$selVal = $(this).val();

			if( $selVal == 0 ){
				$('input[name="cmd"]').val('_xclick');
				$('input[name="bn"]').val('PP-BuyNowBF');
				$('.gdlr-recurring-time-wrapper').slideUp();
			} else {
				$html = '';
				$('select[name="srt"]').empty();
				$year_array = new Array();
				if( $selVal == 'Y' ){
					$year_array[2] = 2;
					$year_array[3] = 3;
					$year_array[4] = 4;
					$year_array[5] = 5;
				} else {
					$year_array[2] = 2;
					$year_array[3] = 3;
					$year_array[4] = 4;
					$year_array[5] = 5;
					$year_array[6] = 6;
					$year_array[7] = 7;
					$year_array[8] = 8;
					$year_array[9] = 9;
					$year_array[10] = 10;
					$year_array[11] = 11;
					$year_array[12] = 12;
				}
				$.each( $year_array, function( index, value ){
					if( index != 1 && index != 0 ){
						$html += '<option value="'+index+'">'+value+'</option>';  	
					}
				});

				$('select[name="srt"]').append($html);
				$('input[name="cmd"]').val('_xclick-subscriptions');
				$('input[name="bn"]').val('PP-SubscriptionsBF:btn_subscribeCC_LG.gif:NonHosted');				
				$('.gdlr-recurring-time-wrapper').slideDown();
			}

		});

	});
</script>
<!-- recurring-2 -->

<?php	
		$ret = ob_get_contents();
		ob_end_clean();
		
		return $ret;
	}	
}

// ajax to save form data
add_action( 'wp_ajax_save_paypal_form', 'gdlr_save_paypal_form' );
add_action( 'wp_ajax_nopriv_save_paypal_form', 'gdlr_save_paypal_form' );
if( !function_exists('gdlr_save_paypal_form') ){
	function gdlr_save_paypal_form(){
		$ret = array();
		if( !check_ajax_referer('gdlr-paypal-create-nonce', 'security', false) ){
			$ret['status'] = 'failed'; 
			$ret['message'] = __('Invalid Nonce', 'gdlr_translate');
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
			$record[$item_id]['payment_method'] = $_POST['payment-method'];
			$record[$item_id]['amount'] = $_POST['amount'];
			
			$ret['status'] = 'success'; 
			if( $_POST['payment-method'] == 'stripe' ){
				$ret['redirect'] = add_query_arg(array('payment-method'=>'stripe', 'invoice'=>$item_id), home_url('/'));
				$ret['message'] = __('Redirecting to stripe', 'gdlr_translate');
			}else{
				$ret['message'] = __('Redirecting to paypal', 'gdlr_translate');
			}
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
	// if (strpos($res,'VERIFIED') !== false) {
	if( empty($res) || strcmp ($res, "VERIFIED") == 0 ) {
		global $theme_option;
		$recipient = empty($theme_option['cause-recipient-name'])? 'ORGANIZATION_NAME': $theme_option['cause-recipient-name'];
	
		$record = get_option('gdlr_paypal', array());
		$num = $_POST['item_number'];
		$record[$num]['status'] = $_POST['payment_status'];
		$record[$num]['txn_id'] = $_POST['txn_id'];
		$record[$num]['amount'] = $_POST['mc_gross'];
		
		$item_name = $_POST['item_name'];

		// if( $_POST['payment_status'] == 'Completed' ){
			// update the post value
			$temp_option = json_decode(get_post_meta($record[$num]['post-id'], 'post-option', true), true);
			if( !empty($temp_option) ){
				$temp_goal = floatval($temp_option['goal-of-donation']);
				$temp_current = floatval($temp_option['current-funding']) + floatval($record[$num]['amount']);

				$temp_option['current-funding'] = $temp_current;
				$temp_option = json_encode($temp_option);
				update_post_meta($record[$num]['post-id'], 'post-option', $temp_option);
				
				if(!empty($temp_current)){
					update_post_meta($record[$num]['post-id'], 'gdlr-current-funding', $temp_current);
				}
				
				if(!empty($temp_goal)){
					$temp_percent = intval(($temp_current / $temp_goal)*100); 
					update_post_meta($record[$num]['post-id'], 'gdlr-donation-percent', $temp_percent);
				}				
			}
			
		
			// send the mail
			$headers  = 'From: ' . $recipient . ' <' . $_POST['receiver_email'] . '>' . "\r\n";
			$message  = __('Thank you very much for your donation to', 'gdlr_translate') . ' ' . $_POST['item_name'] . "\r\n";
			$message .= __('Below are the details of your donation.', 'gdlr_translate') . ' ' . $_POST['item_name'] . "\r\n";
			$message .= __('Name of Recipient :', 'gdlr_translate') . ' ' . $_POST['receiver_email'] . "\r\n";
			$message .= __('Name :', 'gdlr_translate') . ' ' . $record[$num]['name'] . ' ' . $record[$num]['last-name'] . "\r\n";
			$message .= __('Date :', 'gdlr_translate') . ' ' . $_POST['payment_date'] . "\r\n";
			$message .= __('Amount :', 'gdlr_translate') . ' ' . $record[$num]['amount'] . "\r\n";
			$message .= __('Transaction ID :', 'gdlr_translate') . ' ' . $record[$num]['txn_id'] . "\r\n";
			$message .= __('Regards,', 'gdlr_translate') . ' ' . $recipient;
	
			if( empty($record[$num]['mail_status']) || $record[$num]['mail_status'] == 'failed' ){
				if( wp_mail($record[$num]['email'], __('Thank you for your donation', 'gdlr_translate'), $message, $headers ) ){
					$record[$num]['mail_status'] = 'complete';
				}else{
					$record[$num]['mail_status'] = 'failed';
				}
			}
			
			$headers  = 'From: ' . $recipient . "\r\n";
			$message  = __('Cause Name :', 'gdlr_translate') . ' ' . $_POST['item_name'] . "\r\n";
			$message .= __('Name :', 'gdlr_translate') . ' ' . $record[$num]['name'] . ' ' . $record[$num]['last-name'] . "\r\n";
			$message .= __('Email :', 'gdlr_translate') . ' ' . $record[$num]['email'] . "\r\n";
			$message .= __('Phone :', 'gdlr_translate') . ' ' . $record[$num]['phone'] . "\r\n";
			$message .= __('Address :', 'gdlr_translate') . ' ' . $record[$num]['address'] . "\r\n";
			$message .= __('Additional Message :', 'gdlr_translate') . ' ' . $record[$num]['addition'] . "\r\n";
			$message .= __('Date :', 'gdlr_translate') . ' ' . $_POST['payment_date'] . "\r\n";
			$message .= __('Amount :', 'gdlr_translate') . ' ' . $record[$num]['amount'] . "\r\n";
			$message .= __('Transaction ID :', 'gdlr_translate') . ' ' . $record[$num]['txn_id'];
			
			if( empty($record[$num]['notify_status']) || $record[$num]['notify_status'] == 'failed' ){
				if( wp_mail($_POST['receiver_email'], __('You received a new donation', 'gdlr_translate'), $message, $headers ) ){
					$record[$num]['notify_status'] = 'complete';
				}else{
					$record[$num]['notify_status'] = 'failed';
				}			
			}
		// }
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