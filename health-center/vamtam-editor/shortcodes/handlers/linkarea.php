<?php

class WPV_Linkarea {
	public function __construct() {
		add_shortcode('linkarea', array(&$this, 'linkarea'));
	}

	public function linkarea($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'href' => '',
			'image' => '',
			'icon' => '',
			'icon_size' => '62',
			'icon_color' => 'accent6',
			'target' => '',
			'class' => '',
			'background_color' => '',
			'hover_color' => 'accent1',
			'hoverclass' => '',
			'activeclass' => '',
			'style' => ''
		), $atts));
		
		$content = trim($content);

		ob_start();

		include(locate_template('templates/shortcodes/linkarea.php'));

		return ob_get_clean();
	}
}

new WPV_Linkarea;
