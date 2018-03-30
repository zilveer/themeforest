<?php

// url/?ait-payment&payment-type=paypal&payment-id=0

// were about to submit a transaction
if(isset($_REQUEST['ait-payment'])){
	$themeOptions = aitOptions()->getOptionsByType('theme');
	$currency = $themeOptions['payments']['currency'];

	// prepared for future extending of payments classes
	if(isset($_REQUEST['payment-type']) && !empty($_REQUEST['payment-type'])){
		// payment-type -> string containing type of payment e.g. "paypal"
		switch($_REQUEST['payment-type']){
			case "paypal":
				// start a transaction request only when we have an id of the transaction
				if(isset($_REQUEST['payment-price']) && $_REQUEST['payment-price'] !== ""){
					$paypal = AitPaypal::getInstance();
					$data = array(
						'user' => $_REQUEST['payment-data-user'],
						'package' => $_REQUEST['payment-data-package'],
						'operation' => $_REQUEST['payment-data-operation'],
					);

					$packages = new ThemePackages();
					$package = $packages->getPackageBySlug($_REQUEST['payment-data-package']);

					$paypal->requestPayment($data, $package->getName(), $package->getDesc(), floatval($_REQUEST['payment-price']), 0, $currency);
				}
			break;
			case "paypalRecurring":
				// start a transaction request only when we have an id of the transaction
				if(isset($_REQUEST['payment-price']) && $_REQUEST['payment-price'] !== ""){
					$paypal = AitPaypalSubscriptions::getInstance();
					$data = array(
						'user' => $_REQUEST['payment-data-user'],
						'package' => $_REQUEST['payment-data-package'],
						'operation' => $_REQUEST['payment-data-operation'],
					);

					$packages = new ThemePackages();
					$package = $packages->getPackageBySlug($_REQUEST['payment-data-package']);
					$options = $package->getOptions();

					$paypal->createAgreement($data, array(
						'name' => $package->getName(),
						'description' => $package->getDesc(),
						'interval' => $options['expirationLimit'],
						'amount' => floatval($_REQUEST['payment-price']),
						'currency' => $currency,
					));
				}
			break;
			case "stripe":
				// start a transaction request only when we have an id of the transaction
				if(isset($_REQUEST['payment-price']) && $_REQUEST['payment-price'] !== ""){
					$stripe = AitStripe::getInstance();
					$data = array(
						'user' => $_REQUEST['payment-data-user'],
						'package' => $_REQUEST['payment-data-package'],
						'operation' => $_REQUEST['payment-data-operation'],
					);

					$packages = new ThemePackages();
					$package = $packages->getPackageBySlug($_REQUEST['payment-data-package']);

					$stripe->requestPayment($data, $package->getName(), $package->getDesc(), floatval($_REQUEST['payment-price']), $currency);
				}
			break;
			default:
				// bank transfer
			break;
		}

	}

}

if(class_exists('AitPaypal')){
	add_action('ait-paypal-payment-completed','aitPaypalPaymentSuccess');
	function aitPaypalPaymentSuccess($payment) {
		$data = $payment->data;
		$user = new Wp_User($data['user']);
		if($data['operation'] === 'register'){
			$user->set_role( $data['package'] );

			$redirect = home_url('/').'?ait-notification=user-registration-success';
			wp_safe_redirect( $redirect );
			exit();
		}
		if($data['operation'] === 'renew'){
			aitSetPackageUserRenewed($data['user'], $data['package']);
		}
		if($data['operation'] === 'upgrade'){
			aitSetPackageUserRenewed($data['user'], $data['package']);
		}
	}
}

if(class_exists('AitPaypalSubscriptions')){
	add_action('ait-paypal-subscriptions-payment-completed','aitPaypalPaymentSubscriptionsCompleted');
	function aitPaypalPaymentSubscriptionsCompleted($payment) {
		$data = $payment->data;
		$user = new Wp_User($data['user']);
		if($data['operation'] === 'register'){
			$user->set_role( $data['package'] );

			$redirect = home_url('/').'?ait-notification=user-registration-success';
			wp_safe_redirect( $redirect );
			exit();
		}
		if($data['operation'] === 'renew'){
			aitSetPackageUserRenewed($data['user'], $data['package']);
		}
		if($data['operation'] === 'upgrade'){
			aitSetPackageUserRenewed($data['user'], $data['package']);
		}
	}
}

if(class_exists('AitStripe')){
	add_action('ait-stripe-payment-success', 'aitStripePaymentSuccess');
	function aitStripePaymentSuccess($payment){
		$data = $payment->data;
		$user = new Wp_User($data['user']);
		if($data['operation'] === 'register'){
			$user->set_role( $data['package'] );

			$redirect = home_url('/').'?ait-notification=user-registration-success';
			wp_safe_redirect( $redirect );
			exit();
		}
		if($data['operation'] === 'renew'){
			aitSetPackageUserRenewed($data['user'], $data['package']);
		}
		if($data['operation'] === 'upgrade'){
			aitSetPackageUserRenewed($data['user'], $data['package']);
		}	
	}
}