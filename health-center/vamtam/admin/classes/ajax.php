<?php

/**
 * Basic ajax class
 *
 * @package wpv
 */

/**
 * class WpvAjax
 */
class WpvAjax {
	/**
	 * Hook ajax actions
	 */
	public function __construct() {
		foreach ( $this->actions as $hook => $func ) {
			add_action( 'wp_ajax_wpv-'.$hook, array( &$this, $func ) );
		}
	}
}