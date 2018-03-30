<?php
	/**
	 * @package Foundry
	 * @author TommusRhodus
	 * @version 3.0.0
	 */
	get_header( 'shop' ); 
	
	echo ebor_get_page_title( 
		get_option('shop_title','Our shop'), 
		$subtitle = get_option('shop_subtitle', 'The shop subtitle'), 
		$icon = false, 
		$thumbnail = ( get_option('foundry_shop_header_image') ) ? '<img src="'. get_option('foundry_shop_header_image') .'" alt="Shop Header" class="background-image" />' : false, 
		$layout = get_option('foundry_shop_header_layout', 'left-short-grey')
	);
	
	$sidebar = ( isset($_GET['layout']) ) ? $_GET['layout'] : false;
	$layout = ( $sidebar ) ? $sidebar : get_option('foundry_shop_layout', 'sidebar-right');

	get_template_part('loop/loop-product', $layout);

	get_footer( 'shop' );