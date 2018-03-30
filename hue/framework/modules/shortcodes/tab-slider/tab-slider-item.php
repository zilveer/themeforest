<?php
namespace Hue\Modules\Shortcodes\TabSlider;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

class TabSliderItem implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_tab_slider_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Tab Slider Item', 'hue'),
            'base'                    => $this->base,
            'category'                => 'by MIKADO',
            'icon'                    => 'icon-wpb-tab-slider-item extended-custom-icon',
            'as_parent'               => array('except' => 'vc_row'),
            'as_child'                => array('only' => 'mkd_tab_slider'),
            'is_container'            => true,
            'show_settings_on_create' => true,
            'params'                  => array_merge(
                array(
                    array(
                        'type'        => 'attach_image',
                        'admin_label' => true,
                        'heading'     => esc_html__('Slide Image', 'hue'),
                        'param_name'  => 'slide_image',
                        'value'       => '',
                        'description' => esc_html__('Select image from media library.', 'hue'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Slide Title', 'hue'),
                        'param_name'  => 'slide_title',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textarea_html',
                        'holder'      => 'div',
                        'class'       => '',
                        'heading'     => esc_html__('Content', 'hue'),
                        'param_name'  => 'content',
                        'value'       => '',
                        'description' => '',
                    )
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'image_position' => '',
            'slide_image'    => '',
            'slide_title'    => ''
        );

        $params = shortcode_atts($default_atts, $atts);

        $params['content'] = $content;

        return hue_mikado_get_shortcode_module_template_part('templates/tab-slider-item', 'tab-slider', '', $params);
    }
}