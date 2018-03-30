<?php

/**
 * Full Width video
 */
class ctFullscreenVideoShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Fullwidth video';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'fullscreen_video';
	}

	public function enqueueScripts() {
		wp_register_script('ct-fitvids', CT_THEME_ASSETS . '/js/jquery.fitvids.js', array('jquery'));
		wp_enqueue_script('ct-fitvids');
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
		$id = 'full_video_' . rand(100, 1000);
		$this->addInlineJS($this->getInlineJS($id, $attributes));

		if ($content) {
			$content = '<div class="videoOverlay">
							<div class="main-header">' . $content . '</div>
					    </div>';
		}


		//disable width/height params
		$atts['fullscreen'] = 1;

		$cParams = array(
				'id' => $id,
				'class' => array('height100', 'videoContainer'),
				'style' => $imgsrc ? 'background-image:url(' . esc_attr($imgsrc) . ')' : ''
		);
		return '<div' . $this->buildContainerAttributes($cParams, $atts) . '>' . do_shortcode($content . $this->embedShortcode('video', $atts)) . '</div>';
	}

	/**
	 * returns inline js
	 * @param $id
	 * @param $attributes
	 * @return string
	 */
	protected function getInlineJS($id, $attributes) {
		extract($attributes);

		return 'jQuery(document).ready(function(){
		    jQuery("#' . $id . '").fitVids();
		  });';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		//get video params
		$shortcode = ctShortcodeHandler::getInstance()->getShortcode('video');
		$attributes = $shortcode->getAttributes();

		//remove unsup
		unset($attributes['width'], $attributes['height']);

		return array_merge($attributes, array(
				'imgsrc' => array('label' => __("source", 'ct_theme'), 'default' => '', 'type' => 'image', 'help' => __("Image - ex. for mobile devices", 'ct_theme')),
				'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
		));
	}
}

new ctFullscreenVideoShortcode();