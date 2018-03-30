<?php
/**
 * Full width row shortcode
 * @author hc
 */

class ctFullwidthRowShortcode extends ctShortcode {

	/**
	 * Returns shortcode label
	 * @return mixed
	 */
	public function getName() {
		return "Full width row";
	}

	/**
	 * Returns shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'full_width';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return mixed
	 */
	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$class = '';
		switch($color){
			case 'primary':
				$class .= ' section-emphasis';
				break;
			case 'distinctive':
				$class .= ' section-emphasis-2';
				break;
			default:
				$class .= '';
		}

		$openDiv = $class ? ('<div'.$this->buildContainerAttributes(array('class' => array($class)), $atts).'>') : '';
		$closeDiv = $class ? '</div>' : '';

		//do not allow shortcode nesting
		return do_shortcode('</div>' . $openDiv . str_replace(array('[full_width]', '[/full_width]'), '', $content) . $closeDiv . '<div class="container">');
	}

	/**
	 * Returns config
	 * @return array
	 */
	public function getAttributes() {
		return array(
			'color' => array('label' => __('color', 'ct_theme'), 'default' => 'default', 'type' => 'select', 'choices' => array('default' => __('default', 'ct_theme'), 'primary' => __('primary', 'ct_theme'), 'distinctive' => __('distinctive', 'ct_theme')), 'help' => __("Background color", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea")
		);
	}
}

new ctFullwidthRowShortcode();