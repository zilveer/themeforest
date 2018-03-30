<?php
namespace Hue\Modules\Blockquote;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Blockquote
 */
class Blockquote implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkd_blockquote';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see mkd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('Blockquote', 'hue'),
			'base'                      => $this->getBase(),
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-blockquote extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					"type"        => "textarea",
					"heading"     => esc_html__("Text", 'hue'),
					"param_name"  => "text",
					"value"       => "Blockquote text",
					"save_always" => true
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Width (%)", 'hue'),
					"param_name" => "width"
				),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Dash Gradient Style', 'hue'),
                    'param_name'  => 'dash_gradient_style',
                    'value'       => array_flip(hue_mikado_get_gradient_bottom_to_top_styles('-after',false)),
                    'save_always' => true
                ),
			)
		));

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'text'  => '',
			'width' => '',
			'dash_gradient_style' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['blockquote_style'] = $this->getBlockquoteStyle($params);

		//Get HTML from template
		$html = hue_mikado_get_shortcode_module_template_part('templates/blockquote-template', 'blockquote', '', $params);

		return $html;

	}

	/**
	 * Return Style for Blockquote
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getBlockquoteStyle($params) {
		$blockquote_style = array();

		if($params['width'] !== '') {
			$width              = strstr($params['width'], '%') ? $params['width'] : $params['width'].'%';
			$blockquote_style[] = 'width: '.$width;
		}

		return implode(';', $blockquote_style);
	}

}