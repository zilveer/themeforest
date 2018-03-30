<?php
require_once CT_THEME_LIB_WIDGETS.'/ctShortcodeWidget.class.php';

/**
 * Flickr widget
 * @author hc
 */

class ctFlickrWidget extends ctShortcodeWidget {
	/**
	 * Creates wordpress
	 */
	function __construct() {
		$widget_ops = array('classname' => 'widget_flickr', 'description' => __('Displays Flickr photostream.', 'ct_theme'));
		parent::__construct('flickr', 'CT - ' . __('Flickr photostream', 'ct_theme'), $widget_ops);
	}

	/**
	 * Returns shortcode class
	 * @return mixed
	 */
	protected function getShortcodeName() {
		return 'flickr';
	}
}

register_widget('ctFlickrWidget');
