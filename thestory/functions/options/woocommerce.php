<?php
/**
 * This file contains the main WooCommerce settings for the theme.
 */

global $pexeto;

$pexeto_pages_options= array( array(
		'name' => 'WooCommerce',
		'type' => 'title',
		'img' => 'icon-woocommerce'
	),

	array(
		'type' => 'open',
		'subtitles'=>array(
			array( 'id'=>'general', 'name'=>'General' )
		)
	),

	/* ------------------------------------------------------------------------*
	 * MEDIA
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'general'
	),

	array(
		'name' => 'Number of products per page',
		'id' => 'woo_products_per_page',
		'type' => 'text',
		'std' => '9'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Single Product Page Settings</h3>'
	),



	array(
		'name' => 'Page Layout',
		'id' => 'woo_product_layout',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'right', 'name'=>'Right Sidebar' ), 
			array( 'id'=>'left', 'name'=>'Left Sidebar' ), 
			array( 'id'=>'full', 'name'=>'Full width' ) ),
		'std' => 'right'
	),


	array(
		'name' => 'Page sidebar',
		'id' => 'woo_product_sidebar',
		'type' => 'select',
		'options' => pexeto_get_content_sidebars(),
		'std' => 'default'
	),


	array(
		'type' => 'close' ),


	array(
		'type' => 'close' ) );

$pexeto->options->add_option_set( $pexeto_pages_options );
