<?php
/**
 * Person Box shortcode
 */
class ctPersonBoxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Person box';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'person_box';
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

		$linkWrapPre = $imglink ? '<a href="' . $imglink . '">' : '';
		$linkWrapPost = $imglink ? '</a>' : '';


		$contentHtml = $content ? ('<div class="row-fluid"><div class="span12"><p>' . $content . '</p></div></div>') : '';
		return do_shortcode('[shadow_box]
			                    <div class="row-fluid">
			                        <div class="span6 doCenter">
			                        ' . $linkWrapPre . '
		                               <span class="circleFrame doCenter" style="background: url(' . $imgsrc . ') no-repeat top center;">
		                                   [img src="' . $imgsrc . '" alt=""]
		                               </span>
		                             ' . $linkWrapPost . '
			                        </div>
			                        <div class="span6">
			                            <h3 class="vmedium">' . $header . '</h3>
			                            <span class="vitalic">' . $subheader . '</span>
			                            <br>
			                            <a href="' . $link . '" class="vitalic">' . $linktext . '</a>
			                        </div>
			                    </div>' . $contentHtml . '[/shadow_box]');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'imgsrc' => array('label' => __("source", 'ct_theme'), 'default' => '', 'type' => 'image', 'help' => __("Image", 'ct_theme')),
			'imglink' => array('label' => __("image link", 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Image link", 'ct_theme')),
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'subheader' => array('label' => __('subheader', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Subheader text", 'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Link", 'ct_theme')),
			'linktext' => array('label' => __('link text', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Link text", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
		);
	}
}

new ctPersonBoxShortcode();