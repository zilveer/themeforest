<?php
/**
 * Button shortcode
 */
class ctButtonShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Button';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'button';
	}

	/**
	 * Shortcode type
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_ENCLOSING;
	}


	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$id = $id ? ' id="' . $id . '"' : '';
		$full = ($full === "false") ? '' : ' full';
		$color = $color ? ' ' . $color : '';
		$class = $class ? ' ' . $class : '';
		$link = $link ? ' href="' . $link . '"' : '';

		if ($width) {
			if (is_numeric($width)) {
				$width = $width . 'px';
			}
			$width = ' style="width:' . $width . ';"';
		} else {
			$width = '';
		}

		if ($button == 'true') {
			$tag = 'button';
		} else {
			$tag = 'a';
		}
		if ($nofollow == 'true') {
			$follow_tag = ' rel="nofollow"';
		} else {
			$follow_tag = '';
		}

		if ($newwindow == 'true') {
			$newwin_tag = ' target="_blank"';
		}else{
			$newwin_tag = '';
		}

		return '<' . $tag . $id . $link . $width . ' class="' . apply_filters('theme_css_class', 'btn') . ' ' . $size . $color . $class . '"' . $follow_tag . $newwin_tag . '>' . trim($content) . '</' . $tag . '>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'id' => array('default' => false, 'type' => false),
			'class' => array('default' => false, 'type' => false),
			'size' => array('label' => __('size', 'ct_theme'), 'default' => 'vmedium', 'type' => 'select', 'choices' => array('vsmall' => "Small", 'vmedium' => "Medium", 'vlarge' => "Large", 'vbig' => "Big"), 'help' => __("Button size",'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'),'help' => __("ex. http://www.google.com",'ct_theme')),
			'width' => array('label' => __('width', 'ct_theme'),'type' => "input"),
			'color' => array('label' => __('color', 'ct_theme'),'default' => 'default', 'type' => "select", 'choices' => array('default' => __('Default','ct_theme'), 'vgray' => __('gray', 'ct_theme'), 'vorange' => __('orange', 'ct_theme'))),
			'full' => array('type' => false),
			'button' => array('type' => false),
			'content' => array('label' => __('label', 'ct_theme'), 'default' => '', 'type' => 'textarea'),
			'nofollow' => array('label' => __('nofollow', 'ct_theme'),'type' => "checkbox", 'default' => 'true'),
			'newwindow' => array('label' => __('new window?', 'ct_theme'),'type' => "checkbox", 'default' => 'false'),
		);
	}
}

new ctButtonShortcode();