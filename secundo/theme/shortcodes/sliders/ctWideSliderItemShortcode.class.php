<?php
/**
 * Wide Slider Item shortcode
 */
class ctWideSliderItemShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Wide Slider Item';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'wide_slider_item';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		//header
		$subheaderHtml = $subheader ? ('<span>' . $subheader . '</span>') : '';
		$subheaderHtml = ($header && $subheader) ? ('<br>' . $subheaderHtml) : $subheaderHtml;
		$headerHtml = $header . $subheaderHtml;

		//button
		$buttonHtml = $buttontext ? ('<div class="sliderBtn"><a href="' . $link . '" class="btn vorange vbig">' . $buttontext . '</a></div>') : '';

		$img = '[img src="' . $imgsrc . '" alt=" " width="1200" height="450"]';
		if ($imagelink) {
			$img = '<a href="' . $imagelink . '">' . $img . '</a>';
		}

		$slider = '<li><h2 class="sliderHeader">' . $headerHtml . '</h2>' . $buttonHtml . $img . '</li>';

		return do_shortcode($slider);
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'imgsrc' => array('label' => __("source", 'ct_theme'), 'default' => '', 'type' => 'image', 'help' => __("Image", 'ct_theme')),
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'subheader' => array('label' => __('subheader', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Subheader text", 'ct_theme')),
			'buttontext' => array('label' => __('button text', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Button text", 'ct_theme')),
			'link' => array('label' => __('button link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Button link", 'ct_theme')),
			'imagelink' => array('label' => __('background image link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Optional link for background image", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
		);
	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'wide_slider';
	}
}

new ctWideSliderItemShortcode();