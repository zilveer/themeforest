<?php

class WPV_Price {
	public function __construct() {
		add_shortcode('price', array(&$this, 'price'));
	}

	public function price($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'text_align' => 'justify',
			'price' => '69',
			'currency' => '$',
			'duration' => 'per month',
			'summary' => '',
			'price_size' => '',
			'price_background' => '',
			'price_color' => '',
			'title' => 'title',
			'title_background' => '',
			'title_color' => '',
			'title_size' => '18',
			'description' => '<ul>
	<li>list item</li>
	<li>list item</li>
	<li>list item</li>
	<li>list item</li>
	<li>list item</li>
	<li>list item</li>
</ul>',
			'description_background' => '',
			'description_color' => '',
			'button_text' => 'Buy',
			'button_link' => '',
			'featured' => 'false',
		), $atts));
		
		ob_start();

		include(locate_template('templates/shortcodes/price.php'));

		return ob_get_clean();
	}
}

new WPV_Price;
