<?php

/*------------------------------------------------------------*/
/*	Add Custom Post Types
/*------------------------------------------------------------*/

// add_action('init', 'sleek_create_custom_post_type_portfolio');
add_action('init', 'sleek_create_custom_post_type_slider');



/*------------------------------------------------------------*/
/* 	Portfolio
/*------------------------------------------------------------*/

function sleek_create_custom_post_type_portfolio() {

	// Register Taxonomies for Portfolio
	register_taxonomy('category_portfolio', 'sleek-portfolio', array(
			'labels' => array(
				 'name' => 'Portfolio Categories'
				,'singular_name' => 'Portfolio Category'
			)
			,'hierarchical' => true
		)
	);
	register_taxonomy('tag_portfolio', 'sleek-portfolio', array(
		'labels' => array(
			 'name' => 'Portfolio Tags'
			,'singular_name' => 'Portfolio Tag'
		)
		,'hierarchical' => false
	));

	// Register Portfolio Post Type
	register_post_type('sleek-portfolio', array(
		'labels' => array(
			 'name' 			=> __('Portfolio', 'sleek')
			,'singular_name' 	=> __('Portfolio Item', 'sleek')
			,'add_new' 			=> __('Add New', 'sleek')
			,'add_new_item' 	=> __('Add New Portfolio Item', 'sleek')
			,'edit' 			=> __('Edit', 'sleek')
			,'edit_item' 		=> __('Edit Portfolio Item', 'sleek')
			,'new_item' 		=> __('New Portfolio Item', 'sleek')
			,'view' 			=> __('View Portfolio', 'sleek')
			,'view_item' 		=> __('View Portfolio Item', 'sleek')
			,'search_items' 	=> __('Search Portfolio', 'sleek')
			,'not_found' 		=> __('No Portfolio Items found', 'sleek')
		)
		,'public' 		=> true
		,'hierarchical' => true
		,'has_archive' 	=> true
		,'supports'		=> array('title','editor','thumbnail','excerpt','comments')
		,'can_export' 	=> true
		,'taxonomies'	=> array('category_portfolio','tag_portfolio')
		,'menu_icon'	=> 'dashicons-camera'
	));

}



/*------------------------------------------------------------*/
/* 	Slider
/*------------------------------------------------------------*/

if( !function_exists( 'sleek_create_custom_post_type_slider' ) ){
function sleek_create_custom_post_type_slider() {

	// Register Taxonomies for Slider
	register_taxonomy('category_slider', 'sleek-slider', array(
			'labels' => array(
				 'name' => 'Slider Categories'
				,'singular_name' => 'Slider Category'
			)
			,'hierarchical' => true
			,'show_in_nav_menus' => false
			,'show_tagcloud' => false
		)
	);
	register_taxonomy('tag_slider', 'sleek-slider', array(
		'labels' => array(
			 'name' => 'Slider Tags'
			,'singular_name' => 'Slider Tag'
		)
		,'hierarchical' => false
		,'show_in_nav_menus' => false
		,'show_tagcloud' => false
	));

	// Register slider Post Type
	register_post_type('sleek-slider', array(
		'labels' => array(
			 'name' 			=> __('Slider', 'sleek')
			,'singular_name' 	=> __('Slider Item', 'sleek')
			,'add_new' 			=> __('Add New', 'sleek')
			,'add_new_item' 	=> __('Add New Slider Item', 'sleek')
			,'edit' 			=> __('Edit', 'sleek')
			,'edit_item' 		=> __('Edit Slider Item', 'sleek')
			,'new_item' 		=> __('New Slider Item', 'sleek')
			,'view' 			=> __('View Slider', 'sleek')
			,'view_item' 		=> __('View Slider Item', 'sleek')
			,'search_items' 	=> __('Search Slider', 'sleek')
			,'not_found' 		=> __('No Slider Items found', 'sleek')
		)
		,'public' 		=> true
		,'hierarchical' => false
		,'has_archive' 	=> false
		,'supports'		=> array('title','editor','thumbnail')
		,'can_export' 	=> true
		,'taxonomies'	=> array('category_slider','tag_slider')
		,'menu_icon'	=> 'dashicons-format-gallery'
		,'show_in_nav_menus' => false
		,'exclude_from_search' => true
	));

}
}
