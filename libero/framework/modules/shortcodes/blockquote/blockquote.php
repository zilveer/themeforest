<?php
namespace Libero\Modules\Blockquote;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;
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
	 */
	public function vcMap() {

		vc_map( array(
				'name' => 'Mikado Blockquote',
				'base' => $this->getBase(),
				'category' => 'by MIKADO',
				'icon' => 'icon-wpb-blockquote extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array(
					array(
						"type" => "textarea",
						"heading" => "Text",
						"param_name" => "text",
						"value" => "Blockquote text",
						"save_always" => true
					),
					array(
						"type" => "dropdown",
						"heading" => "Text Tag",
						"param_name" => "title_tag",
						"value" => array(
							""   => "",
							"h2" => "h2",
							"h3" => "h3",
							"h4" => "h4",
							"h5" => "h5",
							"h6" => "h6",
						),
						"description" => ""
					),
					array(
						"type" => "colorpicker",
						"heading" => "Text Color",
						"param_name" => "text_color"
					),
					array(
						"type" => "colorpicker",
						"heading" => "Quote Icon Color",
						"param_name" => "quote_icon_color"
					),
					array(
						"type" => "textfield",
						"heading" => "Width (%)",
						"param_name" => "width"
					),
					array(
						"type" => "colorpicker",
						"heading" => "Quote Border Color",
						"param_name" => "border_color"
					)
				)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'text' => '',
			'title_tag' => 'h3',
			'width' => '',
			'text_color' => '',
			'quote_icon_color' => '',
			'border_color' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['blockquote_style'] = $this->getBlockquoteStyle($params);
		$params['blockquote_title_tag'] = $this->getBlockquoteTitleTag($params,$args);
		$params['icon_style'] = $this->getBlockquoteIconStyle($params);
		$params['text_style'] = $this->getBlockquoteTextStyle($params);

		//Get HTML from template
		$html = libero_mikado_get_shortcode_module_template_part('templates/blockquote-template', 'blockquote', '', $params);

		return $html;

	}

	/**
	 * Return Style for Blockquote
	 *
	 * @param $params
	 * @return string
	 */
	private function getBlockquoteStyle($params) {
		$blockquote_style = array();

		if ($params['width'] !== '') {
			$width = strstr($params['width'], '%') ? $params['width'] : $params['width'].'%';
			$blockquote_style[] = 'width: '.$width;
		}

		if ($params['border_color'] !== '') {
			$blockquote_style[] = 'border-color: '.$params['border_color'];
		}

		return implode(';', $blockquote_style);
	}

	/**
	 * Return Blockquote Title Tag. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @return string
	 */
	private function getBlockquoteTitleTag($params,$args) {
		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];
	}

	/**
	 * Return Style for Blockquote Icon
	 *
	 * @param $params
	 * @return string
	 */
	private function getBlockquoteIconStyle($params) {
		$icon_style = array();

		if ($params['quote_icon_color'] !== '') {
			$icon_style[] = 'color: '.$params['quote_icon_color'];
		}

		return implode(';', $icon_style);
	}

	/**
	 * Return Style for Blockquote Text
	 *
	 * @param $params
	 * @return string
	 */
	private function getBlockquoteTextStyle($params) {
		$text_style = array();

		if ($params['text_color'] !== '') {
			$text_style[] = 'color: '.$params['text_color'];
		}

		return implode(';', $text_style);
	}
}