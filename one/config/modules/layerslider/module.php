<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Layerslider.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Layerslider
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * The specific page templates that include layerslider compatibility.
	 *
	 * Es.
	 * array(
	 * 	   'template-blog.php' => array( '2', '3' )
	 * )
	 */
	'grid_templates' => array()
);
$thb_theme->setConfig('layerslider', thb_array_asum($thb_config, $config));


/**
 * Check if layerslider is active
 * @return boolean
 */
function thb_is_layerslider() {
	if ( class_exists( 'layerslider' ) || defined( 'LS_PLUGIN_VERSION' ) ) {
		return true;
	}

	return false;
}

if( !function_exists('thb_get_layerslider') ) {
	/**
	 * Get the LayerSlider shortcode for the current page.
	 *
	 * @return string
	 */
	function thb_get_layerslider() {
		return thb_get_post_meta( thb_get_page_ID(), 'layerslider_shortcode' );
	}
}

if( !function_exists('thb_layerslider') ) {
	/**
	 * Display the LayerSlider slideshow for the current page.
	 */
	function thb_layerslider() {
		echo do_shortcode( thb_get_layerslider() );
	}
}

if( !function_exists('thb_layerslider_options') ) {
	/**
	 * Add LayerSlider post meta field.
	 */
	function thb_layerslider_options() {
		if ( ! thb_is_layerslider() ) {
			return;
		}

		$thb_theme = thb_theme();
		$thb_layerslider_page_template = thb_config('layerslider', 'templates');

		if( thb_is_admin_template( $thb_layerslider_page_template ) ) {
			$current = thb_get_admin_template();
			$post_type_name = thb_get_post_type_from_template( $current );
			$post_type = $thb_theme->getPostType( $post_type_name );

			if ( ! $thb_metabox = $post_type->getMetabox('layout') ) {
				return;
			}

			$thb_container = $thb_metabox->createContainer( __( 'LayerSlider', 'thb_text_domain' ), 'layerslider' );

			$thb_field = new THB_TextField( 'layerslider_shortcode' );
				$thb_field->setLabel( __('Slider code', 'thb_text_domain') );
				$thb_field->setHelp( __('Place here your LayerSlider shortcode.', 'thb_text_domain') );
			$thb_container->addField($thb_field);
		}
	}

	add_action( 'init', 'thb_layerslider_options' );
}