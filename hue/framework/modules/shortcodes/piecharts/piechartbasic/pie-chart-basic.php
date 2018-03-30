<?php
namespace Hue\Modules\PieCharts\PieChartBasic;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class PieChartBasic
 */
class PieChartBasic implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkd_pie_chart';

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
            'name'                      => esc_html__('Pie Chart', 'hue'),
            'base'                      => $this->getBase(),
            'icon'                      => 'icon-wpb-pie-chart extended-custom-icon',
            'category'                  => 'by MIKADO',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Type of Central text', 'hue'),
                    'param_name'  => 'type_of_central_text',
                    'value'       => array(
                        esc_html__('Percent', 'hue') => 'percent',
                        esc_html__('Title', 'hue')   => 'title'
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Percentage', 'hue'),
                    'param_name'  => 'percent',
                    'description' => '',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'hue'),
                    'param_name'  => 'title',
                    'description' => '',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Title Tag', 'hue'),
                    'param_name'  => 'title_tag',
                    'value'       => array(
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
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Text', 'hue'),
                    'param_name'  => 'text',
                    'description' => '',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Size(px)', 'hue'),
                    'param_name'  => 'size',
                    'description' => '',
                    'admin_label' => true,
                    'group'       => esc_html__('Design Options', 'hue'),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Active Color', 'hue'),
                    'param_name'  => 'active_color',
                    'admin_label' => true,
                    'group'       => esc_html__('Design Options', 'hue'),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Inactive Color', 'hue'),
                    'param_name'  => 'inactive_color',
                    'admin_label' => true,
                    'group'       => esc_html__('Design Options', 'hue'),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Margin below chart (px)', 'hue'),
                    'param_name'  => 'margin_below_chart',
                    'description' => '',
                    'group'       => esc_html__('Design Options', 'hue'),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Typography Style', 'hue'),
                    'param_name'  => 'typography_style',
                    'value'       => array(
                        esc_html__('Dark', 'hue')  => 'dark',
                        esc_html__('Light', 'hue') => 'light'
                    ),
                    'description' => '',
                    'group'       => esc_html__('Design Options', 'hue'),
                ),
            )
        ));

    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'size'                 => '',
            'type_of_central_text' => 'percent',
            'title'                => '',
            'title_tag'            => 'h4',
            'percent'              => '',
            'active_color'         => '',
            'inactive_color'       => '',
            'text'                 => '',
            'margin_below_chart'   => '',
            'typography_style'     => 'dark'
        );

        $params = shortcode_atts($args, $atts);

        $params['active_color'] = $params['active_color'] !== '' ? $params['active_color'] : hue_mikado_get_first_main_color();

        $params['title_tag']       = $this->getValidTitleTag($params, $args);
        $params['pie_chart_data']  = $this->getPieChartData($params);
        $params['pie_chart_style'] = $this->getPieChartStyle($params);
        $params['data_attr']       = $this->getDataParams($params);
        $params['holder_classes']  = $this->getHolderClasses($params);

        $html = hue_mikado_get_shortcode_module_template_part('templates/pie-chart-basic', 'piecharts/piechartbasic', '', $params);

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
     *
     * @return array
     */
    private function getPieChartData($params) {

        $pieChartData = array();

        if($params['size'] !== '') {
            $pieChartData['data-size'] = $params['size'];
        }
        if($params['percent'] !== '') {
            $pieChartData['data-percent'] = $params['percent'];
        }

        return $pieChartData;

    }

    private function getPieChartStyle($params) {

        $pieChartStyle = array();

        if($params['margin_below_chart'] !== '') {
            $pieChartStyle[] = 'margin-top: '.$params['margin_below_chart'].'px';
        }

        return $pieChartStyle;

    }

    private function getDataParams($params) {

        $data_attr = array();

        if($params['active_color'] !== '') {
            $data_attr['data-bar-color'] = $params['active_color'];
        }

        if($params['inactive_color'] !== '') {
            $data_attr['data-track-color'] = $params['inactive_color'];
        }

        return $data_attr;
    }

    private function getHolderClasses($params) {
        $classes = array('mkd-pie-chart-holder');

        if(!empty($params['typography_style'])) {
            $classes[] = 'mkd-pie-chart-typography-'.$params['typography_style'];
        }

        return $classes;
    }

}