<?php
/**
 * Twitter Shortcode
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
class DFD_Twitter_Shortcode {
	
	public function __construct() {
		add_action( 'init', array( &$this, 'register_shortcode' ) );
	}
	
	public function register_shortcode() {
		add_shortcode('dfd_twitter_row', array(&$this, 'do_shortcode'));
	}
	
	public function do_shortcode($args, $content = null) {
		ob_start();
		
		require locate_template('/inc/shortcodes/view/twitter.php');
		
		return ob_get_clean();
	}
	
}

new DFD_Twitter_Shortcode();