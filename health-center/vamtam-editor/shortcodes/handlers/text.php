<?php

class WPV_Text {
	public function __construct() {
		add_shortcode('text', array(&$this, 'dispatch'));
	}

	public function dispatch($atts, $content, $code) {
		extract(shortcode_atts(array(
		), $atts));

		return do_shortcode($content);
	}
};

new WPV_Text;
