<?php
/**
 * Video shortcode
 */
class ctVideoShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Video';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'video';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		if ($link) {
			global $wp_embed;
			return $wp_embed->run_shortcode('<div class="videoFrameContainer">[embed]' . $link . '[/embed]</div>');
		}

		if (!$clipid && !$src) {
			return '';
		}

		switch ($type) {
			case 'youtube':
				$url = 'http://www.youtube.com/embed/' . $clipid;
				break;
			case 'vimeo':
				$url = 'http://player.vimeo.com/video/' . $clipid;
				break;
			case 'dailymotion':
				$url = 'http://www.dailymotion.com/embed/video/' . $clipid;
				break;
			case 'flash':
				return '<div class="videoFrameContainer">
							<object class="flash" width="' . $width . '" height="' . $height . '" type="application/x-shockwave-flash" data="' . $src . '">
								<param name="movie" value="' . $src . '" />
								<param name="allowFullScreen" value="true" />
								<param name="allowscriptaccess" value="always" />
								<param name="play" value="false"/>
								<param name="wmode" value="transparent" />
								<embed src="' . $src . '" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '" />
							</object>
						</div>';

		}

		return "<div class='videoFrameContainer'>
					<iframe class='{$type}'style='max-height:{$height}px; max-width:{$width}px' src='{$url}'width='$width' height='$height' frameborder='0'>
					</iframe>
				</div>";
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'link' => array('default' => '', 'type' => 'input', 'label' => __('Link', 'ct_theme'), 'help' => __('Direct movie link', 'ct_theme'),'example' => "http://www.youtube.com/watch?v=Vpg9yizPP_g"),
			'type' => array('default' => 'youtube', 'type' => 'select', 'choices' => array('youtube' => 'Youtube', 'vimeo' => 'Vimeo', 'dailymotion' => 'Dailymotion', 'flash' => 'Flash'), 'label' => __('Type', 'ct_theme'), 'help' => __('Video type (used only if link not given)', 'ct_theme')),
			'clipid' => array('default' => '', 'type' => 'input', 'label' => __('Clip id', 'ct_theme'), 'help' => __("Used for Youtube, Vimeo and Dailymotion used only if link not given)", "ct_theme")),
			'src' => array('default' => '', 'type' => 'input', 'label' => __('Flash movie source', 'ct_theme'), 'help' => __("Used only for flash movies", "ct_theme")),
			'width' => array('default' => '500', 'type' => 'input', 'label' => __('Width', 'ct_theme')),
			'height' => array('default' => '300', 'type' => 'input', 'label' => __('Height', 'ct_theme')),
		);
	}
}

new ctVideoShortcode();