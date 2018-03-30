<?php
/**
 * Testimonials shortcode
 */
class ctTestimonialsShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Testimonials';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'testimonials';
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
		$atts = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);

		$id = rand(100, 1000);
		$testimonials = '<div class="flexslider simple" id="slider' . $id . '"><ul class="slides">' . do_shortcode($content) . '</ul></div>';

		$this->addInlineJS($this->getInlineJS($id, $atts));
		return do_shortcode($testimonials);
	}

	/**
	 * returns JS
	 * @param $id
	 * @param $atts
	 * @return string
	 */
	protected function getInlineJS($id, $atts) {
		$slideshow = 'false';
		$slideshowSpeed = 6000;
		if ($atts['slideshowspeed']) {
			$slideshow = 'true';
			$slideshowSpeed = $atts['slideshowspeed'];
		}

		$random = '0';
		if($atts['random'] == 'yes'){
			$random = 'Math.floor((Math.random()*jQuery("#slider' . $id . ' li").length))';
		}

		return 'jQuery(window).load(function() {
			        jQuery("#slider' . $id . '").flexslider({
			            animation:"slide",
			            controlNav:false,
			            startAt: '.$random.',
			            directionNav:true,
			            smoothHeight:true,
			            slideshowSpeed:'.$slideshowSpeed.',
			            slideshow: '.$slideshow.'
			        });
				});';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'slideshowspeed' => array('label' => __('slideshow speed', 'ct_theme'), 'default' => '0', 'type' => 'input', 'help' => __("How often should testimonials change slides? Value in ms ex. 5000 will change every 5 seconds.  Leave 0 to disable slideshow", 'ct_theme')),
			'random' => array('label' => __('start from random slide', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme'))),
		);
	}

	/**
	 * Returns child shortcode info
	 * @return string
	 */
	public function getChildShortcodeInfo() {
		return array('name' => 'testimonial', 'min' => 1, 'max' => 20, 'default_qty' => 3);
	}


}

new ctTestimonialsShortcode();