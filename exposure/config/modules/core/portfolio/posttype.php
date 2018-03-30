<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Portfolio custom post type.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Portfolio
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( !function_exists('thb_works_post_type') ) {
	function thb_works_post_type() {

		/**
		 * The post type labels.
		 *
		 * @see http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		$thb_works_labels = array(
			'name'               => __('Portfolio', 'thb_text_domain'),
			'singular_name'      => __('Work', 'thb_text_domain'),
			'add_new'            => __('Add new', 'thb_text_domain'),
			'add_new_item'       => __('Add new Work', 'thb_text_domain'),
			'edit'               => __('Edit', 'thb_text_domain'),
			'edit_item'          => __('Edit Work', 'thb_text_domain'),
			'new_item'           => __('New Work', 'thb_text_domain'),
			'view'               => __('View Work', 'thb_text_domain'),
			'view_item'          => __('View Work', 'thb_text_domain'),
			'search_items'       => __('Search Works', 'thb_text_domain'),
			'not_found'          => __('No Works found', 'thb_text_domain'),
			'not_found_in_trash' => __('No Works found in Trash', 'thb_text_domain'),
			'parent'             => __('Parent Work', 'thb_text_domain')
		);

		/**
		 * The post type arguments.
		 *
		 * @see http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		$options_slug = thb_get_option('works_url_slug');
		$slug = !empty( $options_slug ) ? $options_slug : 'works';

		$thb_works_args = array(
			'labels'            => $thb_works_labels,
			'public'            => true,
			'show_ui'           => true,
			'capability_type'   => 'post',
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => $slug, 'with_front' => true ),
			'query_var'         => true,
			'show_in_nav_menus' => false,
			'supports'          => array('title', 'thumbnail', 'excerpt', 'editor', 'comments')
		);

		/**
		 * Create the post type object.
		 */
		$thb_works = new THB_PostType('works', $thb_works_args);

		/**
		 * Create the post type taxonomy for Works categories.
		 */
		$thb_works_taxonomy = new THB_Taxonomy("portfolio_categories", array(
			'hierarchical'   => true,
			'label'          => __('Portfolio Categories', 'thb_text_domain'),
			'singular_label' => __('Portfolio Category', 'thb_text_domain'),
			'rewrite'        => true,
			'query_var'      => true
		));

		$thb_works->addTaxonomy($thb_works_taxonomy);

		/**
		 * Add the post type to the theme instance.
		 */
		$thb_theme = thb_theme();
		$thb_theme->addPostType($thb_works);
	}
}

thb_works_post_type();

$thb_theme = thb_theme();

/**
 * Portfolio entries can be used as slides.
 */
if( !function_exists('thb_portfolio_slide_contents') ) {
	function thb_portfolio_slide_contents( $contents ) {
		$contents['works'] = __('Entries from the Portfolio', 'thb_text_domain');
		return $contents;
	}

	add_filter('thb_slideshow_contents', 'thb_portfolio_slide_contents');
}

/**
 * Metabox config
 * -----------------------------------------------------------------------------
 */
if( thb_config('core/portfolio', 'work_details') ) {
	if( !function_exists('thb_portfolio_add_work_details') ) {
		function thb_portfolio_add_work_details() {
			$thb_works = thb_theme()->getPostType('works');

			$thb_metabox = new THB_Metabox( __('Project details', 'thb_text_domain'), 'extra' );
			$thb_metabox->setPriority('high');

				$work_details = thb_config('core/portfolio', 'work_details');

				if( $work_details == 'text' ) {
					$thb_container = $thb_metabox->createContainer( '', 'details' );
						$field = new THB_TextareaField( 'prj_info' );
						$field->setHelp( __('Insert here your project details (Note: accepts basic HTML).', 'thb_text_domain') );
						$thb_container->addField($field);
				}
				elseif( $work_details == 'keyvalue' ) {
					$thb_container = $thb_metabox->createDuplicableContainer( '', 'details' );
						$thb_container->addControl( __('Add', 'thb_text_domain'), '' );

						$thb_upload = new THB_KeyValueField( 'prj_info' );
						$thb_upload->setLabel( __('Detail', 'thb_text_domain') );
						$thb_container->setField($thb_upload);
				}

			$thb_works->addMetabox($thb_metabox, array(), 0);
		}

		add_action( 'wp_loaded', 'thb_portfolio_add_work_details' );
	}
}

if( thb_config('core/portfolio', 'work_slides') ) {
	if( !function_exists('thb_works_slideshow_metabox') ) {
		function thb_works_slideshow_metabox() {
			$thb_theme = thb_theme();
			$thb_works = $thb_theme->getPostType('works');

			$thb_metabox = new THB_Metabox( __('Work images and videos', 'thb_text_domain'), 'portfolio_slides_config' );
			$thb_metabox->setPriority('high');

			if( thb_config('core/portfolio', 'work_slides_config') ) {
				$thb_metabox->addContainer( call_user_func(thb_config('core/portfolio', 'work_slides_config')) );
			}

			$thb_metabox->addContainer( thb_create_slideshows_slides_container( '', array(
				'slides_key' => thb_config('core/portfolio', 'work_slides_key')
			) ) );
			$thb_works->addMetabox($thb_metabox);
		}

		add_action( 'wp_loaded', 'thb_works_slideshow_metabox' );
	}
}