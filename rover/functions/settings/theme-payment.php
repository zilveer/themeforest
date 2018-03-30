<?php 
/**
 *  @package by Theme Record
*/

$currency_args = array(
	'AUD' => 'Australian Dollars (&#36;)',
	'BRL' => 'Brazilian Real (&#36;)',
	'CAD' => 'Canadian Dollars (&#36;)',
	'CZK' => 'Czech Koruna (&#75;&#269;)',
	'DKK' => 'Danish Krone',
	'EUR' => 'Euros (&euro;)',
	'HKD' => 'Hong Kong Dollar (&#36;)',
	'HUF' => 'Hungarian Forint',
	'ILS' => 'Israeli Shekel',
	'JPY' => 'Japanese Yen (&yen;)',
	'MYR' => 'Malaysian Ringgits (RM)',
	'MXN' => 'Mexican Peso (&#36;)',
	'NOK' => 'Norwegian Krone',
	'NZD' => 'New Zealand Dollar (&#36;)',
	'PHP' => 'Philippine Pesos',
	'PLN' => 'Polish Zloty',
	'GBP' => 'Pounds Sterling (&pound;)',
	'SGD' => 'Singapore Dollar (&#36;)',
	'SEK' => 'Swedish Krona',
	'CHF' => 'Swiss Franc',
	'TWD' => 'Taiwan New Dollars',
	'THB' => 'Thai Baht',
	'TRY' => 'Turkish Lira (TL)',
	'USD' => 'US Dollars (&#36;)'
);

$options = array(

	array('name' => __('Paypal Settings', 'TR'), 'type' => 'tab_page_title'),

	array('type' => 'tabs_head'),

	//Tab Title
	array('type' => 'tab_title_head'),
	array('name' => __('General', 'TR'), 'slug' => 'general', 'class' => 'active', 'type' => 'tab'),
	array('name' => __('Pages', 'TR'), 'slug' => 'pages', 'type' => 'tab'),
	array('name' => __('Email', 'TR'), 'slug' => 'email', 'type' => 'tab'),
	array('type' => 'tab_title_foot'),

	//General
	array('slug' => 'general', 'type' => 'tab_content_head'),
	array(
			'name' => __('Paypal Email Address', 'TR'),
			'desc' => __('Enter your email for the paypal.', 'TR'),
			'id' => 'paypal_email',
			'std' => get_option('admin_email'),
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Currency', 'TR'),
			'desc' => __('This controls what currency prices are listed at in the catalog and which currency gateways will take payments in.', 'TR'),
			'id' => 'currency',
			'std' => 'USD',
			'options' => $currency_args,
			'type' => 'select'
	),
	array(
			'name' => __('Paypal Sandbox',  'TR'),
			'desc' => __('You must open a free developer account to use sandbox for your tests before go live. Go to <a href="https://developer.paypal.com/" target="_blank">https://developer.paypal.com/</a>, register and connect.',  'TR'),
			'id' => 'paypal_sandbox',
			'std' => 'no',
			'options' => array(
				'yes' => __('Yes', 'TR'),
				'no' => __('No', 'TR')
			),
			'type' => 'radio'
	),
	array(
			'name' => __('Shipping Methods', 'TR'),
			'id' => 'shopping_methods',
			'std' => '1',
			'options' => array(
				'1' => __('Free Shopping', 'TR'),
				'2' => __('Shopping cost per product', 'TR'),
				'3' => __('Shopping cost per order', 'TR')
			),
			'type' => 'radio',
	),
	array(
			'name' => __('Shopping Cost', 'TR'),
			'id' => 'shopping_fee',
			'std' => '',
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Add to cart button text', 'TR'),
			'desc' => __('Set the text for the add cart button.', 'TR'),
			'id' => 'add_to_cart_text',
			'std' => 'Add to cart',
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Cart empty text', 'TR'),
			'desc' => __('Set the text When Cart Empty.', 'TR'),
			'id' => 'cart_empty_text',
			'std' => 'Your cart is empty.',
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Thank you text', 'TR'),
			'desc' => __('Set the text for the thank you page.', 'TR'),
			'id' => 'thank_you_page_text',
			'std' => 'Thanks for your order! We will process your order as soon as possible.',
			'class' => 'no',
			'rows' => '2',
			'type' => 'textarea'
	),
	array('type' => 'tab_content_foot'),

	//Page
	array('slug' => 'pages', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Shop Page','TR'),
			'id' => 'shopping_base_page',
			'std' => get_option( 'TR_theme_shop_page_id' ),
			'prompt' => esc_html__('Choose page..','TR'),
			'target' => 'page',
			'type' => 'select',
	),
	array(
			'name' => __('Cart Page','TR'),
			'desc' => __('If you want to change the default cart page, you should add the shortcode [shopping_cart] in the page that you have selected.','TR'),
			'id' => 'shopping_cart_page',
			'std' => get_option( 'TR_theme_cart_page_id' ),
			'prompt' => esc_html__('Choose page..','TR'),
			'target' => 'page',
			'type' => 'select',
	),
	array(
			'name' => __('Thanks Page','TR'),
			'desc' => __('If you want to change the default thanks page, you should add the shortcode [shopping_thank_you] in the page that you have selected.','TR'),
			'id' => 'shopping_thank_you',
			'std' => get_option( 'TR_theme_thank_you_page_id' ),
			'prompt' => esc_html__('Choose page..','TR'),
			'target' => 'page',
			'class' => 'no',
			'type' => 'select',
	),
	array('type' => 'tab_content_foot'),


	//Email
	array('slug' => 'email', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Email Address', 'TR'),
			'desc' => __('Enter your email for the order details.', 'TR'),
			'id' => 'saler_send_email',
			'std' => get_option('admin_email'),
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Saler Subject', 'TR'),
			'id' => 'saler_subject',
			'std' => 'An order has been completed from your shop.',
			'rows' => '2',
			'type' => 'textarea'
	),
	array(
			'name' => __('Saler Message', 'TR'),
			'id' => 'saler_message',
			'std' => 'Congratulation! An order has been completed from your shop.',
			'rows' => '2',
			'type' => 'textarea'
	),
	array(
			'name' => __('Buyer Subject', 'TR'),
			'id' => 'buyer_subject',
			'std' => 'Thank you for your order.',
			'rows' => '2',
			'type' => 'textarea'
	),
	array(
			'name' => __('Buyer Message', 'TR'),
			'id' => 'buyer_message',
			'std' => 'Thank you for your order - the details are confirmed below:',
			'rows' => '2',
			'class' => 'no',
			'type' => 'textarea'
	),
	array('type' => 'tab_content_foot'),

	array('type' => 'tabs_foot')

);

return array('auto' => true, 'name' => 'payment', 'options' => $options );

?>