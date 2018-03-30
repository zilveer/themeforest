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

		return $tabs . '<div class="tab-content">' . $short . '</div>';
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array();
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