<?php
/**
 * content Slider shortcode
 */
class ctContentSliderShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Content Slider';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'content_slider';
	}

	public function enqueueHeadScripts() {
		wp_register_style('ct-flexslider-style', CT_THEME_ASSETS . '/css/flexslider.css');
		wp_enqueue_style('ct-flexslider-style');
	}

	public function enqueueScripts() {
		wp_register_script('ct-flexslider', CT_THEME_ASSETS . '/js/jquery.flexslider-min.js');
		wp_enqueue_script('ct-flexslider');
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$id = rand(100, 1000);
		$slider = '<div class="flexslider" id="slider' . $id . '"><ul class="slides">' . $content . '</ul></div>';

		$this->addInlineJS($this->getInlineJS($id, $pause));
		return do_shortcode($slider);
	}

	/**
	 * returns JS
	 * @param $id
	 * @param $pause
	 * @return string
	 */
	protected function getInlineJS($id, $pause) {
		return 'jQuery(window).load(function() {
				        jQuery("#slider' . $id . '").flexslider({
				            animation:"slide",
				            controlNav:true,
				            useCSS: false,
				            directionNav:false,
				            smoothHeight:true,
				            slideshowSpeed:' . $pause . '
				        });
					});';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'pause' => array('label' => __('pause time', 'ct_theme'), 'default' => 5000, 'type' => 'input', 'help' => __('duration between slides change in miliseconds (1 sec = 1000 milisec)', 'ct_theme')),
		);
	}

	public function getChildShortcodeInfo() {
		return array('name' => 'content_slider_item', 'min' => 1, 'max' => 20, 'default_qty' => 3);
	}


}

new ctContentSliderShortcode();