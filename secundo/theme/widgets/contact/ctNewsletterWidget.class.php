<?php
require_once CT_THEME_LIB_WIDGETS.'/ctShortcodeWidget.class.php';

/**
 * Newsletter widget
 * @author hc
 */

class ctNewsletterWidget extends ctShortcodeWidget {
	/**
	 * Creates wordpress
	 */
	function __construct() {
		$widget_ops = array('classname' => 'widget_newsletter', 'description' => __('Displays newsletter form.', 'ct_theme'));
		parent::__construct('newsletter', 'CT - ' . __('Newsletter form', 'ct_theme'), $widget_ops);
	}

	/**
	 * Returns shortcode class
	 * @return mixed
	 */
	protected function getShortcodeName() {
		return 'newsletter';
	}
}

register_widget('ctNewsletterWidget');
