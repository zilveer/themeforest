<?php
/**
 * Bar shortcode
 */
class ctBarShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Bar';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'bar';
	}

	public function enqueueScripts() {
		wp_register_script('ct-viewport', CT_THEME_ASSETS . '/js/jquery.viewport.min.js');
		wp_enqueue_script('ct-viewport');
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$percent = floatval($percent);
		switch($color){
			case 'info':
				$color = 'lightblue';
				break;
			case 'success':
				$color = 'green';
				break;
			case 'warning':
				$color = 'warning';
				break;
			case 'danger':
				$color = 'red';
				break;
			default:
				$color = 'default';
		}

		$this->addInlineJS($this->getInlineJS());
		return '<span class="bar-info">' . $title . ' &mdash; ' . $percent . '%</span>
	            <div'.$this->buildContainerAttributes(array('class'=>array('progress','progress-' . $color),'data-percentage'=>$percent),$atts).'>
	                <div class="bar" style="width: 5px;"></div>
	            </div>';
	}

	protected function getInlineJS(){
		return '';
	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'bars';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'title' => array('label' => __('title', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'percent' => array('label' => __('percent', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'color' => array('label' => __('color', 'ct_theme'), 'default' => 'default', 'type' => "select", 'choices' => array('default' => __('Default', 'ct_theme'), 'info' => __('info', 'ct_theme'), 'success' => __('success', 'ct_theme'), 'warning' => __('warning', 'ct_theme'), 'danger' => __('danger', 'ct_theme'))),
		);
	}
}

new ctBarShortcode();