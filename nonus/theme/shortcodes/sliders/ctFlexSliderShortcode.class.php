<?php
/**
 * Flex Slider shortcode
 */
class ctFlexSliderShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Flex Slider';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'flex_slider';
	}

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
		$id = rand(100,1000);
		$this->addInlineJS($this->getInlineJS($attributes, $id));

		$fullHtml = $fullheight == "true" ? 'flexFull' : '';
		$cParams = array(
			'id'=>'flexslider'.$id,
			'class'=>array('post-media','flexslider',$fullHtml)
		);
		return do_shortcode('<div'.$this->buildContainerAttributes($cParams,$atts).'>
						            <div class="sliderBox">
						                <div class="navFlexFull">

						                </div>
						                <!-- / navFlexFull -->
						            </div>
						          <ul class="slides">'
									. $content .
								  '</ul>
				                  </div>
				                  <!-- / flexFull -->');
	}

	/**
	 * returns JS
	 * @param $id
	 * @return string
	 */
	protected function getInlineJS($attributes, $id) {
		extract($attributes);

		return 'jQuery(window).load(function () {
				    jQuery("#flexslider' . $id . '").flexslider({
				        animation: "' . $effect . '",              //String: Select your animation type, "fade" or "slide"
				        easing: "swing",               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
				        // easing types :
				        // swing, easeInQuad, easeOutQuad, easeInOutQuad, easeInCubic, easeOutCubic,
				        // easeInOutCubic, easeInQuart, easeOutQuart, easeInOutQuart, easeInQuint,
				        // easeOutQuint, easeInOutQuint, easeInSine, easeOutSine, easeInOutSine,
				        // easeInExpo, easeOutExpo, easeInOutExpo, easeInCirc, easeOutCirc,
				        // easeInOutCirc, easeInElastic, easeOutElastic, easeInOutElastic, easeInBack,
				        // easeOutBack, easeInOutBack, easeInBounce, easeOutBounce, easeInOutBounce
				        direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
				        reverse: false,                 //{NEW} Boolean: Reverse the animation direction
				        animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				        smoothHeight: true,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
				        startAt: 0,                     //Integer: The slide that the slider should start on. Array notation (0 = first slide)
				        slideshow: true,                //Boolean: Animate slider automatically
				        slideshowSpeed: ' . $pause . ',           //Integer: Set the speed of the slideshow cycling, in milliseconds
					    animationSpeed: ' . $animspeed . ',           //Integer: Set the speed of animations, in milliseconds
				        initDelay: 0,                   //{NEW} Integer: Set an initialization delay, in milliseconds
				        randomize: false,               //Boolean: Randomize slide order

				        // Primary Controls
				        controlNav: ' . $controlnav . ',               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				        directionNav: ' . $dirnav . ',             //Boolean: Create navigation for previous/next navigation? (true/false)

				        // Usability features
				        pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements highly recommended
				        pauseOnHover: true,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
				        touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
				        video: true,                   //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
				        useCSS: false,                   //{NEW} Boolean: Slider will use CSS3 transitions if available


				        // Secondary Navigation
				        keyboard: true,                 //Boolean: Allow slider navigating via keyboard left/right keys
				        multipleKeyboard: false,        //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
				        mousewheel: false,              //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
				        controlsContainer: "#flexslider' . $id . ' .sliderBox .navFlexFull",


				        // Callback API
				        start: function () {
				            jQuery(".flexslider.flexFull").removeClass("loading-slider");

				        }
				    });
				});

				/* adjusting mainslider */
				jQuery(document).ready(function () {
				    var navHeight = jQuery(".navbar-inner").height();
				    jQuery(".flexFull.flexslider .sliderDesc, .flexFull.flexslider .sliderBox").css("margin-top", navHeight);
				    jQuery(".flexFull.flexslider").css("margin-top", -navHeight);
				});';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'effect' => array('label' => __('effect', 'ct_theme'), 'default' => 'fade', 'type' => 'select', 'choices' => array("slide" => "slide", "fade" => "fade"), 'help' => __("Slider effect", 'ct_theme')),
			'pause' => array('label' => __('pause time', 'ct_theme'), 'default' => 7000, 'type' => 'input', 'help' => __('how long each slide will show in miliseconds (1 sec = 1000 milisec)', 'ct_theme')),
			'animspeed' => array('label' => __('animation speed', 'ct_theme'), 'default' => 800, 'type' => 'input', 'help' => __('slide transition speed in miliseconds (1 sec = 1000 milisec)', 'ct_theme')),
			'controlnav' => array('label' => __('show control navigation', 'ct_theme'), 'default' => 'true', 'type' => 'select', 'choices' => array("true" => __("true", "ct_theme"), "false" => __("false", "ct_theme"))),
			'fullheight' => array('label' => __('full height slider ?', 'ct_theme'), 'default' => 'true', 'type' => 'checkbox', 'help' => __("true / false", 'ct_theme')),
			'dirnav' => array('label' => __('show direction navigation', 'ct_theme'), 'default' => 'true', 'type' => 'select', 'choices' => array("true" => __("true", "ct_theme"), "false" => __("false", "ct_theme"))),
		);
	}

	public function getChildShortcodeInfo() {
		return array('name' => 'flex_slider_item', 'min' => 1, 'max' => 20, 'default_qty' => 3);
	}


}

new ctFlexSliderShortcode();