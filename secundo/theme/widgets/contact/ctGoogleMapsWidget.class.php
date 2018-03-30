<?php
require_once CT_THEME_LIB_WIDGETS.'/ctShortcodeWidget.class.php';

/**
 * Google maps widget
 * @author alex/hc
 */

class ctGoogleMapsWidget extends ctShortcodeWidget {
	/**
	 * Creates wordpress
	 */
	function __construct() {
		$widget_ops = array('classname' => 'widget_google_maps', 'description' => __('Displays google maps.', 'ct_theme'));
		parent::__construct('google_maps', 'CT - ' . __('Google Maps', 'ct_theme'), $widget_ops);
	}

	/**
	 * Returns shortcode class
	 * @return mixed
	 */
	protected function getShortcodeName() {
		return 'google_maps';
	}
}

register_widget('ctGoogleMapsWidget');
