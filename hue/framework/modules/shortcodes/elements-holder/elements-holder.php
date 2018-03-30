<?php
namespace Hue\Modules\ElementsHolder;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

class ElementsHolder implements ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkd_elements_holder';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'      => esc_html__('Elements Holder', 'hue'),
            'base'      => $this->base,
            'icon'      => 'icon-wpb-elements-holder extended-custom-icon',
            'category'  => 'by MIKADO',
            'as_parent' => array('only' => 'mkd_elements_holder_item, mkd_info_box'),
            'js_view'   => 'VcColumnView',
            'params'    => array(
                array(
                    'type'        => 'colorpicker',
                    'class'       => '',
                    'heading'     => esc_html__('Background Color', 'hue'),
                    'param_name'  => 'background_color',
                    'value'       => '',
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Columns', 'hue'),
                    'admin_label' => true,
                    'param_name'  => 'number_of_columns',
                    'value'       => array(
                        esc_html__('1 Column', 'hue')  => 'one-column',
                        esc_html__('2 Columns', 'hue') => 'two-columns',
                        esc_html__('3 Columns', 'hue') => 'three-columns',
                        esc_html__('4 Columns', 'hue') => 'four-columns',
                        esc_html__('5 Columns', 'hue') => 'five-columns',
                        esc_html__('6 Columns', 'hue') => 'six-columns'
                    ),
                    'description' => ''
                ),
                array(
                    'type'        => 'checkbox',
                    'class'       => '',
                    'heading'     => esc_html__('Items Float Left', 'hue'),
                    'param_name'  => 'items_float_left',
                    'value'       => array('Make Items Float Left?' => 'yes'),
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'group'       => esc_html__('Width & Responsiveness', 'hue'),
                    'heading'     => esc_html__('Switch to One Column', 'hue'),
                    'param_name'  => 'switch_to_one_column',
                    'value'       => array(
                        esc_html__('Default', 'hue')      => '',
                        esc_html__('Below 1280px', 'hue') => '1280',
                        esc_html__('Below 1024px', 'hue') => '1024',
                        esc_html__('Below 768px', 'hue')  => '768',
                        esc_html__('Below 600px', 'hue')  => '600',
                        esc_html__('Below 480px', 'hue')  => '480',
                        esc_html__('Never', 'hue')        => 'never'
                    ),
                    'description' => esc_html__('Choose on which stage item will be in one column', 'hue')
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'group'       => esc_html__('Width & Responsiveness', 'hue'),
                    'heading'     => esc_html__('Choose Alignment In Responsive Mode', 'hue'),
                    'param_name'  => 'alignment_one_column',
                    'value'       => array(
                        esc_html__('Default', 'hue') => '',
                        esc_html__('Left', 'hue')    => 'left',
                        esc_html__('Center', 'hue')  => 'center',
                        esc_html__('Right', 'hue')   => 'right'
                    ),
                    'description' => esc_html__('Alignment When Items are in One Column', 'hue')
                )
            )
        ));
    }

    public function render($atts, $content = null) {

        $args   = array(
            'number_of_columns'    => '',
            'switch_to_one_column' => '',
            'alignment_one_column' => '',
            'items_float_left'     => '',
            'background_color'     => ''
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $html = '';

        $elements_holder_classes   = array();
        $elements_holder_classes[] = 'mkd-elements-holder';
        $elements_holder_style     = '';

        if($number_of_columns != '') {
            $elements_holder_classes[] .= 'mkd-'.$number_of_columns;
        }

        if($switch_to_one_column != '') {
            $elements_holder_classes[] = 'mkd-responsive-mode-'.$switch_to_one_column;
        } else {
            $elements_holder_classes[] = 'mkd-responsive-mode-768';
        }

        if($alignment_one_column != '') {
            $elements_holder_classes[] = 'mkd-one-column-alignment-'.$alignment_one_column;
        }

        if($items_float_left !== '') {
            $elements_holder_classes[] = 'mkd-elements-items-float';
        }

        if($background_color != '') {
            $elements_holder_style .= 'background-color:'.$background_color.';';
        }

        $elements_holder_class = implode(' ', $elements_holder_classes);

        $html .= '<div '.hue_mikado_get_class_attribute($elements_holder_class).' '.hue_mikado_get_inline_attr($elements_holder_style, 'style').'>';
        $html .= do_shortcode($content);
        $html .= '</div>';

        return $html;

    }

}
