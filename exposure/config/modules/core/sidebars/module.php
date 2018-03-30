<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Sidebars.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Sidebars
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
	 * Enable the creation of a duplicable fields container in the corresponding
	 * tab of the main options page.
	 */
	'duplicable' => true,

	/**
	 *
	 */
	'templates' => array(
		'default'
	)
);
$thb_theme->setConfig('core/sidebars', thb_array_asum($thb_config, $config));

/**
 * Load custom post type operations
 * -----------------------------------------------------------------------------
 */
include dirname(__FILE__) . '/posttype.php';

/**
 * Custom body classes
 * -----------------------------------------------------------------------------
 */
if( !function_exists('sidebars_body_classes') ) {
	function sidebars_body_classes( $classes ) {
		$entry_id = thb_get_page_ID();

		if( $entry_id != 0 ) {
			$is_sidebar_page = in_array( thb_get_page_template($entry_id), thb_config('core/sidebars', 'templates') ) || is_single();

			if( $is_sidebar_page ) {
				$sidebar = thb_get_post_meta($entry_id, 'sidebar');

				if( $sidebar != '0' && is_active_sidebar($sidebar) ) {
					$classes[] = 'w-sidebar';

					// Checking the sidebar position
					$position = thb_get_post_meta($entry_id, 'sidebar_position');
					$classes[] = $position;
				}
			}
		}
		else {
			if( !is_archive() && !is_search() && !is_404() ) {
				if( is_active_sidebar('post-sidebar') ) {
					$classes[] = 'w-sidebar';
				}
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'sidebars_body_classes' );
}

/**
 * Dynamic sidebars options
 * -----------------------------------------------------------------------------
 */
if( thb_config('core/sidebars', 'options') ) {
	$thb_options_page = thb_theme()->getAdmin()->getMainPage();
	$thb_tab = new THB_Tab( __('Sidebars', 'thb_text_domain'), 'sidebars' );
	$thb_options_page->addTab($thb_tab, 2);

	if( thb_config('core/sidebars', 'duplicable') ) {
		$thb_tab = $thb_options_page->getTab('sidebars');

		$thb_container = $thb_tab->createDuplicableContainer( __('Sidebars', 'thb_text_domain'), 'sidebars' );

		$thb_container->addControl( __('Add new sidebar', 'thb_text_domain'), '');
		$thb_container->setSortable();

		$thb_field = new THB_TextField(THB_DUPLICABLE_SIDEBARS);
		$thb_field->setLabel( __('Name', 'thb_text_domain') );
		$thb_container->setField($thb_field);
	}
}