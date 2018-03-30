<?php
/**
 * Wide Slider shortcode
 */
class ctWideSliderShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Wide Slider';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'wide_slider';
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
		$slider = '<div class="patStd nomrg">
					    <div class="flexslider full" id="slider' . $id . '">
					        <ul class="slides">' . $content . '</ul>
					        <div class="pagesNr"><span class="nr1">1</span><span>' . __('of', 'ct_theme') . '</span><span class="nr2"></span></div>
					    </div>
					</div>';

		$this->addInlineJS($this->getInlineJS($id, $pause, $animationspeed));
		return do_shortcode($slider);
	}

	/**
	 * returns JS
	 * @param $id
	 * @param $pause
	 * @param $animationspeed
	 * @return string
	 */
	protected function getInlineJS($id, $pause, $animationspeed) {
		return 'jQuery(window).load(function() {
						jQuery("#slider' . $id . '").flexslider({
				            animation:"slide",
				            controlNav:false,
				            smoothHeight:true,
				            slideshowSpeed: ' . $pause . ',
				            animationSpeed: ' . (int)$animationspeed . ',
				            start:function (slider) {
				                jQuery(".nr2").text(slider.count);
				            },
				            after:function (slider) {
				                jQuery(".nr1").text(slider.currentSlide + 1);
				            }
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
			'animationspeed' => array('label' => __("animation speed", 'ct_theme'), 'default' => 600, 'type' => "input", 'help' => __('animation duration in miliseconds (1 sec = 1000 milisec)', 'ct_theme')),
		);
	}

	public function getChildShortcodeInfo() {
		return array('name' => 'wide_slider_item', 'min' => 1, 'max' => 20, 'default_qty' => 3);
	}


}

new ctWideSliderShortcode();