<?php
require_once CH_HOME . '/AuthorizeNet.php'; // Include the SDK you downloaded in Step 2

// Authorize.net payment gateway configuration
$auhorize_api_login_id     = get_option('ch_api_login_id') ? get_option('ch_api_login_id') : '';
$authorize_transaction_key = get_option('ch_transaction_key') ? get_option('ch_transaction_key') : '';

$amount           = $_POST['amount'];
$item_description = $_POST['item_description'];
$custom           = $_POST['custom'];
$return           = $_POST['return'];

$fp_timestamp = time();
$fp_sequence  = "123" . time(); // Enter an invoice or other unique number.
$fingerprint  = AuthorizeNetSIM_Form::getFingerprint($auhorize_api_login_id,
$authorize_transaction_key, $amount, $fp_sequence, $fp_timestamp);
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#authorize_form").submit();
	});
</script>
<form action="https://secure.authorize.net/gateway/transact.dll" id="authorize_form" method="post" style="display: none;">
	<input type="hidden" name="x_login" value="<?php echo $auhorize_api_login_id; ?>">
	<input type="hidden" name="x_fp_hash" value="<?php echo $fingerprint?>">
	<input type="hidden" name="x_amount" value="<?php echo $amount?>">
	<input type="hidden" name="x_fp_timestamp" value="<?php echo $fp_timestamp?>">
	<input type="hidden" name="x_fp_sequence" value="<?php echo $fp_sequence?>">
	<input type="hidden" name="x_version" value="3.1">
	<input type="hidden" name="x_show_form" value="payment_form">
	<input type="hidden" name="x_test_request" value="false">
	<input type="hidden" name="x_method" value="cc">
	<input type="hidden" name="x_type" value="AUTH_CAPTURE">
	<input type="hidden" name="x_relay_response" value="true">
	<input type="hidden" name="x_relay_url" value="<?php echo home_url(); ?>?x_response_code=1&custom=<?php echo $custom; ?>&amount=<?php echo $amount; ?>&return=<?php echo urlencode($return); ?>">
	<input type="hidden" name="x_description" value="<?php echo $item_description; ?>">
	<input type="hidden" name="x_line_item" value="<?php echo $custom; ?><|>Donation<|><|>1<|><?php echo $amount; ?><|>FALSE">
	<div class="input-append">
		<input id="appendedPrependedDropdownButton" class="donate-input-text" name="amount" value="<?php echo $amount; ?>" type="text" placeholder="">
		<input type="submit" class="btn btn-primary" type="button" value="<?php _e('DONATE', 'ch'); ?>">
	</div>
</form>