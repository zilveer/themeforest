<?php
namespace Hue\Modules\Shortcodes\SectionSubtitle;

use Hue\Modules\Shortcodes\Lib;

class SectionSubtitle implements Lib\ShortcodeInterface {
    private $base;

    /**
     * SectionSubtitle constructor.
     */
    public function __construct() {
        $this->base = 'mkd_section_subtitle';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Section Subtitle', 'hue'),
            'base'                      => $this->base,
            'category'                  => 'by MIKADO',
            'icon'                      => 'icon-wpb-section-subtitle extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Color', 'hue'),
                    'param_name'  => 'color',
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Choose color of your subtitle', 'hue')
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Text Align', 'hue'),
                    'param_name'  => 'text_align',
                    'value'       => array(
                        ''                          => '',
                        esc_html__('Center', 'hue') => 'center',
                        esc_html__('Left', 'hue')   => 'left',
                        esc_html__('Right', 'hue')  => 'right'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__('Choose color of your subtitle', 'hue')
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__('Text', 'hue'),
                    'param_name'  => 'text',
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Width (%)', 'hue'),
                    'param_name'  => 'width',
                    'description' => esc_html__('Adjust the width of section subtitle in percentages. Ommit the unit', 'hue'),
                    'value'       => '',
                    'save_always' => true,
                    'admin_label' => true
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'text'       => '',
            'color'      => '',
            'text_align' => '',
            'width'      => ''
        );

        $params = shortcode_atts($default_atts, $atts);

        if($params['text'] !== '') {

            $params['styles']  = array();
            $params['classes'] = array('mkd-section-subtitle-holder');

            if($params['color'] !== '') {
                $params['styles'][] = 'color: '.$params['color'];
            }

            if($params['text_align'] !== '') {
                $params['styles'][] = 'text-align: '.$params['text_align'];

                $params['classes'][] = 'mkd-section-subtitle-'.$params['text_align'];
            }

            $params['holder_styles'] = array();

            if($params['width'] !== '') {
                $params['holder_styles'][] = 'width: '.$params['width'].'%';
            }

            return hue_mikado_get_shortcode_module_template_part('templates/section-subtitle-template', 'section-subtitle', '', $params);
        }
    }

}
