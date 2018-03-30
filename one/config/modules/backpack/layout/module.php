<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Layout.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\Layout
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
	 * Enable the creation of an option tab in the main options page.
	 */
	'options' => true,

	/**
	 * Options concerning the logo and menu placement. Set to false to disable
	 * the creation of this option.
	 */
	'options_logo_position' => array(
		'logo-left'   => __( 'Left', 'thb_text_domain' ),
		'logo-center' => __( 'Center', 'thb_text_domain' ),
		'logo-right'  => __( 'Right', 'thb_text_domain' )
	),

	/**
	 * Enable the creation of an option metabox in the page/post editing screen.
	 */
	'meta_options' => true,

	/**
	 * Enable the creation of an option to optionally insert a page/post subtitle.
	 */
	'meta_options_subtitle' => true,

	/**
	 * Enable the creation of an option to disable a page/post header.
	 */
	'meta_options_pageheader_disable' => true,

	/**
	 * Add a body class for grid columns layout data and adds ids to grid containers.
	 */
	'grid_body_class' => false,

	/**
	 * The number of columns supported by the theme in a grid layout and the
	 * respective image sizes.
	 *
	 * Es.
	 * array(
	 *     '2' => array( 'fixed' => 'medium_cropped', 'variable' => 'medium' )
	 * )
	 */
	'grid_columns' => false,

	/**
	 * Gutter configurations for grid layouts.
	 *
	 * Es.
	 * array( 'small', 'medium' )
	 */
	'grid_gutter' => false,

	/**
	 * The number of columns supported by a specific page template in a grid layout.
	 *
	 * Es.
	 * array(
	 * 	   'template-blog.php' => array( '2', '3' )
	 * )
	 */
	'grid_templates' => array(),

	/**
	 * Add the footer sidebar functionality.
	 */
	'footer_sidebar' => true
);
$thb_theme->setConfig('backpack/layout', thb_array_asum($thb_config, $config));

/**
 * Frontend helpers
 * -----------------------------------------------------------------------------
 */
require_once 'helpers.php';

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

	if( thb_config('backpack/layout', 'options_logo_position') !== false ) {
		$thb_field = new THB_SelectField( 'logo_position' );
			$thb_field->setLabel( __('Logo position', 'thb_text_domain') );
			$thb_field->setOptions( thb_config('backpack/layout', 'options_logo_position') );
		$thb_container->addField($thb_field);
	}

	/**
	 * Footer
	 */
	if ( thb_config('backpack/layout', 'footer_sidebar') ) {
		$thb_container = $thb_tab->createContainer( __('Footer', 'thb_text_domain'), 'layout_options_footer' );

		$sep = '&nbsp;&nbsp;&nbsp;';

		$thb_field = new THB_SelectField( 'footer_layout' );
		$thb_field->setLabel( __('Layout', 'thb_text_domain') );

		$thb_field->addOptionsGroup( __('None', 'thb_text_domain'), array(
			'0' => "-",
		) );

		$thb_field->addOptionsGroup( __('One column', 'thb_text_domain'), array(
			'full-width' => __('Full width', 'thb_text_domain')
		) );

		$thb_field->addOptionsGroup( __('Two columns', 'thb_text_domain'), array(
			'one-half,one-half' => "1/2 $sep 1/2",
			'one-third,two-thirds' => "1/3 $sep 2/3",
			'two-thirds,one-third' => "2/3 $sep 1/3",
			'one-fourth,three-fourths' => "1/4 $sep 3/4",
			'three-fourths,one-fourth' => "3/4 $sep 1/4"
		) );
		$thb_field->addOptionsGroup( __('Three columns', 'thb_text_domain'), array(
			'one-third,one-third,one-third' => "1/3 $sep 1/3 $sep 1/3",
			'one-fourth,one-half,one-fourth' => "1/4 $sep 1/2 $sep 1/4",
			'one-half,one-fourth,one-fourth' => "1/2 $sep 1/4 $sep 1/4",
			'one-fourth,one-fourth,one-half' => "1/4 $sep 1/4 $sep 1/2"
		) );
		$thb_field->addOptionsGroup( __('Four columns', 'thb_text_domain'), array(
			'one-fourth,one-fourth,one-fourth,one-fourth' => "1/4 $sep 1/4 $sep 1/4 $sep 1/4",
		) );

		$thb_field->setHelp( __('Select the columns layout for the footer area. Selecting none will disable the footer area entirely.', 'thb_text_domain') );

		$thb_container->addField($thb_field);
	}

$thb_page->addTab($thb_tab, 20);

/**
 * Global options
 * -----------------------------------------------------------------------------
 */
if( ! function_exists('thb_layout_global_options_container') ) {
	function thb_layout_global_options_container() {
		$thb_container = new THB_MetaboxFieldsContainer( '', 'layout_container' );

			if( thb_check_template_config( 'backpack/layout', 'meta_options_subtitle' ) ) {
				$current_template_supports_subtitle = ! thb_text_startsWith(thb_get_admin_template(), 'single');

				// if( ! empty( $_POST ) || ! thb_text_startsWith(thb_get_admin_template(), 'single') ) {
				if ( $current_template_supports_subtitle ) {
					$field = new THB_TextField( 'subtitle' );
					$field->setLabel( __( 'Page subtitle', 'thb_text_domain' ) );
					$thb_container->addField($field);
				}
			}

			if( thb_check_template_config( 'backpack/layout', 'meta_options_pageheader_disable' ) ) {
				$field = new THB_CheckBoxField( 'pageheader_disable' );
				$field->setDefault(false);
				$field->setLabel( __( 'Disable page header', 'thb_text_domain' ) );
				$thb_container->addField($field);
			}

		return $thb_container;
	}
}

/**
 * Single & page options
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_single_layout_options') ) {
	function thb_single_layout_options() {
		$post_types = thb_theme()->getPostTypes();

		foreach( $post_types as $pt ) {
			if( $pt->isPublicContent() || $pt->getType() == 'post' || $pt->getType() == 'page' ) {
				$thb_metabox = new THB_Metabox( apply_filters( 'thb_layout_metabox_title', __( 'Theme options', 'thb_text_domain' ) ), 'layout' );
				$thb_metabox->setPriority('high');
					$thb_metabox->addContainer( thb_layout_global_options_container() );

					if ( thb_config( 'backpack/layout', 'grid_columns' ) !== false ) {
						$grid_templates = thb_config( 'backpack/layout', 'grid_templates' );
						$current_template = thb_get_admin_template();
						$is_grid_template = in_array( $current_template, array_keys($grid_templates) );

						if( $is_grid_template ) {
							$thb_container = $thb_metabox->createContainer( __( 'Grid', 'thb_text_domain' ), 'layout_grid_container' );

							thb_grid_layout_add_fields( $thb_container, $grid_templates[$current_template] );
						}

					}

				$pt->addMetabox( $thb_metabox );
			}
		}
	}
}

if( thb_check_template_config('backpack/layout', 'meta_options') ) {
	add_action( 'init', 'thb_single_layout_options', 10 );
}

/**
 * Body classes
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_layout_body_classes') ) {
	function thb_layout_body_classes( $classes ) {
		$classes[] = thb_get_option('logo_position');

		if( thb_page_header_disabled() ) {
			$classes[] = 'thb-pageheader-disabled';
		}

		if ( thb_config( 'backpack/layout', 'grid_body_class' ) ) {
			$grid_templates = thb_config( 'backpack/layout', 'grid_templates' );
			$current_template = thb_get_page_template();
			$is_grid_template = in_array( $current_template, array_keys($grid_templates) );

			if ( $is_grid_template ) {
				$classes[] = thb_get_grid_class_name( thb_get_grid_columns() );
			}
		}

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
			$custom_css = str_replace( '\"', '"', $custom_css );
			$custom_css = str_replace( "\\'", "'", $custom_css );
			$custom_css = wp_unslash( $custom_css );

			thb_css_start();
				echo $custom_css;
			thb_css_end();
		}
	}

	add_action( 'wp_head', 'thb_custom_css', 999999 );
}

/**
 * Custom JS
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_custom_js') ) {
	function thb_custom_js() {
		$custom_js = thb_get_option('custom_js');
		if( !empty($custom_js) ) {
			thb_js_start();
				echo $custom_js;
			thb_js_end();
		}
	}

	// add_action( 'wp_footer', 'thb_custom_js', 999999 );
}

/**
 * Bootstrap
 * -----------------------------------------------------------------------------
 */

/**
 * Footer sidebars
 */
if ( ! function_exists( 'thb_generate_footer_sidebars' ) ) {
	function thb_generate_footer_sidebars() {
		$thb_footer_layout = thb_get_option('footer_layout');

		if( !empty($thb_footer_layout) ) {
			$columns = explode(',', $thb_footer_layout);

			for( $i=0; $i<count($columns); $i++ ) {
				$sidebar_name = __('Footer column', 'thb_text_domain') . '#' . ($i+1);
				thb_theme()->addSidebar( $sidebar_name, 'footer-sidebar-' . $i, sprintf( __( 'This widget area is displayed in the #%s column in the theme footer.', 'thb_text_domain' ), $i + 1 ) );
			}
		}
	}

	add_action( 'after_setup_theme', 'thb_generate_footer_sidebars', 20 );
}