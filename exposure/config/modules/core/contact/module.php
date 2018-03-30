<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Contact.
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

$thb_theme = thb_theme();
$thb_theme_frontend = $thb_theme->getFrontend();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * Enable the creation of an option fields container in the main options page.
	 */
	'options' => true,

	/**
	 * Enable the creation of a set of options to manage a map component.
	 */
	'map' => true,

	/**
	 * Enable the use of placeholders for input fields.
	 */
	'placeholder' => true,

	/**
	 * Enable the creation of duplicable fields.
	 */
	'duplicable_fields' => false
);
$thb_theme->setConfig('core/contact', thb_array_asum($thb_config, $config));

include "lib.php";

/**
 * Theme options
 * -----------------------------------------------------------------------------
 */
if( thb_config('core/contact', 'options') ) {
	$thb_page = $thb_theme->getAdmin()->getMainPage();

	$thb_tab = new THB_Tab( __('Contact', 'thb_text_domain'), 'contact' );
	$thb_page->addTab($thb_tab);

		if( thb_config('core/contact', 'duplicable_fields') ) {
			$thb_container = $thb_tab->createDuplicableContainer( __('Contact informations', 'thb_text_domain'), 'contact_data' );
				$thb_container->addControl( __('Add', 'thb_text_domain'), '' );
				$thb_container->setSortable();

				$thb_upload = new THB_ContactInfoField( 'contact_info' );
				$thb_upload->setLabel( __('Contact information', 'thb_text_domain') );
				$thb_container->setField($thb_upload);
		}

		$thb_container = $thb_tab->createContainer( __('Contact form', 'thb_text_domain'), 'contact_form_data' );

		$thb_field = new THB_TextField('contact_email');
			$thb_field->setLabel( __('Email address', 'thb_text_domain') );
			$thb_field->setHelp( __('Emails from the website\'s contact form will be sent to this address.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		if( thb_config('core/contact', 'map') ) {
			$thb_container = $thb_tab->createContainer( __('Map', 'thb_text_domain'), 'contact_map_data' );

			$thb_field = new THB_TextField('contact_marker');
				$thb_field->setLabel( __('Map marker text', 'thb_text_domain') );
				$thb_field->setHelp( __('Adding text to the map pin will make it pop up when clicking on it.', 'thb_text_domain') );
			$thb_container->addField($thb_field);

			$thb_field = new THB_TextField('contact_lat_long');
				$thb_field->setLabel( __('Map latitude and longitude', 'thb_text_domain') );
				$thb_field->setHelp( sprintf( __('Insert the latitude and longitude for the Google Map (eg. 44.422, 8.937) in a contact page. Trouble? <a href="%s" target="_blank">Get them here</a>.', 'thb_text_domain'), 'http://itouchmap.com/latlong.html' ) );
			$thb_container->addField($thb_field);

			$thb_field = new THB_NumberField('contact_zoom');
				$thb_field->setLabel( __('Map zoom', 'thb_text_domain') );
				$thb_field->setHelp( __('A reasonable value ranges from 6 to 16; if left blank, the default value will be 10.', 'thb_text_domain') );
			$thb_container->addField($thb_field);
		}
}

/**
 * Frontend helpers
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_contact_map') ) {
	function thb_contact_map( $params=array() ) {
		$latlong = thb_get_option('contact_lat_long');
		$zoom = thb_get_option("contact_zoom");
		$marker = thb_get_option("contact_marker");

		$map_config = array(
			'height' => '500'
		);
		$map_config = thb_array_asum($map_config, $params);

		if( $latlong != '' ) {
			echo thb_do_shortcode("[thb_map latlong='$latlong' zoom='$zoom' " . thb_get_attributes($map_config) . " marker='$marker']");
		}
	}
}

/**
 * Display the contact form.
 *
 * @return void
 */
function thb_contact_form() {
	thb_get_module_template_part('core/contact', 'contact-form', array(
		'placeholder' => thb_config('core/contact', 'placeholder')
	));
}