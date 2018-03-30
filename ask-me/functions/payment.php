<?php require_once get_template_directory() . '/includes/paypal.class.php';
$p = new paypal_class;
$paypal_sandbox = vpanel_options('paypal_sandbox');
if ($paypal_sandbox == 1) {
	$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
}else {
	$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
}

$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
global $vpanel_emails,$vpanel_emails_2,$vpanel_emails_3;

switch ((isset($_GET['action'])?$_GET['action']:"")) {
	case 'process':
		if (isset($_POST["go"]) && $_POST["go"] == "paypal") {
			$CatDescription = (isset($_REQUEST['CatDescription']) && $_REQUEST['CatDescription'] != ""?esc_attr($_REQUEST['CatDescription']):"");
			$payment        = (isset($_REQUEST['payment']) && $_REQUEST['payment'] != ""?esc_attr($_REQUEST['payment']):"");
			$key            = (isset($_REQUEST['key']) && $_REQUEST['key'] != ""?esc_attr($_REQUEST['key']):"");
			$quantity       = (isset($_REQUEST['quantity']) && $_REQUEST['quantity'] != ""?esc_attr($_REQUEST['quantity']):"");
			$coupon         = (isset($_REQUEST['coupon']) && $_REQUEST['coupon'] != ""?esc_attr($_REQUEST['coupon']):"");
			$currency_code  = (isset($_REQUEST['currency_code']) && $_REQUEST['currency_code'] != ""?esc_attr($_REQUEST['currency_code']):"");
			
			echo '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.sprintf(__("Go to PayPal now","vbegy").'</span><br>'.__("Please wait will go to the PayPal now to pay a new payment.","vbegy"),esc_url(add_query_arg(array("get_activate" => "do"),esc_url(home_url('/'))))).'</p></div>';
			
			$p->add_field('business', vpanel_options('paypal_email'));
			$p->add_field('return', $this_script.'?action=success');
			$p->add_field('cancel_return', $this_script.'?action=cancel');
			$p->add_field('notify_url', $this_script.'?action=ipn');
			$p->add_field('item_name', $CatDescription);
			$p->add_field('amount', $payment);
			$p->add_field('key', $key);
			$p->add_field('quantity', $quantity);
			$p->add_field('currency_code', $currency_code);
			
			$p->submit_paypal_post();
			//$p->dump_fields();
		}else {
			wp_safe_redirect(esc_url(home_url('/')));
		}
		get_footer();
		die();
	break;
	case 'success':
		$item_no          = esc_attr($_REQUEST['item_number']);
		$item_transaction = esc_attr($_REQUEST['txn_id']);
		$item_price       = esc_attr($_REQUEST['mc_gross']);
		$item_currency    = esc_attr($_REQUEST['mc_currency']);
		
		$user_id = get_current_user_id();
		$last_payments = get_user_meta($user_id,$user_id."_last_payments",true);
		
		if (isset($item_transaction)) {
			if (isset($last_payments) && $last_payments == $item_transaction) {
				wp_safe_redirect(esc_url(home_url('/')));
				die();
			}
			
			/* Number of my payments */
			$_payments = get_user_meta($user_id,$user_id."_payments",true);
			if($_payments == "" || $_payments == 0) {
				$_payments = 0;
			}
			$_payments++;
			update_user_meta($user_id,$user_id."_payments",$_payments);
			
			add_user_meta($user_id,$user_id."_payments_".$_payments,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),$item_no,$item_price,$item_currency,$item_transaction,esc_attr($_REQUEST['payer_email']),esc_attr($_REQUEST['first_name']),esc_attr($_REQUEST['last_name']),$user_id));
			
			/* Number allow to ask question */
			$_allow_to_ask = get_user_meta($user_id,$user_id."_allow_to_ask",true);
			if($_allow_to_ask == "" || $_allow_to_ask == 0) {
				$_allow_to_ask = 0;
			}
			$_allow_to_ask++;
			update_user_meta($user_id,$user_id."_allow_to_ask",$_allow_to_ask);
			
			/* Money i'm paid */
			$_all_my_payment = get_user_meta($user_id,$user_id."_all_my_payment_".$item_currency,true);
			if($_all_my_payment == "" || $_all_my_payment == 0) {
				$_all_my_payment = 0;
			}
			update_user_meta($user_id,$user_id."_all_my_payment_".$item_currency,$_all_my_payment+$item_price);
			
			update_user_meta($user_id,$user_id."_last_payments",$item_transaction);
			
			/* All the payments */
			$payments_option = get_option("payments_option");
			if($payments_option == "" || $payments_option == 0) {
				$payments_option = 0;
			}
			$payments_option++;
			update_option("payments_option",$payments_option);
			
			add_option("payments_".$payments_option,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),$item_no,$item_price,$item_currency,$item_transaction,esc_attr($_REQUEST['payer_email']),esc_attr($_REQUEST['first_name']),esc_attr($_REQUEST['last_name']),$user_id));
			
			/* All money */
			$all_money = get_option("all_money_".$item_currency);
			if($all_money == "" || $all_money == 0) {
				$all_money = 0;
			}
			update_option("all_money_".$item_currency,$all_money+$item_price);
			
			/* The currency */
			$the_currency = get_option("the_currency");
			if((isset($the_currency) || !isset($the_currency)) && !is_array($the_currency)) {
				add_option("the_currency",array("USD"));
			}
			if (!in_array($item_currency,$the_currency)) {
				array_push($the_currency,$item_currency);
			}
			update_option("the_currency",$the_currency);
			
			echo '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Successfully payment","vbegy").'</span><br>'.__("Thank you for your payment you now can make a new question.","vbegy").'</p></div>';
			$body =  "<p>An instant payment notification was successfully recieved</p>";
			$body .= "<p>With ".$item_price." ".$item_currency."</p>";
			$body .= "<p>From ".esc_attr($_REQUEST['payer_email'])." ".esc_attr($_REQUEST['first_name'])." - ".esc_attr($_REQUEST['last_name'])." on ".date('m/d/Y')." at ".date('g:i A')."</p>";
			$body .= "<p>The item transaction id ".$item_transaction."</p>";
			
			$last_message_email = $vpanel_emails.'<img src="'.vpanel_options("logo_email_template").'" alt="">'.$vpanel_emails_2.$body.$vpanel_emails_3;sendEmail(esc_html($_REQUEST['payer_email']),esc_html($_REQUEST['first_name']),esc_html(get_bloginfo("admin_email")),get_bloginfo('name'),__('Instant Payment Notification - Received Payment','vbegy'),$last_message_email);
			$_SESSION['vbegy_session_p'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Successfully payment","vbegy").'</span><br>'.__("Thank you for your payment you now can make a new question, Your transaction id ".$item_transaction.", Please copy it.","vbegy").'</p></div>';
			wp_safe_redirect(esc_url(get_page_link(vpanel_options('add_question'))));
			die();
		}
		else {
			echo '<div class="alert-message error"><i class="icon-ok"></i><p><span>'.__("Payment Failed","vbegy").'</span><br>'.__("The payment was failed!","vbegy").'</p></div>';
		}
	break;
	case 'cancel':
		echo '<div class="alert-message error"><i class="icon-ok"></i><p><span>'.__("Payment Canceled","vbegy").'</span><br>'.__("The payment was canceled!","vbegy").'</p></div>';
	break;
	case 'ipn':
		if ($p->validate_ipn()) { 
			$dated = date("D, d M Y H:i:s", time()); 
			
			$subject  = 'Instant Payment Notification - Received Payment';
			$body     =  "An instant payment notification was successfully recieved\n";
			$body    .= "from ".esc_attr($p->ipn_data['payer_email'])." on ".date('m/d/Y');
			$body    .= " at ".date('g:i A')."\n\nDetails:\n";
			$headers  = "";
			$headers .= "From: Paypal \r\n";
			$headers .= "Date: $dated \r\n";
			
			$PaymentStatus =  esc_attr($p->ipn_data['payment_status']);
			$Email         =  esc_attr($p->ipn_data['payer_email']);
			$id            =  esc_attr($p->ipn_data['item_number']);
			
			if($PaymentStatus == 'Completed' or $PaymentStatus == 'Pending') {
				$PaymentStatus = '2';
			}else {
				$PaymentStatus = '1';
			}
			mail(get_bloginfo("admin_email"), $subject, $body, $headers);
		}
	break;
}