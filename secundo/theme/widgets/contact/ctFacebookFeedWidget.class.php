<?php
require_once CT_THEME_LIB_WIDGETS.'/ctShortcodeWidget.class.php';

/**
 * Facebook feed widget
 * @author hc
 */

class ctFacebookFeedWidget extends ctShortcodeWidget {
	/**
	 * Creates wordpress
	 */
	function __construct() {
		$widget_ops = array('classname' => 'widget_fb', 'description' => __('Displays facebook posts.', 'ct_theme'));
		parent::__construct('fb', 'CT - ' . __('Facebook posts', 'ct_theme'), $widget_ops);
	}

	/**
	 * Returns shortcode class
	 * @return mixed
	 */
	protected function getShortcodeName() {
		return 'fb';
	}
}

register_widget('ctFacebookFeedWidget');
