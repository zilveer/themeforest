<?php

class WPV_Services {
	public function __construct() {
		add_shortcode('services', array(&$this, 'services'));
	}

	public function services($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'text_align' => 'justify',
			'background' => 'accent1',
			'icon' => 'apple',
			'icon_color' => 'accent6',
			'icon_size' => '62',
			'image' => '',
			'title' => 'This is a title',
			'title_size' => '',
			'description_size' => '',
			'button_text' => 'Learn More',
			'button_link' => '/',
			'fullimage' => 'true',
			'class' => '',
		), $atts));

		ob_start();

		include(locate_template('templates/shortcodes/services.php'));

		return ob_get_clean();
	}
}

new WPV_Services;
