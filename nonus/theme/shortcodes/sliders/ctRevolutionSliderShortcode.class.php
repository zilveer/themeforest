<?php
/**
 * Revolution slider integration
 * @author alex
 */

class ctRevolutionSliderShortcode extends ctShortcode {

	/**
	 * Returns shortcode label
	 * @return mixed
	 */
	public function getName() {
		return 'Revolution slider';
	}

	/**
	 * Returns shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'rev_slider';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return mixed
	 */
	public function handle($atts, $content = null) {
		if ($callback = $this->getOverwrittenCallback()) {
			$s = call_user_func($callback, $atts, $content);
		}

		if (array_key_exists(0, $atts)) {
			if ($slider = $this->getSlider($atts[0])) {
				//we need to check is it full screen - if so, we will wrap it
				$e = json_decode($slider->params);
				if (isset($e->slider_type) && $e->slider_type == 'fullwidth') {
					$s = do_shortcode('[full_width]' . $s . '[/full_width]');
				}
			}
		}

		return $s;
	}

	/**
	 * Returns config
	 * @return array
	 */
	public function getAttributes() {
		return array('_arg' => array(
			'label' => __('Revolution Slider', 'ct_theme'), 'default' => '', 'type' => 'select', 'callback' => array($this, 'getSliderOptions'), 'help' => "Select previously created Revolution Slider")
		);
	}

	/**
	 * Return slider info
	 * @param $alias
	 */
	protected function getSlider($alias) {
		$name = GlobalsRevSlider::$table_sliders;
		global $wpdb;
		return $wpdb->get_row($wpdb->prepare(
			"SELECT * FROM " . $name . ' WHERE alias = %s LIMIT 1', $alias
		));
	}

	/**
	 * Returns available rev slider options
	 * @param $name
	 * @param $options
	 * @return array
	 */

	public function getSliderOptions($name, $options) {
		$options = array();
		$name = GlobalsRevSlider::$table_sliders;
		global $wpdb;
		$rows = $wpdb->get_results("SELECT title, alias FROM " . $name);
		foreach ($rows as $row) {
			$options[$row->alias] = $row->title . ' (' . $row->alias . ')';
		}
		return $options;
	}

}

//init only if rev slider available
if (class_exists('GlobalsRevSlider')) {
	new ctRevolutionSliderShortcode();
}
