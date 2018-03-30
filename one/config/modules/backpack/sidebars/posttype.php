<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Sidebars custom post types operations.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\Sidebars
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( ! function_exists('thb_sidebars_metabox_container') ) {
	/**
	 * Create the sidebar management metabox fields container.
	 *
	 * @param string $post_type The post type.
	 * @return THB_MetaboxFieldsContainer
	 */
	function thb_sidebars_metabox_container( $post_type = null ) {
		$thb_container = new THB_MetaboxFieldsContainer( '', 'sidebar_config' );

			$field = new THB_SelectField( 'sidebar' );
			$field->setLabel( __('Sidebar', 'thb_text_domain') );
			$field->setOptions( thb_get_sidebars_for_select() );

			if( $post_type ) {
				$field->setDefault( thb_get_post_type_sidebar( $post_type ) );
			}

			$thb_container->addField($field);

			if( thb_config('backpack/sidebars', 'sidebar_position') ) {

				$field = new THB_SelectField( 'sidebar_position' );
				$field->setLabel( __('Position', 'thb_text_domain') );
				$field->setOptions(array(
					'sidebar-right' => __('Right', 'thb_text_domain'),
					'sidebar-left' => __('Left', 'thb_text_domain')
				));
				$thb_container->addField($field);

			}

		return $thb_container;
	}
}

$thb_theme = thb_theme();

/**
 * Pages and posts metabox
 * -----------------------------------------------------------------------------
 */
if( ! function_exists( 'thb_add_sidebar_metabox' ) ) {
	function thb_add_sidebar_metabox() {
		$thb_theme = thb_theme();
		$thb_posts = $thb_theme->getPostType( 'post' );

		foreach( thb_config( 'backpack/sidebars', 'templates' ) as $template ) {
			if( thb_is_admin_template( $template ) ) {
				$post_type = thb_get_post_type_from_template($template);

				$thb_metabox = $thb_theme->getPostType($post_type)->getMetabox( 'layout' );
				if( $thb_metabox ) {
					$thb_tab = $thb_metabox->createTab( __( 'Sidebar', 'thb_text_domain' ), 'sidebars' );
					$thb_tab->setIcon( 'editor-ul' );
					$thb_tab->addContainer( thb_sidebars_metabox_container( thb_get_post_type_from_template( $template ) ) );
				}
			}
		}
	}

	add_action( 'wp_loaded', 'thb_add_sidebar_metabox' );
}