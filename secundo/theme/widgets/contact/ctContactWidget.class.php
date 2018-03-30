<?php
require_once CT_THEME_LIB_WIDGETS.'/ctShortcodeWidget.class.php';

/**
 * Contact widget
 * @author hc
 */

class ctContactWidget extends ctShortcodeWidget {
	/**
	 * Creates wordpress
	 */
	function __construct() {
		$widget_ops = array('classname' => 'widget_contact', 'description' => __('Displays contact details.', 'ct_theme'));
		parent::__construct('contact', 'CT - ' . __('Contact', 'ct_theme'), $widget_ops);
	}

	/**
	 * Returns shortcode class
	 * @return mixed
	 */
	protected function getShortcodeName() {
		return 'contact';
	}
}

register_widget('ctContactWidget');
