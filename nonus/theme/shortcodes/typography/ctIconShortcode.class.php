<?php
/**
 * Icon shortcode
 */
class ctIconShortcode extends ctShortcode {


	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Icon';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'icon';
	}

	/**
	 * Returns shortcode type
	 * @return mixed|string
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
        $awesome = FontAwesomeMigrateHelper::FontAwesomeMigrate( $awesome);
		if($awesome){
			return '<i'.$this->buildContainerAttributes(array('class'=>array($awesome)),$atts).'></i>';
		}
		return '';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'awesome' => array('label' => __('awesome icon', 'ct_theme'),'type' => "icon", 'default' => '','link'=>CT_THEME_ASSETS.'/shortcode/awesome/index.html'),
		);
	}
}

new ctIconShortcode();