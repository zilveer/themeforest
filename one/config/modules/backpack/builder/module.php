<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Builder.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\Builder
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0.1
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * True to enable configuration options regarding the builder.
	 */
	'options' => true,

	/**
	 * True to enable optimized markup for the builder blocks.
	 */
	'advanced_markup' => true,

	/**
	 * A list of page templates that implement the Slideshow module.
	 */
	'templates' => array(),

	/**
	 * Set to true to add a width control to the builder section appearance modal.
	 */
	'appearance_width' => true
);

$thb_theme->setConfig( 'backpack/builder', thb_array_asum( $thb_config, $config ) );

/**
 * Builder libraries
 * -----------------------------------------------------------------------------
 */
require_once 'lib.php';
require_once 'helpers.php';
require_once 'fields/class.blockslistfield.php';

/**
 * Builder helpers
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_builder_instance') ) {
	function thb_builder_instance() {
		return THB_Builder::getInstance();
	}
}

if( !function_exists('thb_get_builder_blocks') ) {
	function thb_get_builder_blocks() {
		$blocks = array();

		// $blocks[''] = '-';

		foreach ( thb_builder_instance()->getBlocks() as $block ) {
			if ( $block->isActive() ) {
				$blocks[$block->getSlug()] = $block->getTitle();
			}
		}

		ksort( $blocks );

		return $blocks;
	}
}

/**
 * Builder modals
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'thb_builder_add_block_selection_modal' ) ) {
	function thb_builder_add_block_selection_modal() {
		$thb_block_selection_modal = new THB_Modal( __( 'Block selection', 'thb_text_domain' ), 'block_selection' );
		$thb_block_selection_modal->hideFooter();
			$thb_modal_container = $thb_block_selection_modal->createContainer( '', 'thb_block_selection_container' );

			$thb_field = new THB_BlocksListField( 'type' );
			$thb_field->setLabel( '' );
			$thb_modal_container->addField( $thb_field );

		thb_theme()->getAdmin()->addModal( $thb_block_selection_modal );
	}

	add_action( 'wp_loaded', 'thb_builder_add_block_selection_modal' );
}

$thb_section_appearance_modal = new THB_Modal( __( 'Appearance', 'thb_text_domain' ), 'section_appearance' );
	$thb_section_appearance_modal_tab = $thb_section_appearance_modal->createTab( __( 'Dimensions', 'thb_text_domain' ), 'section_appearance_dimensions' );
	$thb_modal_container = $thb_section_appearance_modal_tab->createContainer( '', 'thb_appearance_dimensions_container' );

		if ( thb_config( 'backpack/builder', 'appearance_width' ) ) {
			$thb_field = new THB_SelectField( 'width' );
			$thb_field->setLabel( __( 'Width', 'thb_text_domain' ) );
			$thb_field->setOptions( array(
				'boxed' => __( 'Boxed', 'thb_text_domain' ),
				'extended' => __( 'Extended', 'thb_text_domain' ),
			) );
			$thb_modal_container->addField( $thb_field );
		}

		$padding_help = __( 'E.g. 10px or 10%. If unitless, pixels will be used.', 'thb_text_domain' );

		$thb_field = new THB_TextField( 'padding_top' );
		$thb_field->setLabel( __( 'Padding top', 'thb_text_domain' ) );
		$thb_field->setHelp( $padding_help );
		$thb_modal_container->addField( $thb_field );

		$thb_field = new THB_TextField( 'padding_bottom' );
		$thb_field->setLabel( __( 'Padding bottom', 'thb_text_domain' ) );
		$thb_field->setHelp( $padding_help );
		$thb_modal_container->addField( $thb_field );

		$thb_field = new THB_TextField( 'margin_top' );
		$thb_field->setLabel( __( 'Margin top', 'thb_text_domain' ) );
		$thb_field->setHelp( $padding_help );
		$thb_modal_container->addField( $thb_field );

		$thb_field = new THB_TextField( 'margin_bottom' );
		$thb_field->setLabel( __( 'Margin bottom', 'thb_text_domain' ) );
		$thb_field->setHelp( $padding_help );
		$thb_modal_container->addField( $thb_field );

		$thb_section_appearance_modal_tab = $thb_section_appearance_modal->createTab( __( 'Extra', 'thb_text_domain' ), 'section_appearance_extra' );
	$thb_modal_container = $thb_section_appearance_modal_tab->createContainer( '', 'thb_appearance_container' );

		$thb_field = new THB_TextField( 'class' );
		$thb_field->setLabel( __( 'CSS class', 'thb_text_domain' ) );
		$thb_modal_container->addField( $thb_field );

	$breakpoints = thb_responsive_breakpoints();

	if ( ! empty( $breakpoints ) ) {
		$thb_modal_tab = $thb_section_appearance_modal->createTab( __( 'Responsive', 'thb_text_domain' ), 'thb_section_appearance_responsive' );

		foreach ( $breakpoints as $breakpoint => $label ) {
			$thb_modal_container = $thb_modal_tab->createContainer( $label, 'thb_section_appearance_responsive_container_' . $breakpoint );

			$thb_field = new THB_TextField( 'padding_top_' . $breakpoint );
			$thb_field->setLabel( __( 'Padding top', 'thb_text_domain' ) );
			$thb_field->setHelp( $padding_help );
			$thb_modal_container->addField( $thb_field );

			$thb_field = new THB_TextField( 'padding_bottom_' . $breakpoint );
			$thb_field->setLabel( __( 'Padding bottom', 'thb_text_domain' ) );
			$thb_field->setHelp( $padding_help );
			$thb_modal_container->addField( $thb_field );

			$thb_field = new THB_TextField( 'margin_top_' . $breakpoint );
			$thb_field->setLabel( __( 'Margin top', 'thb_text_domain' ) );
			$thb_field->setHelp( $padding_help );
			$thb_modal_container->addField( $thb_field );

			$thb_field = new THB_TextField( 'margin_bottom_' . $breakpoint );
			$thb_field->setLabel( __( 'Margin bottom', 'thb_text_domain' ) );
			$thb_field->setHelp( $padding_help );
			$thb_modal_container->addField( $thb_field );
		}
	}

thb_theme()->getAdmin()->addModal( $thb_section_appearance_modal );

$thb_column_appearance_modal = new THB_Modal( __( 'Appearance', 'thb_text_domain' ), 'column_appearance' );
	$thb_modal_container = $thb_column_appearance_modal->createContainer( '', 'thb_column_appearance_container' );

		$thb_field = new THB_ColorField( 'background_color' );
		$thb_field->setLabel( __( 'Background color', 'thb_text_domain' ) );
		$thb_modal_container->addField( $thb_field );

		$padding_help = __( 'E.g. 10px or 10%. If unitless, pixels will be used.', 'thb_text_domain' );

		$thb_field = new THB_TextField( 'padding_top' );
		$thb_field->setLabel( __( 'Padding top', 'thb_text_domain' ) );
		$thb_field->setHelp( $padding_help );
		$thb_field->addClass( 'thb-padding-field thb-padding-top' );
		$thb_modal_container->addField( $thb_field );

		$thb_field = new THB_TextField( 'padding_right' );
		$thb_field->setLabel( __( 'Padding right', 'thb_text_domain' ) );
		$thb_field->setHelp( $padding_help );
		$thb_field->addClass( 'thb-padding-field thb-padding-right' );
		$thb_modal_container->addField( $thb_field );

		$thb_field = new THB_TextField( 'padding_bottom' );
		$thb_field->setLabel( __( 'Padding bottom', 'thb_text_domain' ) );
		$thb_field->setHelp( $padding_help );
		$thb_field->addClass( 'thb-padding-field thb-padding-bottom' );
		$thb_modal_container->addField( $thb_field );

		$thb_field = new THB_TextField( 'padding_left' );
		$thb_field->setLabel( __( 'Padding left', 'thb_text_domain' ) );
		$thb_field->setHelp( $padding_help );
		$thb_field->addClass( 'thb-padding-field thb-padding-left' );
		$thb_modal_container->addField( $thb_field );

		$thb_field = new THB_TextField( 'class' );
		$thb_field->setLabel( __( 'CSS class', 'thb_text_domain' ) );
		$thb_modal_container->addField( $thb_field );
		$thb_field->addClass( 'thb-class-field' );

	$thb_modal_container = $thb_column_appearance_modal->createContainer( __( 'Carousel', 'thb_text_domain' ), 'thb_column_appearance_container' );

		thb_carousel_options( $thb_modal_container, array( 'carousel_nav_arrows_position' ) );

	$breakpoints = thb_responsive_breakpoints();

	if ( ! empty( $breakpoints ) ) {
		$thb_modal_tab = $thb_column_appearance_modal->createTab( __( 'Responsive', 'thb_text_domain' ), 'thb_column_appearance_responsive' );

		foreach ( $breakpoints as $breakpoint => $label ) {
			$thb_modal_container = $thb_modal_tab->createContainer( $label, 'thb_column_appearance_responsive_container_' . $breakpoint );

			$thb_field = new THB_TextField( 'padding_top_' . $breakpoint );
			$thb_field->setLabel( __( 'Padding top', 'thb_text_domain' ) );
			$thb_field->setHelp( $padding_help );
			$thb_field->addClass( 'thb-padding-field thb-padding-top' );
			$thb_modal_container->addField( $thb_field );

			$thb_field = new THB_TextField( 'padding_right_' . $breakpoint );
			$thb_field->setLabel( __( 'Padding right', 'thb_text_domain' ) );
			$thb_field->setHelp( $padding_help );
			$thb_field->addClass( 'thb-padding-field thb-padding-right' );
			$thb_modal_container->addField( $thb_field );

			$thb_field = new THB_TextField( 'padding_bottom_' . $breakpoint );
			$thb_field->setLabel( __( 'Padding bottom', 'thb_text_domain' ) );
			$thb_field->setHelp( $padding_help );
			$thb_field->addClass( 'thb-padding-field thb-padding-bottom' );
			$thb_modal_container->addField( $thb_field );

			$thb_field = new THB_TextField( 'padding_left_' . $breakpoint );
			$thb_field->setLabel( __( 'Padding left', 'thb_text_domain' ) );
			$thb_field->setHelp( $padding_help );
			$thb_field->addClass( 'thb-padding-field thb-padding-left' );
			$thb_modal_container->addField( $thb_field );
		}
	}

thb_theme()->getAdmin()->addModal( $thb_column_appearance_modal );

/**
 * Builder metabox
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'thb_builder_metabox' ) ) {
	function thb_builder_metabox() {
		if ( thb_is_admin_template( thb_config('backpack/builder', 'templates') ) ) {
			$thb_metabox = new THB_Metabox( __( 'Layout builder', 'thb_text_domain' ), 'thb_builder' );

				if ( thb_config( 'backpack/builder', 'options' ) ) {
					$thb_container = $thb_metabox->createContainer( '', 'thb_builder_config' );

					$thb_field = new THB_SelectField( 'builder_position' );
					$thb_field->setLabel( __( 'Position', 'thb_text_domain' ) );
					$thb_field->setOptions( array(
						'top' => __( 'Above the content', 'thb_text_domain' ),
						'bottom' => __( 'Below the content and comments', 'thb_text_domain' ),
					) );
					$thb_container->addField( $thb_field );
				}

				$thb_container = $thb_metabox->createDuplicableContainer( '', 'thb_builder_rows' );
				$thb_container->setIntroText( __( 'Sections are injected in the page, usually below the regular page content. Each section can have multiple "rows", each row can be formed by multiple "columns" of various widths, each one of them containing a variable number of "blocks". Click on the "Add section" button to get started!', 'thb_text_domain' ) );
				$thb_container->setSortable( true );

				$thb_container->addControl( __( 'Add section', 'thb_text_domain' ), '', '', array(
					'action' => 'thb_builder_add_section'
				) );

					$thb_field = new THB_SectionField( 'section' );
					$thb_container->setField( $thb_field );

				$post_type = thb_get_post_type_from_template( thb_get_admin_template() );

			thb_theme()->getPostType( $post_type )->addMetabox( $thb_metabox );
		}
	}

	add_action( 'wp_loaded', 'thb_builder_metabox' );
}

/**
 * Builder assets
 * -----------------------------------------------------------------------------
 */
// thb_theme()->getFrontend()->addStyle( THB_SHARED_ASSETS_URL . '/fontello/css/fontello.css', array(
// 	'name' => 'thb_fontello'
// ));

// thb_theme()->getFrontend()->addStyle( thb_get_module_url( 'backpack/builder' ) . '/css/builder.css', array(
// 	'name' => 'thb_builder'
// ));

if( !function_exists('thb_load_theme_icons') ) {
	function thb_load_theme_icons(  ) {
		$icon_css = apply_filters( 'thb_icon_css_url', THB_SHARED_ASSETS_URL . '/fontello/css/fontello.css' );

		thb_theme()->getFrontend()->addStyle( $icon_css, array(
			'name' => 'thb-fontello',
			'deps' => array( 'thb_layout' )
		));
	}
}

add_action( 'wp_loaded', 'thb_load_theme_icons' );

if ( ! function_exists( 'thb_builder_frontend_scripts' ) ) {
	function thb_builder_frontend_scripts( $scripts ) {
		$scripts[] = thb_get_module_path( 'backpack/builder' ) . '/js/builder.js';

		return $scripts;
	}
}

add_filter( 'thb_frontend_scripts', 'thb_builder_frontend_scripts' );

if ( ! function_exists( 'thb_builder_not_compressed_frontend_scripts' ) ) {
	function thb_builder_not_compressed_frontend_scripts() {
		if ( ! thb_compress_frontend_scripts() ) {
			thb_theme()->getFrontend()->addScript( thb_get_module_url( 'backpack/builder' ) . '/js/builder.js', array(
				'name' => 'thb_builder'
			));
		}
	}
}

add_action( 'wp_loaded', 'thb_builder_not_compressed_frontend_scripts' );