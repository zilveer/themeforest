<?php
/**
 * Bar shortcode
 */
class ctGraphCircleShortcode extends ctShortcode {

	/**
	 * Enqueue scripts
	 */

	public function enqueueScripts() {
		wp_register_script('jquery-easy-pie', CT_THEME_ASSETS . '/js/jquery.easy-pie-chart.js', array('jquery'));
		wp_enqueue_script('jquery-easy-pie');
	}

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Circle';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'graph_circle';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$percent = floatval($percent);
		$animate == floatval($animate);

		$size = (int)$size;
		$hasFontSize = $fontsize ? true : false;
		$hasVerPosition = $vertposition ? true : false;

		$fontsize = $hasFontSize ? $fontsize : ceil(($size / 10) * 2);

		//we try to fix position of icons
		if (!$hasVerPosition && $icon) {
			$vertposition = '-' . floor($size / 10 / 3);
			$hasVerPosition = true;
		}

		$verStyle = $hasVerPosition ? ' style="top:' . (int)$vertposition . 'px;"' : '';

		$text = '<span' . $verStyle . ' class="text">' . $text . '</span>';

		if ($icon) {
			$text = '<span' . $verStyle . '><i class="' . $icon . '"></i></span>';
			if (!$hasFontSize) {
				$fontsize *= 2;
			}
		}
		$scalecolor = $scalecolor ? $scalecolor : 'false';
		$trackacolor = $trackcolor ? $trackcolor : 'false';
		return '<div style="' . ($fontcolor ? 'color:' . esc_attr($fontcolor) . ';' : '') . 'font-size:' . esc_attr($fontsize) . 'px" class="graph-circle-' . ($icon ? 'icon' : 'text') . ' graph-circle-size-' . $size . ' graph-circle" data-percent="' . $percent . '" data-barcolor="' . esc_attr($barcolor) . '" data-trackcolor="' . esc_attr($trackcolor) . '" data-scalecolor="' . esc_attr($scalecolor) . '" data-linecap="' . esc_attr($linecap) . '" data-linewidth="' . esc_attr($linewidth) . '" data-size="' . esc_attr($size) . '" data-animate="' . esc_attr($animate) . '">' . $text . '</div>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'percent' => array('label' => __('percent', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __('in %', 'ct_theme')),
			'text' => array('label' => __("text inside circle", 'ct_theme'), 'help' => __('if icon selected, text will not be displayed', 'ct_theme')),
			'icon' => array('label' => __('entypo icon', 'ct_theme'), 'type' => "icon", 'default' => '', 'link' => CT_THEME_ASSETS . '/shortcode/awesome/index.html'),
			'barcolor' => array('label' => __('bar color', 'ct_theme'), 'default' => '#2db7ff', 'type' => 'colorpicker', 'help' => __('The color of the curcular bar.', 'ct_theme')),
			'trackcolor' => array('label' => __('track color', 'ct_theme'), 'default' => '#e6e6e6', 'type' => 'colorpicker', 'help' => __('The color of the track for the bar, leave it blank to disable rendering.', 'ct_theme')),
			'scalecolor' => array('label' => __('scale color', 'ct_theme'), 'default' => 'false', 'type' => 'colorpicker', 'help' => __('The color of the scale lines, leave it blank to disable rendering.', 'ct_theme')),

			'linecap' => array('label' => __('line cap', 'ct_theme'), 'default' => 'default', 'type' => "select", 'choices' =>
			array('butt' => __('button', 'ct_theme'), 'round' => __('round', 'ct_theme'), 'square' => __('square', 'ct_theme')),
				'help' => __('defines how the ending of the bar line looks like', 'ct_theme')
			),
			'linewidth' => array('label' => __("Width of the bar line", 'ct_theme'), 'default' => '15', 'help' => __('in px', 'ct_theme')),
			'size' => array('label' => __("size of chart", 'ct_theme'), 'default' => '170', 'help' => __('in px', 'ct_theme')),
			'fontsize' => array('label' => __("font/icon size", 'ct_theme'), 'default' => '', 'help' => __("in px.", 'ct_theme')),
			'fontcolor' => array('label' => __('font/icon color', 'ct_theme'), 'default' => '', 'type' => 'colorpicker'),
			'vertposition' => array('label' => "vertical position", 'default' => '0', 'help' => __('useful for positioning icons. Negative value will move content up, position down. Value in px.', 'ct_theme')),
			'animate' => array('label' => __('animation speed', 'ct_theme'), 'default' => '1000', 'help' => __('Time in milliseconds (1000 is 1 second) for a eased animation of the bar growing, or 0 to deactivate.', 'ct_theme')),
		);
	}
}

new ctGraphCircleShortcode();