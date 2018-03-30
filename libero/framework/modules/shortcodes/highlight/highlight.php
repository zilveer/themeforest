<?php
namespace Libero\Modules\Highlight;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Highlight
 */
class Highlight implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkd_highlight';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/*
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see mkd_core_get_carousel_slider_array_vc()
	 */
	 
	public function vcMap() {
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'color' => '',
			'background_color' => '',
			'padding' => '',
			'line_height' => '',
			'font_size' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;
		$params['highlight_style'] = $this->getHighlightStyle($params);

		//Get HTML from template
		$html = libero_mikado_get_shortcode_module_template_part('templates/highlight-template', 'highlight', '', $params);

		return $html;

	}

	/**
	 * Return Style for Highlight
	 *
	 * @param $params
	 * @return string
	 */
	private function getHighlightStyle($params) {
		$highlight_style = array();

		if ($params['color'] !== '') {
			$highlight_style[] = 'color: '.$params['color'];
		}

		if ($params['background_color'] !== '') {
			$highlight_style[] = 'background-color: '.$params['background_color'];
		}

		if ($params['padding'] !== '') {
			$highlight_style[] = 'padding: '.$params['padding'];
		}

		if ($params['line_height'] !== '') {
			$highlight_style[] = 'line-height: '.libero_mikado_filter_px($params['line_height']).'px';
		}

		if ($params['font_size'] !== '') {
			$highlight_style[] = 'font-size: '.libero_mikado_filter_px($params['font_size']).'px';
		}

		return implode(';', $highlight_style);
	}
}