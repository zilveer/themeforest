<?php

/**
 * Expandable services shortcode handler
 *
 * @package wpv
 */

class WPV_Expandable {
	/**
	 * Register the shortcodes
	 */
	public function __construct() {
		add_shortcode('services_expandable', array(__CLASS__, 'shortcode'));
	}

	/**
 	 * Expandable services shortcode callback
	 * 
	 * @param  array  $atts    shortcode attributes
	 * @param  string $content shortcode content
	 * @param  string $code    shortcode name
	 * @return string          output html
	 */
	public static function shortcode($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'image' => '',
			'icon' => 'apple',
			'icon_color' => 'accent6',
			'icon_size' => 62,
			'class' => '',
			'background' => 'accent1',
			'hover_background' => 'accent2',
		), $atts));

		if(empty($content)) {
			$content = 
				__('This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit.', 'health-center') . '[split]' .
				__('This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit.', 'health-center');
		}

		$before = '';
		$content = explode('[split]', $content, 2);
		if(count($content) > 1)
			$before = array_shift($content);
		$content = implode(' ', $content);
		
		ob_start();

		include(locate_template('templates/shortcodes/services_expandable.php'));

		return ob_get_clean();
	}
}

new WPV_Expandable;