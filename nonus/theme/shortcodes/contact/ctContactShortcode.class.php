<?php
/**
 * Contact shortcode
 */
class ctContactShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Contact';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'contact';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$contactHeader = $contacttitle ? '<h4>' . $contacttitle . '</h4>' : '';
		$contactHtml = $emaillabel ? ($emaillabel . '<br>') : '';
		$contactHtml .= $email ? '<a href="mailto:' . $email . '">' . $email . '</a>' : '';
		$addressHeader = $addresstitle ? '<h4 class="adress">' . $addresstitle . '</h4>' : '';
		return '<div'.$this->buildContainerAttributes(array('class'=>array('contact-info')),$atts).'>
					<div class="text-widget widget">
		                ' . $contactHeader . '
		                <p>
		                    ' . $contactHtml . '
		                </p>
		                </div>
		                <div class="text-widget widget">
		                ' . $addressHeader . '

		                <p>
		                    ' . $content . '
		                </p>
	                </div>
	            </div>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'widgetmode' => array('default' => 'false', 'type' => false),
			'contacttitle' => array('label' => __('contact title', 'ct_theme'),'default' => '', 'type' => 'input'),
			'emaillabel' => array('label' => __('email label', 'ct_theme'),'default' => '', 'type' => 'input'),
			'email' => array('label' => __('email', 'ct_theme'),'default' => '', 'type' => 'input'),
			'addresstitle' => array('label' => __('address title', 'ct_theme'),'default' => '', 'type' => 'input'),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
		);
	}
}

new ctContactShortcode();