<?php

return array(
	'icon'   => 'el el-shopping-cart',
	'title'  => __( 'WooCommerce', 'BERG' ),
	'fields' => array(
		array(
			'id' => 'woocommerce_shop_layout',
			'type' => 'select',
			'title' => __('Shop layout', 'BERG'),
			'options' => array(
				'chessboard' => __('Chessboard', 'BERG'),
				'standard' => __('Standard', 'BERG'),
			),
			'default' => 'chessboard', 
			'select2' => array( 'allowClear' => false )
  		),
		// array(
		// 	'id' => 'woocommerce_shop_layout',
		// 	'type' => 'select',
		// 	'title' => __('Main shop layout', 'BERG'),
		// 	'options' => array('chessboard' => __('Chessboard', 'BERG'), 'standard' => __('Standard', 'BERG')),
		// 	'selected' => 'chessboard'
		// ),
	
		array(
			'id' => 'woocommerce_shop_display_images',
			'type' => 'switch',
			'title' => __('Images on a product archive', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true, 
			// 'required' => array('berg_food_menu_filters','=', true),
		),
		array(
  			'id' => 'woocommerce_filters',
			'type' => 'switch',
			'title' => __('Category filters', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
  		),
  		array(
			'id' => 'woocommerce_sticky_category',
			'type' => 'switch',
			'title' => __('Sticky filters', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
			'required' => array('woocommerce_filters','=', true),
			// 'htmlOptions' => array()
		),
		array(
			'id' => 'woocommerce_display_desc',
			'type' => 'switch',
			'title' => __('Product description on shop page', 'BERG'),
			'subtitle' => __('Applies only to standard shop layout', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
		),
		array(
			'id' => 'woocommerce_type_desc',
			'type' => 'select',
			'title' => __('Type of product description', 'BERG'),
			'options' => array(
				'short_desc' => __('Short description (excerpt)', 'BERG'),
				'full_desc' => __('Full description (content)', 'BERG'),
			),
			'default' => 'short_desc',
			'required' => array('woocommerce_display_desc','=', true),
			'select2' => array( 'allowClear' => false )
			// 'htmlOptions' => array()
		),
	
		array(
			'id' 	  => 'berg_shop_sidebar_pos',
			'type' 	  => 'select',
			'title'   => __( 'Sidebar position on shop page', 'BERG' ),
			'subtitle' => __( 'Applies only to standard shop layout', 'BERG' ),
			'options' => array(
				'right' => __( 'Right side', 'BERG' ),
				'left'  => __( 'Left side', 'BERG' ),
				'none'  => __( 'Disabled', 'BERG' )
			),
			'default' => 'right',
			'select2' => array( 'allowClear' => false ),
			'required' => array('woocommerce_shop_layout','=', 'standard'),
		),
		array(
			'id' => 'woocommerce_type_cat',
			'type' => 'select',
			'title' => __('Category heading style', 'BERG'),
			'options' => array(
				'full' => __('Fullwidth section', 'BERG'),
				'boxed' => __('Boxed section', 'BERG'),
			),
			'default' => 'full',
			'required' => array('berg_shop_sidebar_pos','=', 'none'),
			'select2' => array( 'allowClear' => false )
			// 'htmlOptions' => array()
		),
		// array(
		// 	'id' 	   => 'berg_shop_sidebar_select',
		// 	'type' 	   => 'select',
		// 	'title'    => __( 'Select Sidebar', 'BERG' ),
		// 	'subtitle' => __( 'Choose sidebar to be used', 'BERG' ),
		// 	'options'  => $sidebarsArray,
		// 	'default'  => 'sidebar-1',
		// 	'required' => array( 'berg_shop_sidebar_pos', 'not', 'none' ),
		// ),
		array(
  			'id' => 'woocommerce_dynamic_cart',
			'type' => 'switch',
			'title' => __('Dynamic cart in WooCommerce menu', 'BERG'),
			'subtitle' => __('Appearance -> Menu -> WooCommerce', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
  		),
		// array(
		// 	'id' => 'woocommerce_dynamic_cart',
		// 	'type' => 'checkbox',
		// 	'title' => __('Include dynamic as last position in WooCommerce Menu', 'BERG'),
		// 	'default' => '1'
		// ),
		array(
  			'id' => 'woocommerce_show_rating_on_archive',
			'type' => 'switch',
			'title' => __('Show star rating on shop page', 'BERG'),
			// 'desc' => __('Include dynamic as last position in WooCommerce Menu', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
  		),
		// array(
		// 	'id' => 'woocommerce_show_rating_on_archive',
		// 	'type' => 'checkbox',
		// 	'title' => __('Show stars rating on a product archive', 'BERG'),
		// 	'default' => '1'
		// ),
		array(
  			'id' => 'woocommerce_show_rating_on_related',
			'type' => 'switch',
			'title' => __('Show star rating on a related, up-sells and cross-sells', 'BERG'),
			// 'desc' => __('Include dynamic as last position in WooCommerce Menu', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
  		),
		// array(
		// 	'id' => 'woocommerce_show_rating_on_related',
		// 	'type' => 'checkbox',
		// 	'title' => __('Show stars rating on a related, up-sells and cross-sells', 'BERG'),
		// 	'default' => '1'
		// ),
		array(
  			'id' => 'woocommerce_show_in_navbar',
			'type' => 'switch',
			'title' => __('Show WooCommerce shop in navbar', 'BERG'),
			// 'desc' => __('Include dynamic as last position in WooCommerce Menu', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => false,
  		),
  		array(
  			'id' => 'woocommerce_show_rating_on_single',
			'type' => 'switch',
			'title' => __('Show star rating on a single page', 'BERG'),
			// 'desc' => __('Include dynamic as last position in WooCommerce Menu', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
  		),
  		array(
  			'id' => 'woocommerce_show_social_share',
			'type' => 'switch',
			'title' => __('Show social shares on product page', 'BERG'),
			// 'desc' => __('Include dynamic as last position in WooCommerce Menu', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
  		),
		// array(
		// 	'id' => 'woocommerce_show_in_navbar',
		// 	'type' => 'checkbox',
		// 	'title' => __('Show Woocommerce Shop in Navbar', 'BERG'),
		// 	'default' => '1'
		// ),
		array(
			'id' => 'woo_share_on_facebook',
			'type' => 'checkbox',
			'title' => __('Show share on Facebook', 'BERG'),
			'default' => '1',
			'htmlOptions' => array(),
			'required' => array( 'woocommerce_show_social_share', '=', true ),
		),
		array(
			'id' => 'woo_share_on_twitter',
			'type' => 'checkbox',
			'title' => __('Show share on Twitter', 'BERG'),
			'default' => '1',
			'htmlOptions' => array(),
			'required' => array( 'woocommerce_show_social_share', '=', true ),
		),
		array(
			'id' => 'woo_share_on_google_plus',
			'type' => 'checkbox',
			'title' => __('Show share on Google +', 'BERG'),
			'default' => '1',
			'htmlOptions' => array(),
			'required' => array( 'woocommerce_show_social_share', '=', true ),
		),
		array(
			'id' => 'woo_share_on_pinterest',
			'type' => 'checkbox',
			'title' => __('Show share on Pinterest', 'BERG'),
			'default' => '1',
			'htmlOptions' => array(),
			'required' => array( 'woocommerce_show_social_share', '=', true ),
		),
		array(
			'id' => 'woo_share_on_linkedin',
			'type' => 'checkbox',
			'title' => __('Show share on LinkedIn', 'BERG'),
			'default' => '1',
			'htmlOptions' => array(),
			'required' => array( 'woocommerce_show_social_share', '=', true ),
		),
	)
);