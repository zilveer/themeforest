<?php
namespace SupremaQodef\Modules\Shortcodes\PieCharts\PieChartBasic;

use SupremaQodef\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class PieChartBasic
 */
class PieChartBasic implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'qodef_pie_chart';

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
	 * @see qode_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Select Pie Chart', 'suprema'),
			'base' => $this->getBase(),
			'icon' => 'icon-wpb-pie-chart extended-custom-icon',
			'category' => 'by SELECT',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => 'Type of Central text',
					'param_name' => 'type_of_central_text',
					'value' => array(
						'Percent'  => 'percent',
						'Title' => 'title'
					),
					'save_always' => true,
					'admin_label' => true
				),
				array(
					'type' => 'textfield',
					'heading' => 'Percentage',
					'param_name' => 'percent',
					'description' => '',
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'heading' => 'Title',
					'param_name' => 'title',
					'description' => '',
					'admin_label' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Title Tag',
					'param_name' => 'title_tag',
					'value' => array(
						''   => '',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h5' => 'h5',
						'h6' => 'h6',
					),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Text',
					'param_name' => 'text',
					'description' => '',
					'admin_label' => true
				),
				array(
					'type' => 'textfield',
					'heading' => 'Size(px)',
					'param_name' => 'size',
					'description' => '',
					'admin_label' => true,
					'group' => 'Design Options',
				),
				array(
					'type' => 'textfield',
					'heading' => 'Margin below chart (px)',
					'param_name' => 'margin_below_chart',
					'description' => '',
					'group' => 'Design Options',
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Active Bar Color',
					'param_name' => 'active_bar_color',
					'description' => '',
					'group' => 'Design Options',
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Inactive Bar Color',
					'param_name' => 'inactive_bar_color',
					'description' => '',
					'group' => 'Design Options',
				)
			)
		) );

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
			'size' => '',
			'type_of_central_text' => 'percent',
			'title' => '',
			'title_tag' => 'h4',
			'percent' => '',
			'text' => '',
			'margin_below_chart' => '',
			'active_bar_color' => '',
			'inactive_bar_color' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['title_tag'] = $this->getValidTitleTag($params, $args);
		$params['pie_chart_data'] = $this->getPieChartData($params);
		$params['pie_chart_style'] = $this->getPieChartStyle($params);

		$html = suprema_qodef_get_shortcode_module_template_part('templates/pie-chart-basic', 'piecharts/piechartbasic', '', $params);

		return $html;


	}

	/**
	 * Return correct heading value. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @param $args
	 */
	private function getValidTitleTag($params, $args) {

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];

	}

	/**
	 * Return data attributes for Pie Chart
	 *
	 * @param $params
	 * @return array
	 */
	private function getPieChartData($params) {

		$pieChartData = array();

		if( $params['size'] !== '' ) {
			$pieChartData['data-size'] = $params['size'];
		}
		if( $params['percent'] !== '' ) {
			$pieChartData['data-percent'] = $params['percent'];
		}

		if($params['active_bar_color'] != '') {
			$pieChartData['data-active-color'] = $params['active_bar_color'];
		}
		else if(suprema_qodef_options()->getOptionValue('first_color') !== "") {
			$pieChartData['data-active-color'] = suprema_qodef_options()->getOptionValue('first_color');
		}
		else {
			$pieChartData['data-active-color'] = '#0cc3ce';
		}

		if($params['inactive_bar_color'] != '') {
			$pieChartData['data-inactive-color'] = $params['inactive_bar_color'];
		}

		return $pieChartData;

	}

	private function getPieChartStyle($params) {

		$pieChartStyle = array();

		if ($params['margin_below_chart'] !== '') {
			$pieChartStyle[] = 'margin-top: ' . $params['margin_below_chart'] . 'px';
		}

		return $pieChartStyle;

	}

}