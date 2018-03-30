<?php
require_once CT_THEME_LIB_WIDGETS.'/ctShortcodeWidget.class.php';

/**
 * Twitter widget
 * @author hc
 */

class ctTwitterWidget extends ctShortcodeWidget {
	/**
	 * Creates wordpress
	 */
	function __construct() {
		$widget_ops = array('classname' => 'widget_twitter', 'description' => __('Displays twitter news.', 'ct_theme'));
		parent::__construct('twitter', 'CT - ' . __('Twitter news', 'ct_theme'), $widget_ops);
	}

	/**
	 * Returns shortcode class
	 * @return mixed
	 */
	protected function getShortcodeName() {
		return 'twitter';
	}
}

register_widget('ctTwitterWidget');
