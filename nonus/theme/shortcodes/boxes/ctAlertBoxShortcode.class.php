<?php
/**
 * Alert Box shortcode
 */
class ctAlertBoxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Alert Box';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'alert_box';
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

		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('alert','alert-' . $type)),$atts).'>
				                <a href="#" class="close" data-dismiss="alert">&times;</a>
				               <p>' . do_shortcode($content) . '</p>
				            </div>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'type' => array('label' => __('type', 'ct_theme'),'default' => 'info', 'type' => "select", 'choices' => array('info' => __('info','ct_theme'), 'success' => __('success', 'ct_theme'), 'warning' => __('warning', 'ct_theme'), 'error' => __('error', 'ct_theme'))),
		);
	}
}

new ctAlertBoxShortcode();