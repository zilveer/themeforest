<?php

/*********** Shortcode: PayPal Donate ************************************************************/

$ABdevDND_shortcodes['donate_dd'] = array(
	'attributes' => array(
		'email' => array(
			'description' => __('Your Email', 'dnd-shortcodes'),
		),
		'lc' => array(
			'default' => 'US',
			'description' => __('Locale', 'dnd-shortcodes'),
		),
		'name' => array(
			'description' => __('Donation Name', 'dnd-shortcodes'),
		),
		'amount' => array(
			'description' => __('Amount', 'dnd-shortcodes'),
		),
		'currency' => array(
			'default' => 'USD',
			'description' => __('Currency', 'dnd-shortcodes'),
		),
		'creditcard' => array(
			'default' => '0',
			'description' => __('Show Credit Cards', 'dnd-shortcodes'),
			'type' => 'checkbox',
		),
	),
	'description' => __('Donate PayPal Button', 'dnd-shortcodes' )
);
function ABdevDND_donate_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('donate_dd'), $attributes));

	$amount_return=($amount!='')?'<input type="hidden" name="amount" value="'.$amount.'">':'';
	$creditcard_return=($creditcard=='1')?'CC':'';

	return '
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_donations">
		<input type="hidden" name="business" value="'.$email.'">
		<input type="hidden" name="lc" value="'.$lc.'">
		<input type="hidden" name="item_name" value="'.$name.'">
		'.$amount_return.'
		<input type="hidden" name="currency_code" value="'.$currency.'">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate'.$creditcard_return.'_LG.gif" style="border:0px;" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" style="border:0px;" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	';
}
