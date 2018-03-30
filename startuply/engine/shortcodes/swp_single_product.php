<?php

/*-----------------------------------------------------------------------------------*/
/*	Single product VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			$product_pricing_type = array();
			$product_pricing_type[__('Custom HTML', 'vivaco')] = 'simple';

			$edd_product = array(__('', 'vivaco') => '-1');

			if (is_plugin_active('easy-digital-downloads/easy-digital-downloads.php')) {
				$edd_downloads = get_posts( 'post_type="download"&posts_per_page=-1&orderby=title&order=ASC' );

				if ( $edd_downloads ) {
					foreach ( $edd_downloads as $download ) {
						$edd_product[ $download->post_title ] = $download->ID;
					}
					$product_pricing_type[__('EDD Item', 'vivaco')] = 'edd';
				} else {
					$edd_product[ __( 'No download found', 'js_composer' ) ] = 0;
				}
			}

			vc_map(array(
				'name' => __('Single product', 'vivaco'),
				"icon" => "icon-table",
				'base' => 'vsc-product-pricing',
				'description' => 'EDD or Custom HTML',
				'weight' => 115,
				'class' => 'vsc_product_pricing',
				'category' => __('Content', 'vivaco'),
				'params' => array(
					array(
						"type" => "textfield",
						"heading" => __("Extra class name", "js_composer"),
						"param_name" => "el_class",
						"value" => "",
						"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Style', 'vivaco'),
						'param_name' => 'price_type',
						'value' => $product_pricing_type,
						'description' => __('Please choose product type', 'vivaco'),
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Product', 'vivaco'),
						'param_name' => 'product_id',
						'value' => $edd_product,
						'dependency' => array(
							'element' => 'price_type',
							'value' => 'edd'
						),
						'description' => __('Please enter Product Title', 'vivaco'),
					),
					array(
						'type' => 'textfield',
						'heading' => __('Custom product title', 'vivaco'),
						'param_name' => 'product_title',
						'admin_label' => true,
						'description' => __('Please enter Custom Product Title', 'vivaco'),
					),
					array(
						'type' => 'textfield',
						'heading' => __('Currency', 'vivaco'),
						'param_name' => 'product_currency',
						'dependency' => array(
							'element' => 'price_type',
							'value' => 'simple'
						),
						'description' => __('Please enter Product currency, default $', 'vivaco'), 
					),
					array(
						'type' => 'textfield',
						'heading' => __('Price', 'vivaco'),
						'param_name' => 'product_price',
						'dependency' => array(
							'element' => 'price_type',
							'value' => 'simple'
						),
						'description' => __('Please enter Product price', 'vivaco'),
					),
					array(
						'type' => 'textfield',
						'heading' => __('Period', 'vivaco'),
						'param_name' => 'product_period',
						// 'value' => array(
						// 	__('None', 'vivaco') => '',
						// 	__('Daily', 'vivaco') => 'Daily',
						// 	__('Weekly', 'vivaco') => 'Weekly',
						// 	__('Monthly', 'vivaco') => 'Monthly',
						// 	__('Yearly', 'vivaco') => 'Yearly',
						// ),
						'description' => __('Please enter Period', 'vivaco'),
					),
					array(
						"type" => "checkbox",
						"heading" => __("Featured", "vivaco"),
						"param_name" => "product_featured",
						"value" => array(
							__("Display as feature", "vivaco") => "yes"
						)
					),
					array(
						'type' => 'textarea_html',
						'holder' => 'div',
						'class' => '',
						'heading' => __('Features', 'vivaco'),
						'param_name' => 'content',
						'dependency' => array(
							'element' => 'price_type',
							'value' => 'simple'
						),
						'value' => '<ul class="list-unstyled"><li><strong>Free</strong> First</li><li><strong>Unlimited</strong> Second</li><li><strong>Unlimited</strong> Third</li><li><strong>Unlimited</strong> Fourth</li></ul>',
						'description' => __('Create your list Features', 'vivaco')
					),
					array(
						'type' => 'textfield',
						'heading' => __('Buy button text', 'vivaco'),
						'param_name' => 'product_buy_text',
						'dependency' => array(
							'element' => 'price_type',
							'value' => 'edd'
						),
						'description' => __('Please enter buy text', 'vivaco'),
					),
					array(
						'type' => 'textarea_raw_html',
						'heading' => __('Buy button', 'vivaco'),
						'param_name' => 'product_buy_link',
						'dependency' => array(
							'element' => 'price_type',
							'value' => 'simple'
						),
						'value' => '<a class="btn btn-outline base_clr_txt" href="#" style="">GET IT NOW</a>',
						'description' => __('Please enter buy button link', 'vivaco'),
					),
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Single product Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_product_pricing($atts, $content = null) {
	extract(shortcode_atts(array(
		'el_class' => '',
		'price_type' => 'simple',
		'product_id' => '',
		'product_title' => '',
		'product_currency' => '',
		'product_price' => '',
		'product_period' => '',
		'product_featured' => '',
		'product_buy_link' => '',
		'product_buy_text' => ''
	), $atts));

	$product_price_from = '';
	$is_simple = '';
	$internal_buy_html = '';

	if( is_plugin_active('easy-digital-downloads/easy-digital-downloads.php') &&
		$price_type === 'edd' &&
		!empty($product_id) ) {

		//$product_title = get_the_title($product_id); // we will override product title here
		$is_simple = 'edd_product';
		if($price_type == 'edd'){
			$product_currency = edd_currency_symbol();
		}
		if(edd_has_variable_prices($product_id)) {
			$product_price_from = '<span class="price-from">'.__('from: ', 'vivaco' ).'</span>';
		}

		$product_price = number_format (edd_get_download_price($product_id),0);

		$product = get_post($product_id);
		if ( $product ) {
			$content = apply_filters('the_content', $product->post_content);
			$content = str_replace(']]>', ']]&gt;', $content);
		}

		$button_behavior = get_post_meta( $product_id, '_edd_button_behavior', true );

		$options = array(
			'download_id' => $product_id,
			'price' => false,
			'direct' => (!empty($button_behavior) && $button_behavior == 'direct') ? true : false,
			'class' => 'btn btn-outline base_clr_txt'
		);

		if(!empty($product_buy_text)) {
			$options['text'] = $product_buy_text;
		}

		$internal_buy_html = '<div class="signup">'.edd_get_purchase_link($options).'</div>';
	}

	if( $price_type === 'simple' || $price_type == '') {
		$internal_buy_html = '<div class="signup">
			'.rawurldecode(base64_decode($product_buy_link)).'
		</div>';
		$is_simple = 'simple_product';
		$content = do_shortcode($content);
	}

	$featured = '';
	if( $product_featured === 'yes') {
		$featured = ' featured';
	}

	$output = '';

$output = <<<CONTENT
		<div class="pricing-column $el_class $is_simple">
			<div class="package-column heading-font base_clr_bg$featured">
				<div class="column-shadow"></div>
				<div class="package-title">$product_title</div>
				<div class="package-value package-price base_clr_txt">
					<div class="price">
						$product_price_from<span class="package-currency currency">$product_currency</span>$product_price
					</div>
					<div class="period base_clr_txt">
						<span class="package-time">$product_period</span>
					</div>
				</div>
				<div class="package-features package-detail">
					$content
					$internal_buy_html
				</div>
			</div>
		</div>
CONTENT;

	return do_shortcode($output);
}
add_shortcode("vsc-product-pricing", "vsc_product_pricing");
