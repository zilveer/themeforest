<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Lightbox.
 * Prettyphoto implementation.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Lightbox\prettyPhoto
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
	 * Enable the use of a custom skin.
	 */
	'skin' => false
);
$thb_theme->setConfig('core/lightbox/submodules/prettyPhoto', thb_array_asum($thb_config, $config));

$lightbox_enable = thb_config('core/lightbox/submodules/prettyPhoto', 'options') == false || thb_get_option('enable_lightbox_images') == 1 || thb_get_option('enable_lightbox_videos') == 1;

/**
 * Module scripts
 * -----------------------------------------------------------------------------
 */
if( $lightbox_enable ) {
	$thb_lightbox = thb_get_module_url('core/lightbox/submodules/prettyPhoto');

	if( thb_config('core/lightbox/submodules/prettyPhoto', 'skin') == false ) {
		$thb_theme->getFrontend()->addStyle( $thb_lightbox . '/css/prettyPhoto.css' );
	}

	$thb_theme->getFrontend()->addScript( $thb_lightbox . '/js/jquery.prettyPhoto.js' );

	if( thb_get_option('enable_lightbox_images') == 1 ) {
		$thb_theme->getFrontend()->addScript( $thb_lightbox . '/js/thb.lightbox.config_images.js' );
	}

	if( thb_get_option('enable_lightbox_videos') == 1 ) {
		$thb_theme->getFrontend()->addScript( $thb_lightbox . '/js/thb.lightbox.config_videos.js' );
	}

	$thb_theme->getFrontend()->addScript( $thb_lightbox . '/js/thb.lightbox.js' );
}

/**
 * Theme options tab
 * -----------------------------------------------------------------------------
 */
if( thb_config('core/lightbox/submodules/prettyPhoto', 'options') ) {
	$thb_page = $thb_theme->getAdmin()->getMainPage();

	$thb_tab = new THB_Tab( __('Lightbox', 'thb_text_domain'), 'lightbox' );
		$thb_container = $thb_tab->createContainer( '', 'lightbox_options' );
		$thb_container->setIntroText( __('Powered by PrettyPhoto. If you mind to use another plugin, you might want to disable this feature.', 'thb_text_domain') );

		$thb_field = new THB_CheckboxField( 'enable_lightbox_images' );
			$thb_field->setLabel( __('Enable lightbox for images', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_CheckboxField( 'enable_lightbox_videos' );
			$thb_field->setLabel( __('Enable lightbox for links to video pages and files', 'thb_text_domain') );
		$thb_container->addField($thb_field);

	$thb_page->addTab($thb_tab);
}