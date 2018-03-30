<?php

class WPV_Contact_Info {
	public function __construct() {
		add_shortcode('contact_info', array(&$this, 'contact_info'));
	}

	public function contact_info($atts) {
		extract(shortcode_atts(array(
			'color' => 'accent2',
			'phone' => '',
			'cellphone' => '',
			'email' => '',
			'address' => '',
			'name' => '',
		), $atts));

		ob_start();

		include(locate_template('templates/shortcodes/contact_info.php'));

		return ob_get_clean();
	}
}

new WPV_Contact_Info;