<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Full background slideshow.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Slideshow\Fullbackground
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
	 * Slideshow default image size
	 */
	'image_size' => 'full',

	/**
	 * True if the fullbackground should act as a full screen background,
	 * with no extra wrappers.
	 */
	'fixed' => true,

	/**
	 * Templates that implement the full background slideshow
	 */
	'templates' => array(),

	/**
	 * Enable visual controls for the slideshow
	 */
	'controls' => true,

	/**
	 * Enable keyboard controls for the slideshow
	 */
	'keyboard' => true,

	/**
	 * Templates that implement a carousel navigation for the slideshow
	 */
	'carousel' => array(),

	/**
	 * True if slides can be redimensioned to fit the viewport according to their ratio.
	 */
	'fit' => true,

	/**
	 * True if slides have support for captions.
	 */
	'slides_captions' => true,

	/**
	 * True if slides support images.
	 */
	'slides_images' => true,

	/**
	 * True if slides support videos.
	 */
	'slides_videos' => true
);
$thb_theme->setConfig('core/slideshows/submodules/fullbackground', thb_array_asum($thb_config, $config));

/**
 * Module bootstrap
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_create_fullbackground_metabox') ) {
	/**
	 * Create the full background metabox.
	 *
	 * @return THB_Metabox
	 */
	function thb_create_fullbackground_metabox() {
		$thb_metabox = new THB_Metabox( __('Full screen background', 'thb_text_domain'), 'full_screen_background' );
		$thb_metabox->setPriority('low');

		$thb_container = $thb_metabox->createContainer( __('Display', 'thb_text_domain'), 'fullbackground_display_options' );

		if( thb_config('core/slideshows/submodules/fullbackground', 'fit') ) {
			$field = new THB_CheckboxField( 'fullbackground_fit' );
			$field->setLabel( __('Disable full screen images', 'thb_text_domain') );
			$field->setHelp( __('By checking this, images will be fit in the viewport.', 'thb_text_domain') );
			$field->setDefault('0');
			$thb_container->addField($field);
		}

		$thb_container = $thb_metabox->createContainer( __('Timing and effects', 'thb_text_domain'), 'fullbackground_options' );

		$field = new THB_NumberField( 'fullbackground_delay' );
		$field->setLabel( __('Delay', 'thb_text_domain') );
		$field->setMin('0');
		$field->setHelp( __('Expressed in seconds.', 'thb_text_domain') );
		$field->setPlaceholder( __('E.g. 5', 'thb_text_domain') );
		$thb_container->addField($field);

		$field = new THB_NumberField( 'fullbackground_transition_speed' );
		$field->setLabel( __('Transition speed', 'thb_text_domain') );
		$field->setHelp( __('Expressed in seconds.', 'thb_text_domain') );
		$field->setPlaceholder( __('E.g. 1', 'thb_text_domain') );
		$field->setMin('0');
		$field->setStep('0.25');
		$thb_container->addField($field);

		$field = new THB_CheckboxField( 'fullbackground_autoplay' );
		$field->setLabel( __('Autoplay', 'thb_text_domain') );
		$field->setDefault('1');
		$thb_container->addField($field);

		$field = new THB_SelectField( 'fullbackground_effects' );
		$field->setLabel( __('Effects', 'thb_text_domain') );
		$field->setOptions(array(
			'fadeout' => __('Fade', 'thb_text_domain'),
			'scrollHorz' => __('Slide', 'thb_text_domain')
		));
		$thb_container->addField($field);

		$thb_container = thb_create_slideshows_slides_container( __('Slides', 'thb_text_domain'), array(
			'captions' => thb_config('core/slideshows/submodules/fullbackground', 'slides_captions'),
			'images' => thb_config('core/slideshows/submodules/fullbackground', 'slides_images'),
			'videos' => thb_config('core/slideshows/submodules/fullbackground', 'slides_videos')
		) );

		$thb_metabox->addContainer($thb_container);

		return $thb_metabox;
	}
}

if( !function_exists('thb_add_fullbackground_metabox') ) {
	/**
	 * Add the full background metabox in selected page templates.
	 *
	 * @return void
	 */
	function thb_add_fullbackground_metabox() {
		$config = thb_config('core/slideshows/submodules/fullbackground');

		if( thb_is_admin_template($config['templates']) ) {
			$thb_metabox = thb_create_fullbackground_metabox();

			foreach( $config['templates'] as $template ) {
				if( thb_is_admin_template($template) ) {
					$post_type = thb_theme()->getPostType( thb_get_post_type_from_template($template) );
					$post_type->addMetabox($thb_metabox);
				}
			}
		}
	}

	add_action('wp_loaded', 'thb_add_fullbackground_metabox');
}

/**
 * Module hooks
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_fullbackground') ) {
	/**
	 * Display a full background.
	 *
	 * @return void
	 */
	function thb_fullbackground() {
		$id = thb_get_page_ID();

		if( $id == 0 ) {
			return;
		}

		$module_config = thb_config('core/slideshows/submodules/fullbackground');

		if( !thb_is_page_template($module_config['templates']) ) {
			return;
		}

		$slideshow = new THB_Slideshow($id);
		$slideshow->setSize( $module_config['image_size'] );

		thb_get_module_template_part('core/slideshows/submodules/fullbackground', 'slideshow', array(
			'slides'     => $slideshow->getSlides(),
			'image_size' => $slideshow->getSize(),
			'fixed'		 => $module_config['fixed'],
			'id'         => $id
		));
	}

	add_action('thb_fullbackground_start', 'thb_fullbackground');
}

if( !function_exists('thb_fullbackground_start') ) {
	/**
	 * Run the full background hook.
	 *
	 * @return void
	 */
	function thb_fullbackground_start() {
		do_action('thb_fullbackground_start');
	}
}

/**
 * Scripts and styles
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_fullbackground_scripts_and_styles') ) {
	function thb_fullbackground_scripts_and_styles() {
		$config = thb_config('core/slideshows/submodules/fullbackground');
		$thb_fullbg = thb_get_module_url('core/slideshows/submodules/fullbackground');
		$thb_frontend = thb_theme()->getFrontend();

		$fullbackground_conf = array(
			'templates' => $config['templates']
		);

		$thb_frontend->addStyle($thb_fullbg . '/css/style.css', $fullbackground_conf);
		$thb_frontend->addStyle($thb_fullbg . '/css/elastislide.css', $fullbackground_conf + $config['carousel']);
		$thb_frontend->addScript($thb_fullbg . '/js/jquery.cycle2.min.js', $fullbackground_conf);
		// $thb_frontend->addScript($thb_fullbg . '/js/jquery.cycle2.tile.min.js', $fullbackground_conf);
		$thb_frontend->addScript($thb_fullbg . '/js/modernizr.js', $fullbackground_conf + $config['carousel']);
		$thb_frontend->addScript($thb_fullbg . '/js/jquery.elastislide.js', $fullbackground_conf + $config['carousel']);
		$thb_frontend->addScript($thb_fullbg . '/js/thb.fullbackground.js', $fullbackground_conf);
	}

	add_action('wp_loaded', 'thb_fullbackground_scripts_and_styles');
}

/**
 * Body classes
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_fullbackground_body_classes') ) {
	function thb_fullbackground_body_classes( $classes ) {
		$id = thb_get_page_ID();
		$fit = thb_get_post_meta($id, 'fullbackground_fit');

		if( $fit ) {
			$classes[] = 'thb-fullbackground-fit';
		}

		return $classes;
	}

	add_filter( 'body_class', 'thb_fullbackground_body_classes' );
}