<?php

namespace Hue\Modules\Shortcodes\CardsSlider;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class CardsSlider
 */
class CardsSlider implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * CardsSlider constructor.
	 */
	public function __construct() {
		$this->base = 'mkd_cards_slider';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 *
	 */
	public function vcMap() {
		vc_map(array(
			'name'                    => esc_html__('Cards Slider Holder', 'hue'),
			'base'                    => $this->base,
			'as_parent'               => array('only' => 'mkd_cards_slider_item'),
			'content_element'         => true,
			'category'                => 'by MIKADO',
			'icon'                    => 'icon-wpb-cards-slider extended-custom-icon',
			'js_view'                 => 'VcColumnView',

		));
	}

	/**
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$default_attrs = array(

        );
		$params        = shortcode_atts($default_attrs, $atts);

		$params['content'] = $content;

		return hue_mikado_get_shortcode_module_template_part('templates/cards-slider-holder', 'cards-slider', '', $params);
	}
}