<?php
/**
 * Logo Slider shortcode
 */
class ctLogoSliderShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Logo slider';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'logo_slider';
	}

	/**
	 * Registers scripts
	 */

	public function enqueueScripts() {
		wp_register_script('ct-flex-slider', CT_THEME_ASSETS . '/js/jquery.flexslider-min.js');
		wp_enqueue_script('ct-flex-slider');
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		$attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
		extract($attributes);

		$this->addInlineJS($this->getInlineJS($attributes));
		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('flexCarousel')),$atts).'><div class="flexslider"><ul class="slides">' . $content . '</ul></div></div>');
	}

	/**
	 * returns inline js
	 * @param $atts
	 */
	protected function getInlineJS($atts) {
		extract($atts);

		return 'function carouselFlexsliderInit() {
		    jQuery(".flexCarousel .flexslider").flexslider({
		        animation: "slide",
		        animationLoop: ' . $loop . ',
		        slideshow: false,
		        itemWidth: ' . $itemwidth . ',                   //{NEW} Integer: Box-model width of individual carousel items, including horizontal borders and padding.
		        minItems: ' . $minitems . ',                    //{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
		        maxItems: ' . $maxitems . ',                    //{NEW} Integer: Maxmimum number of carousel items that should be visible. Items will resize fluidly when above this limit.
		        move: ' . $move . ',                        //{NEW} Integer: Number of carousel items that should move on animation. If 0, slider will move all visible items.
		        controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		        directionNav: ' . $nav . '
		    });
		}


		jQuery(window).load(function () {
		    carouselFlexsliderInit();
		});
		';
	}

	/**
	 * Returns child shortcode info
	 * @return ctShortcode
	 */
	public function getChildShortcodeInfo() {
		return array('name' => 'logo_slider_item', 'min' => 1, 'max' => 20, 'default_qty' => 2);
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		//animationLoop: true,

		return array(
			'itemwidth' => array('label' => __('item width', 'ct_theme'), 'default' => 216, 'type' => 'input', 'help' => __('Single logo container width', 'ct_theme')),
			'minitems' => array('label' => __('minimum items', 'ct_theme'), 'default' => 1, 'type' => 'input', 'help' => __('Minimum number of items that should be visible', 'ct_theme')),
			'maxitems' => array('label' => __('maximum items', 'ct_theme'), 'default' => 4, 'type' => 'input', 'help' => __('Maxmimum number of items that should be visible', 'ct_theme')),
			'move' => array('label' => __('move items', 'ct_theme'), 'default' => 1, 'type' => 'input', 'help' => __('Number of items that should move on animation. If 0, slider will move all visible items.', 'ct_theme')),
			'nav' => array('label' => __('navigation', 'ct_theme'), 'default' => 'true', 'type' => 'select', 'choices' => array("true" => __("true", 'ct_theme'), "false" => __("false", 'ct_theme')), 'help' => __("Display navigation?",'ct_theme')),
			'loop' => array('label' => __('loop animation', 'ct_theme'), 'default' => 'true', 'type' => 'select', 'choices' => array("true" => __("true", 'ct_theme'), "false" => __("false", 'ct_theme')), 'help' => __("Loop animation?",'ct_theme')),
		);
	}
}

new ctLogoSliderShortcode();