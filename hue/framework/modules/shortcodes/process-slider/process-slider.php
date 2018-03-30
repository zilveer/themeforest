<?php

namespace Hue\Modules\Shortcodes\ProcessSlider;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ZoomingSlider
 */
class ProcessSlider implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * ZoomingSlider constructor.
     */
    public function __construct() {
        $this->base = 'mkd_process_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     *
     */
    public function vcMap() {
        vc_map(array(
            'name'            => esc_html__('Process Slider', 'hue'),
            'base'            => $this->base,
            'as_parent'       => array('only' => 'mkd_process_slider_item'),
            'content_element' => true,
            'category'        => 'by MIKADO',
            'icon'            => 'icon-wpb-process-slider extended-custom-icon',
            'js_view'         => 'VcColumnView',
            'params'          => array(
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Navigation Skin', 'hue'),
                    'param_name'  => 'skin',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Dark', 'hue')  => 'dark',
                        esc_html__('Light', 'hue') => 'light'
                    ),
                ),
            )
        ));
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_attrs = array(
            'skin' => ''
        );
        $params        = shortcode_atts($default_attrs, $atts);

        $nav = '';
        if($params['skin'] == 'light') {
            $nav = 'mkd-nav-light';
        }

        $params['light_nav'] = $nav;

        $params['content'] = $content;

        return hue_mikado_get_shortcode_module_template_part('templates/process-slider-template', 'process-slider', '', $params);
    }
}