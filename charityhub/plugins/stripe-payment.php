<?php

	add_action( 'wp_enqueue_scripts', 'gdlr_include_stripe_payment_script' );
	if( !function_exists('gdlr_include_stripe_payment_script') ){
		function gdlr_include_stripe_payment_script(){
			if( !empty($_GET['payment-method']) && $_GET['payment-method'] == 'stripe' && isset($_GET['invoice']) ){
				wp_enqueue_script('stripe', 'https://js.stripe.com/v2/');
			}
		}
	}
	
	add_filter( 'template_include', 'gdlr_stripe_stripe_template_include' );
	if( !function_exists('gdlr_stripe_stripe_template_include') ){
		function gdlr_stripe_stripe_template_include($template){
			if( !empty($_GET['payment-method']) && $_GET['payment-method'] == 'stripe' && isset($_GET['invoice']) ){
				$template = get_template_directory() . '/single-stripe.php';
			}
			return $template;
		}
	}

	add_action( 'wp_ajax_gdlr_stripe_payment', 'gdlr_stripe_payment' );
	add_action( 'wp_ajax_nopriv_gdlr_stripe_payment', 'gdlr_stripe_payment' );
	if( !function_exists('gdlr_stripe_payment') ){
		function gdlr_stripe_payment(){
			global $theme_option;
			$recipient = empty($theme_option['cause-recipient-name'])? 'ORGANIZATION_NAME': $theme_option['cause-recipient-name'];
			
			$donator = get_option('gdlr_paypal', array());
			if( isset($_POST['invoice']) && !empty($donator[$_POST['invoice']]) ){
				$our_donator = $donator[$_POST['invoice']];
				
				if( !empty($our_donator['post-id']) ){
					$cause_option = json_decode(gdlr_decode_preventslashes(get_post_meta($our_donator['post-id'], 'post-option', true)), true);
					if( !empty($cause_option['donation-form']) ){
						$shortcode = trim($cause_option['donation-form']);
					}
				}
				if( empty($shortcode) ){
					$shortcode = trim($theme_option['cause-donation-form']);
				}
				$atts = shortcode_parse_atts($shortcode);
				
				if( !empty($atts['stripe_receiver_email']) && !empty($atts['stripe_secret_key']) && 
					!empty($atts['stripe_publishable_key']) && !empty($atts['stripe_currency_code']) ){
					$ret = array();
					Stripe::setApiKey($atts['stripe_secret_key']);

					try{
						$charge = Stripe_Charge::create(array(
						  "amount" => (floatval($our_donator['amount']) * 100),
						  "currency" => $atts['stripe_currency_code'],
						  "card" => $_POST['token'],
						  "description" => $our_donator['email']
						));		
						
						// update the post value
						$temp_option = json_decode(get_post_meta($our_donator['post-id'], 'post-option', true), true);
						if( !empty($temp_option) ){
							$temp_goal = floatval($temp_option['goal-of-donation']);
							$temp_current = floatval($temp_option['current-funding']) + floatval($our_donator['amount']);

							$temp_option['current-funding'] = $temp_current;
							$temp_option = json_encode($temp_option);
							update_post_meta($our_donator['post-id'], 'post-option', $temp_option);
							
							if(!empty($temp_current)){
								update_post_meta($our_donator['post-id'], 'gdlr-current-funding', $temp_current);
							}
							
							if(!empty($temp_goal)){
								$temp_percent = intval(($temp_current / $temp_goal)*100); 
								update_post_meta($our_donator['post-id'], 'gdlr-donation-percent', $temp_percent);
							}				
						}
						
					
						// send the mail
						$headers  = 'From: ' . $recipient . "\r\n";
						$message  = __('Thank you very much for your donation to', 'gdlr_translate') . ' ' . get_the_title($our_donator['post-id']) . "\r\n";
						$message .= __('Below are the details of your donation.', 'gdlr_translate') . "\r\n";
						$message .= __('Name of Recipient :', 'gdlr_translate') . ' ' . $atts['stripe_receiver_email'] . "\r\n";
						$message .= __('Name :', 'gdlr_translate') . ' ' . $our_donator['name'] . ' ' . $our_donator['last-name'] . "\r\n";
						$message .= __('Amount :', 'gdlr_translate') . ' ' . $our_donator['amount'] . "\r\n";
						$message .= __('Regards,', 'gdlr_translate') . ' ' . $recipient;
				
						if( empty($donator[$_POST['invoice']]['mail_status']) || $donator[$_POST['invoice']]['mail_status'] == 'failed' ){
							if( wp_mail($donator[$_POST['invoice']]['email'], __('Thank you for your donation', 'gdlr_translate'), $message, $headers ) ){
								$donator[$_POST['invoice']]['mail_status'] = 'complete';
							}else{
								$donator[$_POST['invoice']]['mail_status'] = 'failed';
							}
						}
						
						$headers  = 'From: ' . $recipient . "\r\n";
						$message  = __('Cause Name :', 'gdlr_translate') . ' ' . get_the_title($our_donator['post-id']) . "\r\n";
						$message .= __('Name :', 'gdlr_translate') . ' ' . $our_donator['name'] . ' ' . $our_donator['last-name'] . "\r\n";
						$message .= __('Email :', 'gdlr_translate') . ' ' . $our_donator['email'] . "\r\n";
						$message .= __('Phone :', 'gdlr_translate') . ' ' . $our_donator['phone'] . "\r\n";
						$message .= __('Address :', 'gdlr_translate') . ' ' .$our_donator['address'] . "\r\n";
						$message .= __('Additional Message :', 'gdlr_translate') . ' ' . $our_donator['addition'] . "\r\n";
						$message .= __('Amount :', 'gdlr_translate') . ' ' . $our_donator['amount'] . "\r\n";
						
						if( empty($donator[$_POST['invoice']]['notify_status']) || $donator[$_POST['invoice']]['notify_status'] == 'failed' ){
							if( wp_mail($atts['stripe_receiver_email'], __('You received a new donation', 'gdlr_translate'), $message, $headers ) ){
								$donator[$_POST['invoice']]['notify_status'] = 'complete';
							}else{
								$donator[$_POST['invoice']]['notify_status'] = 'failed';
							}			
						}
						
						$ret['status'] = 'success';
						$ret['message'] = __('Thank you for your donation.', 'stripe');
					}catch(Stripe_CardError $e) {
						$ret['status'] = 'failed';
						$ret['message'] = $e->message;
					}
				}else{
					$ret['status'] = 'failed';
					$ret['message'] = __('Shortcode variable incorrect, please check the spacing then try again.', 'stripe');	
				}
			}else{
				$ret['status'] = 'failed';
				$ret['message'] = __('Failed to proceed, please try again.', 'stripe');	
			}
			
			die(json_encode($ret));
		}
	}
?>