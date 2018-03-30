<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Sidebars custom post types operations.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Slideshow
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( ! function_exists('thb_sidebars_metabox_container') ) {
	/**
	 * Create the sidebar management metabox fields container.
	 *
	 * @param string $post_type The post type.
	 * @return void
	 */
	function thb_sidebars_metabox_container( $post_type=null ) {
		$thb_container = new THB_MetaboxFieldsContainer( __('Page sidebar', 'thb_text_domain'), 'sidebar_config' );

			$field = new THB_SelectField( 'sidebar' );
			$field->setLabel( __('Sidebar to display', 'thb_text_domain') );
			$field->setOptions(array(
				0 => __('No sidebar', 'thb_text_domain')
			));
			$field->setDynamicOptions('thb_get_sidebars_for_select');

			if( $post_type ) {
				$field->setDynamicDefault('thb_get_post_type_sidebar', $post_type);
			}

			$thb_container->addField($field);

			$field = new THB_SelectField( 'sidebar_position' );
			$field->setLabel( __('Position', 'thb_text_domain') );
			$field->setOptions(array(
				'sidebar-right' => __('Right', 'thb_text_domain'),
				'sidebar-left' => __('Left', 'thb_text_domain')
			));
			$thb_container->addField($field);

		return $thb_container;
	}
}

/**
 * Create the sidebar management metabox.
 *
 * @param string $post_type The post type.
 * @return void
 */
if( !function_exists('thb_sidebars_metabox') ) {
	function thb_sidebars_metabox( $post_type=null ) {
		$thb_theme = thb_theme();
		// $thb_post_type = $thb_theme->getPostType($post_type);

		$thb_metabox = new THB_Metabox( __('Sidebar', 'thb_text_domain'), 'sidebar' );
		$thb_metabox->setPosition('side');
			$thb_container = thb_sidebars_metabox_container($post_type);
		$thb_metabox->addContainer($thb_container);

		// $thb_post_type->addMetabox($thb_metabox);
		return $thb_metabox;
	}
}

$thb_theme = thb_theme();

/**
 * Pages and posts metabox
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_add_sidebar_metabox') ) {
	function thb_add_sidebar_metabox() {
		$thb_theme = thb_theme();
		// $thb_posts = $thb_theme->getPostType('post');
		// $thb_pages = $thb_theme->getPostType('page');
		// $thb_posts->addMetabox( thb_sidebars_metabox('post') );

		foreach( thb_config('core/sidebars', 'templates') as $template ) {
			if( thb_is_admin_template($template) ) {
				$post_type = thb_get_post_type_from_template($template);
				$thb_metabox = $thb_theme->getPostType($post_type)->getMetabox('layout');

				if( $thb_metabox ) {
					$thb_metabox->addContainer( thb_sidebars_metabox_container( $post_type ) );
				}
			}
		}

		// $thb_pages->addMetaboxToPages( thb_sidebars_metabox(), thb_config('core/sidebars', 'templates') );
		// $thb_pages->addMetabox( thb_sidebars_metabox(), thb_config('core/sidebars', 'templates') );
	}

	add_action('init', 'thb_add_sidebar_metabox');
}