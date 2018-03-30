<?php
namespace Flow\Modules\Separator;

use Flow\Modules\Shortcodes\Lib\ShortcodeInterface;

class SectionTitle implements ShortcodeInterface{

	private $base;

	public function __construct() {
		$this->base = 'eltd_section_title';
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
		vc_map(
			array(
				'name' => 'Section Title',
				'base' => $this->getBase(),
				'category' => 'by ELATED',
				'icon' => 'icon-wpb-section-title extended-custom-icon',
				'params' => array(
					array(
						'type' => 'textfield',
						'param_name' => 'title',
						'heading' => 'Section Title',
						'description' => '',
						'admin_label' => true
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'alignment',
						'heading' => 'Alignment',
						'description' => '',
						'value' => array(
							'Center' => '',
							'Left' => 'left',
							'Right' => 'right'
						),
						'admin_label' => true,
						'group' => 'Design Options'
					),
					array(
						'type' => 'textfield',
						'param_name' => 'title_font_size',
						'heading' => 'Title Font Size',
						'description' => '',
						'admin_label' => true,
						'group' => 'Design Options'
					),
					array(
						'type' => 'colorpicker',
						'param_name' => 'title_color',
						'heading' => 'Title Color',
						'description' => '',
						'admin_label' => true,
						'group' => 'Design Options'
					)
				)
			)
		);

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'title' => '',
			'alignment' => '',
			'title_font_size' => '',
			'title_color'	=> ''

		);

		$params = shortcode_atts($args, $atts);
		$params['section_title_holder_style'] = $this->getSectionHolderStyle($params);
		$params['section_title_style'] = $this->getSectionTitleStyle($params);

		$html = flow_elated_get_shortcode_module_template_part('templates/section-title', 'sectiontitle', '', $params);

		return $html;

	}

	/**
	 * Section Holder Styles
	 *
	 * @param $params
	 * @return array
	 */
	private function getSectionHolderStyle($params) {

		$holder_styles = array();

		$holder_styles[] = ($params['alignment'] !== '') ? 'text-align: ' . $params['alignment'] : 'text-align: center';

		return $holder_styles;

	}

	/**
	 * Title Styles
	 *
	 * @param $params
	 * @return array
	 */
	private function getSectionTitleStyle($params) {

		$title_styles = array();

		$title_styles[] = ($params['title_font_size'] !== '') ? 'font-size: ' . flow_elated_filter_px($params['title_font_size']) . 'px' : '';
		$title_styles[] = ($params['title_color'] !== '') ? 'color: ' . $params['title_color'] : '';

		return $title_styles;

	}

}