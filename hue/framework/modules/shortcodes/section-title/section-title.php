<?php
namespace Hue\Modules\Shortcodes\SectionTitle;

use Hue\Modules\Shortcodes\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
    private $base;

    /**
     * SectionTitle constructor.
     */
    public function __construct() {
        $this->base = 'mkd_section_title';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Section Title', 'hue'),
            'base'                      => $this->base,
            'category'                  => 'by MIKADO',
            'icon'                      => 'icon-wpb-section-title extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'hue'),
                    'param_name'  => 'title',
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Enter title text', 'hue')
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Color', 'hue'),
                    'param_name'  => 'title_color',
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Choose color of your title', 'hue')
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Text Transform', 'hue'),
                    'param_name'  => 'title_text_transform',
                    'value'       => array_flip(hue_mikado_get_text_transform_array(true)),
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Choose text transform for title', 'hue')
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Text Align', 'hue'),
                    'param_name'  => 'title_text_align',
                    'value'       => array(
                        ''                          => '',
                        esc_html__('Center', 'hue') => 'center',
                        esc_html__('Left', 'hue')   => 'left',
                        esc_html__('Right', 'hue')  => 'right'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Choose text align for title', 'hue')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Margin Bottom', 'hue'),
                    'param_name'  => 'margin_bottom',
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Size', 'hue'),
                    'param_name'  => 'title_size',
                    'value'       => array(
                        esc_html__('Default', 'hue') => '',
                        esc_html__('Small', 'hue')   => 'small',
                        esc_html__('Medium', 'hue')  => 'medium',
                        esc_html__('Large', 'hue')   => 'large'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Choose one of predefined title sizes', 'hue')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'type_out',
                    'heading'     => esc_html__('Enable Type Out Effect', 'hue'),
                    'value'       => array(
                        esc_html__('No', 'hue')  => 'no',
                        esc_html__('Yes', 'hue') => 'yes',
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'group'       => esc_html__('TypeOut Options', 'hue'),
                    'description' => esc_html__('If set to Yes, you can enter two more Section Titles to follow the original one in a typing-like effect.', 'hue')
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'title_2',
                    'heading'     => esc_html__('Section Title 2', 'hue'),
                    'admin_label' => true,
                    'group'       => esc_html__('TypeOut Options', 'hue'),
                    'dependency'  => array('element' => 'type_out', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'title_3',
                    'heading'     => esc_html__('Section Title 3', 'hue'),
                    'admin_label' => true,
                    'group'       => esc_html__('TypeOut Options', 'hue'),
                    'dependency'  => array('element' => 'title_2', 'not_empty' => true)
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'loop',
                    'heading'     => esc_html__('Loop Titles', 'hue'),
                    'value'       => array(
                        esc_html__('No', 'hue')  => 'no',
                        esc_html__('Yes', 'hue') => 'yes',
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'group'       => esc_html__('TypeOut Options', 'hue'),
                    'dependency'  => array('element' => 'type_out', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'cursor_style',
                    'heading'     => esc_html__('Cursor Style', 'hue'),
                    'value'       => array(
                        esc_html__('Gradient', 'hue')    => 'gradient',
                        esc_html__('Solid Color', 'hue') => 'solid_color',
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'group'       => esc_html__('TypeOut Options', 'hue'),
                    'dependency'  => array('element' => 'type_out', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'colorpicker',
                    'admin_label' => true,
                    'heading'     => esc_html__('Cursor Color Style', 'hue'),
                    'param_name'  => 'cursor_color_style',
                    'save_always' => true,
                    'description' => '',
                    'group'       => esc_html__('TypeOut Options', 'hue'),
                    'dependency'  => array('element' => 'cursor_style', 'value' => array('solid_color'))
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Cursor Gradient Style', 'hue'),
                    'param_name'  => 'cursor_gradient_style',
                    'value'       => array_flip(hue_mikado_get_gradient_bottom_to_top_styles('-text')),
                    'save_always' => true,
                    'description' => '',
                    'group'       => esc_html__('TypeOut Options', 'hue'),
                    'dependency'  => array('element' => 'cursor_style', 'value' => array('gradient'))
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'title'                 => '',
            'title_color'           => '',
            'title_size'            => '',
            'title_text_transform'  => '',
            'title_text_align'      => '',
            'margin_bottom'         => '',
            'type_out'              => '',
            'title_2'               => '',
            'title_3'               => '',
            'loop'                  => '',
            'cursor_style'          => '',
            'cursor_gradient_style' => '',
            'cursor_color_style'    => '',
        );

        $params = shortcode_atts($default_atts, $atts);

        if($params['title'] !== '') {
            $params['section_title_classes'] = array('mkd-section-title');

            if($params['title_size'] !== '') {
                $params['section_title_classes'][] = 'mkd-section-title-'.$params['title_size'];
            }

            $params['section_title_styles'] = array();

            if($params['title_color'] !== '') {
                $params['section_title_styles'][] = 'color: '.$params['title_color'];
            }

            if($params['title_text_transform'] !== '') {
                $params['section_title_styles'][] = 'text-transform: '.$params['title_text_transform'];
            }

            if($params['title_text_align'] !== '') {
                $params['section_title_styles'][] = 'text-align: '.$params['title_text_align'];
            }

            if($params['margin_bottom'] !== '') {
                $params['section_title_styles'][] = 'margin-bottom: '.hue_mikado_filter_px($params['margin_bottom']).'px';
            }

            $params['title_tag']     = $this->getTitleTag($params);
            $params['type_out_data'] = $this->getTypeOutData($params);

            return hue_mikado_get_shortcode_module_template_part('templates/section-title-template', 'section-title', '', $params);
        }
    }

    private function getTitleTag($params) {
        switch($params['title_size']) {
            default:
                $titleTag = 'h1';
        }

        return $titleTag;
    }

    /**
     * Return Type Out data
     *
     * @param $params
     *
     * @return string
     */
    private function getTypeOutData($params) {
        $type_out_data = array();

        if(!empty($params['loop'])) {
            $type_out_data['data-loop'] = $params['loop'];
        }

        if(!empty($params['cursor_gradient_style'])) {
            $type_out_data['data-cursor-gradient'] = $params['cursor_gradient_style'];
        }

        if(!empty($params['cursor_color_style'])) {
            $type_out_data['data-cursor-color'] = $params['cursor_color_style'];
        }

        return $type_out_data;
    }
}