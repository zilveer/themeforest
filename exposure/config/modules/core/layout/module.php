<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Layout.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Layout
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * Enable the creation of an option tab in the main options page.
	 */
	'options' => true,

	/**
	 * Options concerning the logo and menu placement. Set to false to disable
	 * the creation of this option.
	 */
	'options_logo_position' => array(
		'logo-left'   => __('Left', 'thb_text_domain'),
		'logo-center' => __('Center', 'thb_text_domain'),
		'logo-right'  => __('Right', 'thb_text_domain')
	),

	/**
	 * Enable the creation of an option metabox in the page editing screen.
	 */
	'meta_options' => true,

	'meta_options_subtitle'           => true,
	'meta_options_pageheader_disable' => true,
	'meta_options_page_boxed'         => true,
	'meta_options_gutter'             => true,
		'meta_options_gutter_default' => true
);
$thb_theme->setConfig('core/layout', thb_array_asum($thb_config, $config));

/**
 * Options tab
 * -----------------------------------------------------------------------------
 */
$thb_page = $thb_theme->getAdmin()->getMainPage();

$thb_tab = new THB_Tab( __('Layout', 'thb_text_domain'), 'layout' );

	/**
	 * Header
	 */

	$thb_container = $thb_tab->createContainer( __('Header', 'thb_text_domain'), 'layout_options_header' );

	if( thb_config('core/layout', 'options_logo_position') !== false ) {
		$thb_field = new THB_SelectField( 'logo_position' );
			$thb_field->setLabel( __('Logo position', 'thb_text_domain') );
			$thb_field->setOptions( thb_config('core/layout', 'options_logo_position') );
		$thb_container->addField($thb_field);
	}

	/**
	 * Footer
	 */

	$thb_container = $thb_tab->createContainer( __('Footer', 'thb_text_domain'), 'layout_options_footer' );

	/**
	 * Customizations
	 */
	if( ! function_exists('thb_layout_custom_css') ) {
		function thb_layout_custom_css() {
			$thb_tab = thb_theme()->getAdmin()->getMainPage()->getTab('layout');
			$thb_container = $thb_tab->createContainer( __('Customizations', 'thb_text_domain'), 'layout_options_customizations' );

			$thb_field = new THB_TextareaField('custom_css');
				$thb_field->setAllowCode();
				$thb_field->setLabel( __('Custom frontend CSS', 'thb_text_domain') );
			$thb_container->addField($thb_field);
		}

		add_action( 'after_setup_theme', 'thb_layout_custom_css', 9999 );
	}

$thb_page->addTab($thb_tab);

/**
 * Global options
 * -----------------------------------------------------------------------------
 */
if( ! function_exists('thb_layout_global_options_container') ) {
	function thb_layout_global_options_container() {
		$thb_container = new THB_MetaboxFieldsContainer( '', 'layout_container' );

			if( thb_check_template_config('core/layout', 'meta_options_subtitle') ) {
				if( ! empty($_POST) || ! thb_text_startsWith(thb_get_admin_template(), 'single') ) {
					$field = new THB_TextField( 'subtitle' );
					$field->setLabel( __('Page subtitle', 'thb_text_domain') );
					$thb_container->addField($field);
				}
			}

			if( thb_check_template_config('core/layout', 'meta_options_pageheader_disable') ) {
				$field = new THB_CheckBoxField( 'pageheader_disable' );
				$field->setDefault(false);
				$field->setLabel( __('Disable page header', 'thb_text_domain') );
				$thb_container->addField($field);
			}

			if( thb_check_template_config('core/layout', 'meta_options_page_boxed') ) {
				$field = new THB_CheckBoxField( 'page_boxed' );
				$field->setDefault(false);
				$field->setLabel( __('Box the page content and sidebar', 'thb_text_domain') );
				$field->setHelp( __('Checking this option, the page content and sidebar will both have a color background.', 'thb_text_domain') );
				$thb_container->addField($field);
			}

			if( thb_check_template_config('core/layout', 'meta_options_gutter') ) {
				$thb_field = new THB_YesNoField( 'gutter' );
				$thb_field->setDefault(thb_config('core/layout', 'meta_options_gutter_default'));
				$thb_field->setLabel( __('Gutter', 'thb_text_domain') );
				$thb_container->addField($thb_field);
			}

		return $thb_container;
	}
}

/**
 * Page options
 * -----------------------------------------------------------------------------
 */
// if( thb_check_template_config('core/layout', 'meta_options') ) {
// 	$thb_pages = $thb_theme->getPostType('page');

// 	$thb_metabox = new THB_Metabox( __('Layout', 'thb_text_domain'), 'layout' );
// 	$thb_metabox->setPriority('high');
// 		$thb_metabox->addContainer( thb_layout_global_options_container() );

// 	$thb_pages->addMetabox($thb_metabox);
// }

/**
 * Single options
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_single_layout_options') ) {
	function thb_single_layout_options() {
		$post_types = thb_theme()->getPostTypes();

		foreach( $post_types as $pt ) {
			if( $pt->isPublicContent() || $pt->getType() == 'post' || $pt->getType() == 'page' ) {
				$thb_metabox = new THB_Metabox( __('Layout', 'thb_text_domain'), 'layout' );
				$thb_metabox->setPriority('high');
					$thb_metabox->addContainer( thb_layout_global_options_container() );

				$pt->addMetabox($thb_metabox);
			}
		}
	}

	if( thb_check_template_config('core/layout', 'meta_options') ) {
		add_action('after_setup_theme', 'thb_single_layout_options');
	}
}

/**
 * Body classes
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_layout_body_classes') ) {
	function thb_layout_body_classes( $classes ) {
		$id = thb_get_page_ID();

		if( thb_get_post_meta($id, 'page_boxed') ) {
			$classes[] = 'thb-page-boxed';
		}

		if( thb_get_post_meta( $id, 'pageheader_disable' ) == "1" ) {
			$classes[] = 'thb-pageheader-disabled';
		}

		if( thb_check_template_config('core/layout', 'meta_options_gutter') ) {
			$classes[] = 'thb-gutter-' . thb_get_post_meta($id, 'gutter');
		}
		
		$classes[] = thb_get_option('logo_position');

		return $classes;
	}

	add_filter( 'body_class', 'thb_layout_body_classes' );
}

/**
 * Custom CSS
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_custom_css') ) {
	function thb_custom_css() {
		$custom_css = thb_get_option('custom_css');
		if( !empty($custom_css) ) {
			// thb_css_start();
				echo $custom_css;
			// thb_css_end();
		}
	}

	// add_action( 'wp_head', 'thb_custom_css', 999999 );
}