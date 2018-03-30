<?php

/*********** Shortcode: BuyNow PayPal Button ************************************************************/

$ABdevDND_shortcodes['buynow_dd'] = array(
	'attributes' => array(
		'email' => array(
			'description' => __('Your Email', 'dnd-shortcodes'),
		),
		'lc' => array(
			'default' => 'US',
			'description' => __('Locale', 'dnd-shortcodes'),
		),
		'item_name' => array(
			'description' => __('Item Name', 'dnd-shortcodes'),
		),
		'item_number' => array(
			'description' => __('Item Number', 'dnd-shortcodes'),
		),
		'price' => array(
			'description' => __('Item Price', 'dnd-shortcodes'),
		),
		'currency' => array(
			'default' => 'USD',
			'description' => __('Currency', 'dnd-shortcodes'),
		),
		'creditcard' => array(
			'default' => '0',
			'description' => __('Show credit cards', 'dnd-shortcodes'),
			'type' => 'checkbox',
		),
		'tax_rate' => array(
			'default' => '0',
			'description' => __('Tax Rate', 'dnd-shortcodes'),
		),
		'shipping' => array(
			'default' => '0',
			'description' => __('Shipping Cost', 'dnd-shortcodes'),
		),
	),
	'description' => __('BuyNow PayPal Button', 'dnd-shortcodes' )
);
function ABdevDND_buynow_dd_shortcode( $attributes ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('buynow_dd'), $attributes));

	$creditcard_return=($creditcard=='1')?'CC':'';

	return '
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="'.$email.'">
		<input type="hidden" name="lc" value="'.$lc.'">
		<input type="hidden" name="item_name" value="'.$item_name.'">
		<input type="hidden" name="item_number" value="'.$item_number.'">
		<input type="hidden" name="amount" value="'.$price.'">
		<input type="hidden" name="currency_code" value="'.$currency.'">
		<input type="hidden" name="button_subtype" value="services">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="tax_rate" value="'.$tax_rate.'">
		<input type="hidden" name="shipping" value="'.$shipping.'">
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow'.$creditcard_return.'_LG.gif" style="border:0px;" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" style="border:0px;" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>';
}
