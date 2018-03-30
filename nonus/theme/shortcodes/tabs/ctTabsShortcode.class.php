<?php
/**
 * Tabs shortcode
 */
class ctTabsShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Tabs';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'tabs';
	}


	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		//parse shortcode before filters
		$short = do_shortcode($content);

		$tabs = '<ul class="nav nav-tabs">';
		$tabs .= $this->callPreFilter(''); //reference
		$tabs .= '</ul>';

		//clean current tab cache
		$this->cleanData('tab');

		$headerHtml = $header ? ' <h4>' . $header . '</h4>' : '';


		return $headerHtml . '<div'.$this->buildContainerAttributes(array('class'=>array('tabs',$modern == "true" ? ' type2' : '')),$atts).'>' . $tabs . '<ul class="tab-content">' . $short . '</ul></div>';
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'header' => array('label' => __('header', 'ct_theme'),'default' => '', 'type' => 'input'),
			'modern' => array('label' => __('type', 'ct_theme'), 'default' => 'false', 'type' => 'checkbox', 'help' => __("Use modern layout?", 'ct_theme')),
		);
	}

	/**
	 * Child shortcode info
	 * @return array
	 */

	public function getChildShortcodeInfo() {
		return array('name' => 'tab', 'min' => 1, 'max' => 20, 'default_qty' => 2);
	}
}

new ctTabsShortcode();