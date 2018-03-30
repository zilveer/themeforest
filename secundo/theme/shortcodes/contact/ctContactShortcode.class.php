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

		$widgetmode = $widgetmode == 'true' ? true : false;

		$contactHtml = '';
		$address = '';
		$address .= $street ? $street : '';
		if ($postcode || $city || $country) {
			$address .= '<br>';
		}
		$address .= $postcode ? $postcode : '';
		$address .= $city ? (" " . $city) : '';
		$address .= $country ? (", " . $country) : '';

		$tag = $widgetmode ? '<em>' : '';
		$endtag = $widgetmode ? '</em>' : '';
		$pclass = $widgetmode ? '' : ' class="vmedium"';
		$containerclass = $widgetmode ? ' class="doCenter"' : '';
		$headerHtml = $widgetmode ? ('<h3 class="vbright vsmall">' . $header . '</h3>') : ('<h2 class="oneLine"><span>' . $header . '</span></h2>');

		$contactHtml .= $address ? ($tag . __('Address', 'ct_theme') . ': ' . $endtag . $address . '<br>') : '';
		$contactHtml .= $phone ? ($tag . __('Tel', 'ct_theme') . ': ' . $endtag . $phone . '<br>') : '';
		$contactHtml .= $fax ? ($tag . __('Fax', 'ct_theme') . ': ' . $endtag . $fax . '<br>') : '';
		$contactHtml .= $email ? ($tag . __('Email', 'ct_theme') . ': ' . $endtag . '<a href="mailto:' . $email . '">' . $email . '</a>') : '';

		return '<div' . $containerclass . '>' . $headerHtml . '<p' . $pclass . '>' . $contactHtml . '</p></div>';

	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'widgetmode' => array('default' => 'false', 'type' => false),
			'header' => array('label' => __('header', 'ct_theme'),'default' => '', 'type' => 'input', 'help' => __("Header text",'ct_theme')),
			'street' => array('label' => __('street', 'ct_theme'),'default' => '', 'type' => 'input'),
			'city' => array('label' => __('city', 'ct_theme'),'default' => '', 'type' => 'input'),
			'postcode' => array('label' => __('postcode', 'ct_theme'),'default' => '', 'type' => 'input'),
			'country' => array('label' => __('country', 'ct_theme'),'default' => '', 'type' => 'input'),
			'phone' => array('label' => __('phone', 'ct_theme'),'default' => '', 'type' => 'input'),
			'fax' => array('label' => __('fax', 'ct_theme'),'default' => '', 'type' => 'input'),
			'email' => array('label' => __('email', 'ct_theme'),'default' => '', 'type' => 'input', 'help' => __("Email address",'ct_theme')),
		);
	}
}

new ctContactShortcode();