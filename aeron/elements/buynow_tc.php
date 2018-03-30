<?php

/*********** Shortcode: BuyNow PayPal Button ************************************************************/

$tcvpb_elements['buynow_tc'] = array(
	'name' => esc_html__('BuyNow PayPal Button', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-paypal',
	'category' => esc_html__('E-Commerce', 'ABdev_aeron' ),
	'attributes' => array(
		'email' => array(
			'description' => esc_html__('Your Email', 'ABdev_aeron'),
		),
		'lc' => array(
			'default' => 'US',
			'description' => esc_html__('Locale', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'item_name' => array(
			'description' => esc_html__('Item Name', 'ABdev_aeron'),
		),
		'item_number' => array(
			'description' => esc_html__('Item Number', 'ABdev_aeron'),
		),
		'price' => array(
			'description' => esc_html__('Item Price', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'currency' => array(
			'default' => 'USD',
			'description' => esc_html__('Currency', 'ABdev_aeron'),
		),
		'creditcard' => array(
			'default' => '0',
			'description' => esc_html__('Show credit cards', 'ABdev_aeron'),
			'type' => 'checkbox',
		),
		'tax_rate' => array(
			'default' => '0',
			'description' => esc_html__('Tax Rate', 'ABdev_aeron'),
		),
		'shipping' => array(
			'default' => '0',
			'description' => esc_html__('Shipping Cost', 'ABdev_aeron'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	)
);
function tcvpb_buynow_tc_shortcode( $attributes ) {
	extract(shortcode_atts(tcvpb_extract_attributes('buynow_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$id.'' : '';

	$creditcard_return=($creditcard=='1')?'CC':'';

	return '
	<form '.esc_attr($id_out).' '.esc_attr($class_out).' action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="'.esc_attr($email).'">
		<input type="hidden" name="lc" value="'.esc_attr($lc).'">
		<input type="hidden" name="item_name" value="'.esc_attr($item_name).'">
		<input type="hidden" name="item_number" value="'.esc_attr($item_number).'">
		<input type="hidden" name="amount" value="'.esc_attr($price).'">
		<input type="hidden" name="currency_code" value="'.esc_attr($currency).'">
		<input type="hidden" name="button_subtype" value="services">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="tax_rate" value="'.esc_attr($tax_rate).'">
		<input type="hidden" name="shipping" value="'.esc_attr($shipping).'">
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
		<input type="image" src="'.esc_url('https://www.paypalobjects.com/en_US/i/btn/btn_buynow'.$creditcard_return.'_LG.gif').'" style="border:0px;" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" style="border:0px;" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>';
}
