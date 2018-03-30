<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Photogallery.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\Photogallery
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
	 * A list of page templates that implement the Photogallery module.
	 */
	'templates' => array(),

	/**
	 * A list of columns available for the Photogallery templates.
	 */
	'templates_columns' => array(),

	/**
	 * A list of columns available for the Photogallery builder block.
	 */
	'builder_block_columns' => array(),

	/**
	 * Include the Photogallery script.
	 */
	'script' => true,

	/**
	 * Force isotope on Photogallery elements.
	 */
	'force_isotope' => false,
);
$thb_theme->setConfig('backpack/photogallery', thb_array_asum($thb_config, $config));

/**
 * Frontend helpers
 * -----------------------------------------------------------------------------
 */
require_once 'helpers.php';

if( ! function_exists('thb_module_photogallery_builder_blocks') ) {
	function thb_module_photogallery_builder_blocks() {
		if ( function_exists( 'thb_builder_instance' ) ) {
			require_once 'builder_lib.php';
			require_once 'builder_blocks.php';
		}
	}

	add_action( 'wp_loaded', 'thb_module_photogallery_builder_blocks' );
}

/**
 * Frontend scripts
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'thb_photogallery_scripts' ) ) {
	function thb_photogallery_scripts( $scripts ) {
		$scripts[] = thb_get_module_path( 'backpack/photogallery' ) . '/js/jquery.photoset.min.js';
		$scripts[] = thb_get_module_path( 'backpack/photogallery' ) . '/js/photogallery.js';

		return $scripts;
	}
}

if ( thb_config( 'backpack/photogallery', 'script' ) ) {
	add_filter( 'thb_frontend_scripts', 'thb_photogallery_scripts' );

	if ( ! thb_compress_frontend_scripts() ) {
		thb_theme()->getFrontend()->addScript( thb_get_module_url('backpack/photogallery') . '/js/jquery.photoset.min.js', array(
			'name' => 'photoset'
		) );
		thb_theme()->getFrontend()->addScript( thb_get_module_url('backpack/photogallery') . '/js/photogallery.js', array(
			'name' => 'photogallery'
		) );
	}
}



// if( ! function_exists( 'thb_photogallery_scripts' ) ) {
// 	function thb_photogallery_scripts() {
// 		$thb_photogallery_page_template = thb_config( 'backpack/photogallery', 'templates' );

// 		// if ( thb_is_page_template( $thb_photogallery_page_template ) && ! post_password_required() ) {
// 			thb_theme()->getFrontend()->addScript( thb_get_module_url('backpack/photogallery') . '/js/photogallery.js', array(
// 				'name' => 'photogallery'
// 			) );
// 		// }
// 	}

// 	if ( thb_config( 'backpack/photogallery', 'script' ) ) {
// 		add_action( 'thb_head_meta', 'thb_photogallery_scripts' );
// 	}
// }


/**
 * Photogallery metabox
 * -----------------------------------------------------------------------------
 */
if( ! function_exists('thb_photogallery_container') ) {
	function thb_photogallery_container() {
		$thb_theme = thb_theme();
		$thb_photogallery_page_template = thb_config('backpack/photogallery', 'templates');
		$grid_columns = thb_config( 'backpack/photogallery', 'templates_columns' );

		$slide_field = new THB_SlideField( 'photogallery_slide' );
		$slide_field->setLabel( __('Slide', 'thb_text_domain') );
		$slide_field->getModal( 'edit_slide_image' )->getContainer( 'edit_slide_image_container' )->removeField( 'class' );

		if( thb_is_admin_template( $thb_photogallery_page_template ) ) {
			$current_template = thb_get_admin_template();
			$thb_metabox = $thb_theme->getPostType( 'page' )->getMetabox( 'layout' );
			$thb_tab = $thb_metabox->createTab( __( 'Gallery', 'thb_text_domain' ), 'photogallery_tab' );
			$thb_tab->setIcon( 'screenoptions' );

				$thb_container = $thb_tab->createContainer( __('Configuration', 'thb_text_domain'), 'photogallery_masonry_details_container' );

				if( in_array( $current_template, array_keys( $grid_columns ) ) ) {
					thb_grid_layout_add_fields( $thb_container, $grid_columns[$current_template] );
				}

				$thb_field = new THB_NumberField( 'slides_per_page' );
					$thb_field->setLabel( __('Pictures per page', 'thb_text_domain') );
					$thb_field->setHelp( __('Choose how many pictures to load dinamically. Leaving this empty will show all the images available.', 'thb_text_domain') );
					$thb_field->setMin( '0' );
				$thb_container->addField($thb_field);

				$thb_container = $thb_tab->createDuplicableContainer( __('Photos', 'thb_text_domain'), 'photogallery_slides' );
				$thb_container->setSortable();

					$thb_container->addControl( __('Add photo', 'thb_text_domain'), 'add_image', '', array(
						'action' => 'thb_add_multiple_slides',
						'title' => __('Add photos', 'thb_text_domain')
					) );

					$thb_container->setField($slide_field);
		}
	}

	add_action( 'wp_loaded', 'thb_photogallery_container' );
}

/**
 * Frontend
 * -----------------------------------------------------------------------------
 */
if( ! function_exists('thb_photogallery') ) {
	/**
	 * Output the photogallery.
	 *
	 * @param array $args
	 */
	function thb_photogallery( $columns = false, $gutter = false, $height = false, $args = array() ) {
		if ( ! $columns ) {
			$columns = thb_get_grid_columns();
		}

		if ( ! $gutter ) {
			$gutter = thb_get_grid_gutter();
		}

		if ( ! $height ) {
			$height = thb_get_grid_images_height();
		}

		$image_size = thb_get_grid_image_size( $columns, $height );
		$force_isotope = thb_config( 'backpack/photogallery', 'force_isotope' );

		$args = wp_parse_args( $args, array(
			'slides'         => thb_photogallery_get_slides(),
			'image_size'     => $image_size,
			'columns'        => $columns,
			'gutter'         => $gutter,
			'height'		 => $height,
			'force_isotope'	 => $force_isotope,
			'show_load_more' => thb_photogallery_show_load_more()
		) );

		thb_get_subtemplate( 'backpack/photogallery', dirname(__FILE__), 'photogallery', $args );
	}
}